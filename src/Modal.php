<?php
declare(strict_types = 1);

namespace Yiisoft\Yii\Bootstrap4;

use Yiisoft\Arrays\ArrayHelper;

/**
 * Modal renders a modal window that can be toggled by clicking on a button.
 *
 * The following example will show the content enclosed between the {@see begin()} and {@see end()} calls within the
 * modal window:
 *
 * ~~~php
 * Modal::begin()
 *     ->title('<h2>Hello world</h2>')
 *     ->toggleButton(['label' => 'click me']);
 *
 * echo 'Say hello...';
 *
 * Modal::end();
 * ~~~
 */
class Modal extends Widget
{
    /**
     * The additional css class of large modal
     */
    const SIZE_LARGE = "modal-lg";

    /**
     * The additional css class of small modal
     */
    const SIZE_SMALL = "modal-sm";

    /**
     * The additional css class of default modal
     */
    const SIZE_DEFAULT = "";

    /**
     * @var string the tile content in the modal window.
     */
    private $title;

    /**
     * @var array additional title options.
     *
     * {@see \Yiisoft\Html\Html::renderTagAttributes()} for details on how attributes are being rendered.
     */
    private $titleOptions = [];

    /**
     * @var array additional header options.
     *
     * {@see \Yiisoft\Html\Html::renderTagAttributes()} for details on how attributes are being rendered.
     */
    private $headerOptions = [];

    /**
     * @var array body options.
     *
     * {@see \Yiisoft\Html\Html::renderTagAttributes()} for details on how attributes are being rendered.
     */
    private $bodyOptions = [];

    /**
     * @var string the footer content in the modal window.
     */
    private $footer;

    /**
     * @var array additional footer options
     *
     * {@see \Yiisoft\Html\Html::renderTagAttributes()} for details on how attributes are being rendered.
     */
    private $footerOptions = [];

    /**
     * @var string the modal size. Can be {@see SIZE_LARGE} or {@see SIZE_SMALL}, or empty for default.
     */
    private $size;

    /**
     * @var array the options for rendering the close button tag.
     *
     * The close button is displayed in the header of the modal window. Clicking on the button will hide the modal
     * window. If {@see closeButtonEnabled} is false, no close button will be rendered.
     *
     * The following special options are supported:
     *
     * - tag: string, the tag name of the button. Defaults to 'button'.
     * - label: string, the label of the button. Defaults to '&times;'.
     *
     * The rest of the options will be rendered as the HTML attributes of the button tag. Please refer to the
     * [Modal plugin help](http://getbootstrap.com/javascript/#modals) for the supported HTML attributes.
     */
    private $closeButton = [];

    /**
     * @var boolean $closeButtonEnabled. Enable/Disable close button.
     */
    private $closeButtonEnabled = true;

    /**
     * @var array the options for rendering the toggle button tag.
     *
     * The toggle button is used to toggle the visibility of the modal window. If {@see toggleButtonEnabled} is false,
     * no toggle button will be rendered.
     *
     * The following special options are supported:
     *
     * - tag: string, the tag name of the button. Defaults to 'button'.
     * - label: string, the label of the button. Defaults to 'Show'.
     *
     * The rest of the options will be rendered as the HTML attributes of the button tag. Please refer to the
     * [Modal plugin help](http://getbootstrap.com/javascript/#modals) for the supported HTML attributes.
     */
    private $toggleButton = [];

    /**
     * @var boolean $toggleButtonEnabled. Enable/Disable toggle button.
     */
    private $toggleButtonEnabled = true;

    /**
     * @var array the HTML attributes for the widget container tag. The following special options are recognized:
     *
     * - tag: string, defaults to "nav", the name of the container tag.
     *
     * {@see \Yiisoft\Html\Html::renderTagAttributes()} for details on how attributes are being rendered.
     */
    private $options = [];

    /**
     * Initializes the widget.
     *
     * @return void
     *
     * @throws InvalidConfigException
     */
    public function init(): void
    {
        parent::init();

        if (!isset($this->options['id'])) {
            $this->options['id'] = "{$this->getId()}-modal";
        }

        $this->initOptions();

        echo $this->renderToggleButton() . "\n";
        echo Html::beginTag('div', $this->options) . "\n";
        echo Html::beginTag('div', ['class' => 'modal-dialog ' . $this->size]) . "\n";
        echo Html::beginTag('div', ['class' => 'modal-content']) . "\n";
        echo $this->renderHeader() . "\n";
        echo $this->renderBodyBegin() . "\n";
    }

    /**
     * Renders the widget.
     *
     * @return string
     */
    public function run(): string
    {
        echo "\n" . $this->renderBodyEnd();
        echo "\n" . $this->renderFooter();
        echo "\n" . Html::endTag('div'); // modal-content
        echo "\n" . Html::endTag('div'); // modal-dialog

        $this->registerPlugin('modal', $this->options);

        return "\n" . Html::endTag('div');
    }

    /**
     * Renders the header HTML markup of the modal.
     *
     * @return string the rendering result
     */
    protected function renderHeader(): string
    {
        $button = $this->renderCloseButton();

        if ($this->title !== null) {
            Html::addCssClass($this->titleOptions, ['widget' => 'modal-title']);
            $header = Html::tag('h5', $this->title, $this->titleOptions);
        } else {
            $header = '';
        }

        if ($button !== null) {
            $header .= "\n" . $button;
        } elseif ($header === '') {
            return '';
        }

        Html::addCssClass($this->headerOptions, ['widget' => 'modal-header']);

        return Html::tag('div', "\n" . $header . "\n", $this->headerOptions);
    }

