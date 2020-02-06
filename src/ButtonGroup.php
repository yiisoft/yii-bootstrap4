<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Bootstrap4;

use Yiisoft\Arrays\ArrayHelper;

/**
 * ButtonGroup renders a button group bootstrap component.
 *
 * For example,
 *
 * ```php
 * // a button group with items configuration
 * echo ButtonGroup::widget()
 *     ->buttons([
 *         ['label' => 'A'],
 *         ['label' => 'B'],
 *         ['label' => 'C', 'visible' => false],
 *     ]);
 *
 * // button group with an item as a string
 * echo ButtonGroup::widget()
 *     ->buttons([
 *         Button::widget()
 *             ->label('A'),
 *         ['label' => 'B'],
 *     ]);
 * ```
 *
 * Pressing on the button should be handled via JavaScript. See the following for details:
 */
class ButtonGroup extends Widget
{
    /**
     * @var array list of buttons. Each array element represents a single button which can be specified as a string or
     * an array of the following structure:
     *
     * - label: string, required, the button label.
     * - options: array, optional, the HTML attributes of the button.
     * - visible: bool, optional, whether this button is visible. Defaults to true.
     */
    private array $buttons = [];

    /**
     * @var bool whether to HTML-encode the button labels.
     */
    private bool $encodeLabels = true;

    /**
     * @var array the HTML attributes for the widget container tag. The following special options are recognized:
     *
     * - tag: string, defaults to "nav", the name of the container tag.
     *
     * {@see \Yiisoft\Html\Html::renderTagAttributes()} for details on how attributes are being rendered.
     */
    private array $options = [];

    protected function run(): string
    {
        if (!isset($this->options['id'])) {
            $this->options['id'] = "{$this->getId()}-button-group";
        }

        Html::addCssClass($this->options, ['widget' => 'btn-group']);

        if (!isset($this->options['role'])) {
            $this->options['role'] = 'group';
        }

        return Html::tag('div', $this->renderButtons(), $this->options);
    }

    /**
     * Generates the buttons that compound the group as specified on {@see buttons}.
     *
     * @return string the rendering result.
     */
    protected function renderButtons(): string
    {
        $buttons = [];

        foreach ($this->buttons as $button) {
            if (\is_array($button)) {
                $visible = ArrayHelper::remove($button, 'visible', true);

                if ($visible === false) {
                    continue;
                }

                if (!isset($button['encodeLabel'])) {
                    $button['encodeLabel'] = $this->encodeLabels;
                }

                if (!isset($button['options']['type'])) {
                    ArrayHelper::setValue($button, 'options.type', 'button');
                }

                $buttons[] = Button::widget()
                                 ->encodeLabels($button['encodeLabel'])
                                 ->label($button['label'])
                                 ->options($button['options'])
                                 ->run();
            } else {
                $buttons[] = $button;
            }
        }

        return implode("\n", $buttons);
    }

    /**
     * {@see $buttons}
     */
    public function buttons(array $value): self
    {
        $this->buttons = $value;

        return $this;
    }

    /**
     * {@see $encodeLabels}
     */
    public function encodeLabels(bool $value): self
    {
        $this->encodeLabels = $value;

        return $this;
    }

    /**
     * {@see $options}
     */
    public function options(array $value): self
    {
        $this->options = $value;

        return $this;
    }
}
