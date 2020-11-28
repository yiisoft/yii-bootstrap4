<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Bootstrap4;

use JsonException;
use Yiisoft\Arrays\ArrayHelper;
use Yiisoft\Html\Html;
use Yiisoft\Widget\Exception\InvalidConfigException;

use function array_column;
use function array_key_exists;
use function array_merge;
use function array_search;
use function is_array;
use function is_int;
use function is_numeric;
use function is_object;
use function is_string;

/**
 * Accordion renders an accordion bootstrap javascript component.
 *
 * For example:
 *
 * ```php
 * echo Accordion::widget()
 *     ->items([
 *         // equivalent to the above
 *         [
 *             'label' => 'Collapsible Group Item #1',
 *             'content' => 'Anim pariatur cliche...',
 *             // open its content by default
 *             'contentOptions' => ['class' => 'in'],
 *         ],
 *         // another group item
 *         [
 *             'label' => 'Collapsible Group Item #1',
 *             'content' => 'Anim pariatur cliche...',
 *             'contentOptions' => [...],
 *             'options' => [...],
 *             'expand' => true,
 *         ],
 *         // if you want to swap out .card-block with .list-group, you may use the following
 *         [
 *             'label' => 'Collapsible Group Item #1',
 *             'content' => [
 *                 'Anim pariatur cliche...',
 *                 'Anim pariatur cliche...',
 *             ],
 *             'contentOptions' => [...],
 *             'options' => [...],
 *             'footer' => 'Footer' // the footer label in list-group,
 *         ],
 *     ]);
 * ```
 */
class Accordion extends Widget
{
    private array $items = [];
    private bool $encodeLabels = true;
    private bool $autoCloseItems = true;
    private array $itemToggleOptions = [];
    private array $options = [];

    protected function run(): string
    {
        if (!isset($this->options['id'])) {
            $this->options['id'] = "{$this->getId()}-accordion";
        }

        $this->registerPlugin('collapse', $this->options);

        Html::addCssClass($this->options, 'accordion');

        return implode("\n", [
            Html::beginTag('div', $this->options),
            $this->renderItems(),
            Html::endTag('div'),
        ]) . "\n";
    }

    /**
     * Renders collapsible items as specified on {@see items}.
     *
     * @throws InvalidConfigException|JsonException|
     *
     * @return string the rendering result.
     */
    public function renderItems(): string
    {
        $items = [];
        $index = 0;
        $expanded = array_search(true, array_column(ArrayHelper::toArray($this->items), 'expand'));

        foreach ($this->items as $key => $item) {
            if (!is_array($item)) {
                $item = ['content' => $item];
            }

            if ($expanded === false && $index === 0) {
                $item['expand'] = true;
            }

            if (!array_key_exists('label', $item)) {
                if (is_int($key)) {
                    throw new InvalidConfigException("The 'label' option is required.");
                }

                $item['label'] = $key;
            }

            $header = ArrayHelper::remove($item, 'label');
            $options = ArrayHelper::getValue($item, 'options', []);

            Html::addCssClass($options, ['panel' => 'card']);

            $items[] = Html::tag('div', $this->renderItem($header, $item, $index++), $options);
        }

        return implode("\n", $items);
    }