    /**
     * Renders the opening tag of the modal body.
     *
     * @return string the rendering result
     */
    protected function renderBodyBegin(): string
    {
        Html::addCssClass($this->bodyOptions, ['widget' => 'modal-body']);

        return Html::beginTag('div', $this->bodyOptions);
    }

    /**
     * Renders the closing tag of the modal body.
     *
     * @return string the rendering result
     */
    protected function renderBodyEnd(): string
    {
        return Html::endTag('div');
    }

    /**
     * Renders the HTML markup for the footer of the modal.
     *
     * @return string the rendering result
     */
    protected function renderFooter($result = null): ?string
    {
        if ($this->footer !== null) {
            Html::addCssClass($this->footerOptions, ['widget' => 'modal-footer']);

            $result = Html::tag('div', "\n" . $this->footer . "\n", $this->footerOptions);
        }

        return $result;
    }

    /**
     * Renders the toggle button.
     *
     * @return string the rendering result
     */
    protected function renderToggleButton($result = null): ?string
    {
        if ($this->toggleButtonEnabled !== false) {
            $tag = ArrayHelper::remove($this->toggleButton, 'tag', 'button');
            $label = ArrayHelper::remove($this->toggleButton, 'label', 'Show');

            $result = Html::tag($tag, $label, $this->toggleButton);
        }

        return $result;
    }

    /**
     * Renders the close button.
     *
     * @return string the rendering result
     */
    protected function renderCloseButton($result = null): ?string
    {
        if ($this->closeButtonEnabled !== false) {
            $tag = ArrayHelper::remove($this->closeButton, 'tag', 'button');
            $label = ArrayHelper::remove($this->closeButton, 'label', Html::tag('span', '&times;', [
                'aria-hidden' => 'true'
            ]));

            $result = Html::tag($tag, $label, $this->closeButton);
        }

        return $result;
    }

    /**
     * Initializes the widget options.
     *
     * This method sets the default values for various options.
     */
    protected function initOptions(): void
    {
        $this->options = array_merge([
            'class' => 'fade',
            'role' => 'dialog',
            'tabindex' => -1,
            'aria-hidden' => 'true'
        ], $this->options);

        Html::addCssClass($this->options, ['widget' => 'modal']);

        if ($this->clientOptions !== false) {
            $this->clientOptions = array_merge(['show' => false], $this->clientOptions);
        }

        $this->titleOptions = array_merge([
            'id' => $this->options['id'] . '-label'
        ], $this->titleOptions);

        if (!isset($this->options['aria-label'], $this->options['aria-labelledby']) && $this->title !== null) {
            $this->options['aria-labelledby'] = $this->titleOptions['id'];
        }

        if ($this->closeButtonEnabled !== false) {
            $this->closeButton = array_merge([
                'data-dismiss' => 'modal',
                'class' => 'close',
                'type' => 'button',
            ], $this->closeButton);
        }

        if ($this->toggleButton !== array()) {
            $this->toggleButton = array_merge([
                'data-toggle' => 'modal',
                'type' => 'button'
            ], $this->toggleButton);
            if (!isset($this->toggleButton['data-target']) && !isset($this->toggleButton['href'])) {
                $this->toggleButton['data-target'] = '#' . $this->options['id'];
            }
        }
    }

    public function __toString(): string
    {
        return $this->run();
    }

    /**
     * {@see bodyOptions}
     *
     * @param array $bodyOptions
     *
     * @return $this
     */
    public function bodyOptions(array $value): self
    {
        $this->bodyOptions = $value;

        return $this;
    }

    /**
     * {@see closeButton}
     *
     * @param array $closeButton
     *
     * @return $this
     */
    public function closeButton(array $value): self
    {
        $this->closeButton = $value;

        return $this;
    }

    /**
     * {@see closeButtonEnabled}
     *
     * @param bool $closeButtonEnabled
     *
     * @return $this
     */
    public function closeButtonEnabled(bool $value): self
    {
        $this->closeButtonEnabled = $value;

        return $this;
    }

    /**
     * {@see footer}
     *
     * @param string $footer
     *
     * @return $this
     */
    public function footer(string $value): self
    {
        $this->footer = $value;

        return $this;
    }

    /**
     * {@see footerOptions}
     *
     * @param string $footerOptions
     *
     * @return $this
     */
    public function footerOptions(string $value): self
    {
        $this->footerOptions = $value;

        return $this;
    }

    /**
     * {@see headerOptions}
     *
     * @param array $headerOptions
     *
     * @return $this
     */
    public function headerOptions(array $value): self
    {
        $this->headerOptions = $value;

        return $this;
    }

    /**
     * {@see options}
     *
     * @param array $options
     *
     * @return $this
     */
    public function options(array $value): self
    {
        $this->options = $value;

        return $this;
    }

    /**
     * {@see title}
     *
     * @param string $title
     *
     * @return $this
     */
    public function title(string $value): self
    {
        $this->title = $value;

        return $this;
    }

    /**
     * {@see titleOptions}
     *
     * @param array $titleOptions
     *
     * @return $this
     */
    public function titleOptions(array $value): self
    {
        $this->titleOptions = $value;

        return $this;
    }

    /**
     * {@see toggleButton}
     *
     * @param array $toggleButton
     *
     * @return $this
     */
    public function toggleButton(array $value): self
    {
        $this->toggleButton = $value;

        return $this;
    }

    /**
     * {@see toggleButtonEnabled}
     *
     * @param bool $toggleButtonEnabled
     *
     * @return $this
     */
    public function toggleButtonEnabled(bool $value): self
    {
        $this->toggleButtonEnabled = $value;

        return $this;
    }

    /**
     * {@see size}
     *
     * @param string $size
     *
     * @return $this
     */
    public function size(string $value): self
    {
        $this->size = $value;

        return $this;
    }
}