    /**
     * Renders a single collapsible item group.
     *
     * @param string $header a label of the item group {@see items}
     * @param array $item a single item from {@see items}
     * @param int $index the item index as each item group content must have an id.
     *
     * @throws InvalidConfigException|JsonException
     *
     * @return string the rendering result
     */
    public function renderItem(string $header, array $item, int $index): string
    {
        if (array_key_exists('content', $item)) {
            $id = $this->options['id'] . '-collapse' . $index;
            $expand = ArrayHelper::remove($item, 'expand', false);
            $options = ArrayHelper::getValue($item, 'contentOptions', []);
            $options['id'] = $id;

            Html::addCssClass($options, ['widget' => 'collapse']);

            if ($expand) {
                Html::addCssClass($options, 'show');
            }

            if (!isset($options['aria-label'], $options['aria-labelledby'])) {
                $options['aria-labelledby'] = $options['id'] . '-heading';
            }

            $encodeLabel = $item['encode'] ?? $this->encodeLabels;

            if ($encodeLabel) {
                $header = Html::encode($header);
            }

            $itemToggleOptions = array_merge([
                'tag' => 'button',
                'type' => 'button',
                'data-toggle' => 'collapse',
                'data-target' => '#' . $options['id'],
                'aria-expanded' => $expand ? 'true' : 'false',
                'aria-controls' => $options['id'],
            ], $this->itemToggleOptions);
            $itemToggleTag = ArrayHelper::remove($itemToggleOptions, 'tag', 'button');

            /** @psalm-suppress ConflictingReferenceConstraint */
            if ($itemToggleTag === 'a') {
                ArrayHelper::remove($itemToggleOptions, 'data-target');
                $headerToggle = Html::a($header, '#' . $id, $itemToggleOptions) . "\n";
            } else {
                Html::addCssClass($itemToggleOptions, 'btn-link');
                $headerToggle = Button::widget()
                    ->label($header)
                    ->encodeLabels(false)
                    ->options($itemToggleOptions)
                    ->render() . "\n";
            }

            $header = Html::tag('h5', $headerToggle, ['class' => 'mb-0']);

            if (is_string($item['content']) || is_numeric($item['content']) || is_object($item['content'])) {
                $content = Html::tag('div', $item['content'], ['class' => 'card-body']) . "\n";
            } elseif (is_array($item['content'])) {
                $content = Html::ul($item['content'], [
                    'class' => 'list-group',
                    'itemOptions' => [
                        'class' => 'list-group-item',
                    ],
                    'encode' => false,
                    ]) . "\n";
            } else {
                throw new InvalidConfigException('The "content" option should be a string, array or object.');
            }
        } else {
            throw new InvalidConfigException('The "content" option is required.');
        }

        $group = [];

        if ($this->autoCloseItems) {
            $options['data-parent'] = '#' . $this->options['id'];
        }

        $group[] = Html::tag('div', $header, ['class' => 'card-header', 'id' => $options['id'] . '-heading']);
        $group[] = Html::beginTag('div', $options);
        $group[] = $content;

        if (isset($item['footer'])) {
            $group[] = Html::tag('div', $item['footer'], ['class' => 'card-footer']);
        }

        $group[] = Html::endTag('div');

        return implode("\n", $group);
    }

    /**
     * Whether to close other items if an item is opened. Defaults to `true` which causes an accordion effect.
     *
     * Set this to `false` to allow keeping multiple items open at once.
     *
     * @param bool $value
     *
     * @return $this
     */
    public function autoCloseItems(bool $value): self
    {
        $this->autoCloseItems = $value;

        return $this;
    }

    /**
     * Whether the labels for header items should be HTML-encoded.
     *
     * @param bool $value
     *
     * @return $this
     */
    public function encodeLabels(bool $value): self
    {
        $this->encodeLabels = $value;

        return $this;
    }

    /**
     * List of groups in the collapse widget. Each array element represents a single group with the following structure:
     *
     * - label: string, required, the group header label.
     * - encode: bool, optional, whether this label should be HTML-encoded. This param will override global
     *   `$this->encodeLabels` param.
     * - content: array|string|object, required, the content (HTML) of the group
     * - options: array, optional, the HTML attributes of the group
     * - contentOptions: optional, the HTML attributes of the group's content
     *
     * You may also specify this property as key-value pairs, where the key refers to the `label` and the value refers
     * to `content`. If value is a string it is interpreted as label. If it is an array, it is interpreted as explained
     * above.
     *
     * For example:
     *
     * ```php
     * echo Accordion::widget([
     *     'items' => [
     *       'Introduction' => 'This is the first collapsible menu',
     *       'Second panel' => [
     *           'content' => 'This is the second collapsible menu',
     *       ],
     *       [
     *           'label' => 'Third panel',
     *           'content' => 'This is the third collapsible menu',
     *       ],
     *   ]
     * ])
     * ```
     *
     * @param array $value
     *
     * @return $this
     */
    public function items(array $value): self
    {
        $this->items = $value;

        return $this;
    }

    /**
     * The HTML options for the item toggle tag. Key 'tag' might be used here for the tag name specification.
     *
     * For example:
     *
     * ```php
     * [
     *     'tag' => 'div',
     *     'class' => 'custom-toggle',
     * ]
     * ```
     *
     * @param array $value
     *
     * @return $this
     */
    public function itemToggleOptions(array $value): self
    {
        $this->itemToggleOptions = $value;

        return $this;
    }

    /**
     * The HTML attributes for the widget container tag. The following special options are recognized.
     *
     * @param array $value
     *
     * @return $this
     *
     * {@see \Yiisoft\Html\Html::renderTagAttributes()} for details on how attributes are being rendered.
     */
    public function options(array $value): self
    {
        $this->options = $value;

        return $this;
    }
}
