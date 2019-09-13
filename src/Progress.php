<?php
declare(strict_types = 1);

namespace Yiisoft\Yii\Bootstrap4;

use Yiisoft\Arrays\ArrayHelper;
use Yiisoft\Yii\Bootstrap4\Exception\InvalidConfigException;

/**
 * Progress renders a bootstrap progress bar component.
 *
 * For example,
 *
 * ```php
 * // default with label
 * echo Progress::widget()
 *     ->percent('60')
 *     ->label(test);
 *
 * // styled
 * echo Progress::widget()
 *     ->bars([
 *         ['percent' => '65', 'options' => ['class' => 'bg-danger']]
 *     ]);
 *
 * // striped
 * echo Progress::widget()
 *     ->'bars'([
 *         ['percent' => '70', 'options' => ['class' => 'bg-warning progress-bar-striped']]
 *     ]);
 *
 * // striped animated
 * echo Progress::widget()
 *     ->percent('70')
 *     ->options'(['class' => 'bg-success progress-bar-animated progress-bar-striped']);
 *
 * // stacked bars
 * echo Progress::widget()
 *     'bars' => ([
 *         ['percent' => '30', 'options' => ['class' => 'bg-danger']],
 *         ['percent' => '30', 'label' => 'test', 'options' => ['class' => 'bg-success']],
 *         ['percent' => '35', 'options' => ['class' => 'bg-warning']],
 *     ]);
 * ```
 */
class Progress extends Widget
{
    /**
     * @var string the button label.
     */
    private $label;

    /**
     * @var int the amount of progress as a percentage.
     */
    private $percent = 0;

    /**
     * @var array a set of bars that are stacked together to form a single progress bar.
     *
     * Each bar is an array of the following structure:
     *
     * ```php
     * [
     *     // required, the amount of progress as a percentage.
     *     'percent' => 30,
     *     // optional, the label to be displayed on the bar
     *     'label' => '30%',
     *     // optional, array, additional HTML attributes for the bar tag
     *     'options' => [],
     * ]
     * ```
     */
    private $bars;

    /**
     * @var array the HTML attributes for the widget container tag. The following special options are recognized:
     *
     * - tag: string, defaults to "nav", the name of the container tag.
     *
     * {@see \Yiisoft\Html\Html::renderTagAttributes()} for details on how attributes are being rendered.
     */
    private $options = [];

    /**
     * Renders the widget.
     *
     * @return string
     */
    public function getContent(): string
    {
        if (!isset($this->options['id'])) {
            $this->options['id'] = "{$this->getId()}-progress";
        }

        Html::addCssClass($this->options, ['widget' => 'progress']);

        BootstrapAsset::register($this->getView());

        return $this->renderProgress();
    }

    /**
     * Renders the progress.
     *
     * @return string the rendering result.
     *
     * @throws InvalidConfigException if the "percent" option is not set in a stacked progress bar.
     */
    protected function renderProgress(): string
    {
        $out = Html::beginTag('div', $this->options) . "\n";

        if (empty($this->bars)) {
            $this->bars = [
                ['label' => $this->label, 'percent' => $this->percent, 'options' => $this->barOptions]
            ];
        }

        $bars = [];

        foreach ($this->bars as $bar) {
            $label = ArrayHelper::getValue($bar, 'label', '');
            if (!isset($bar['percent'])) {
                throw new InvalidConfigException("The 'percent' option is required.");
            }
            $options = ArrayHelper::getValue($bar, 'options', []);
            $bars[] = $this->renderBar($bar['percent'], $label, $options);
        }

        $out .= implode("\n", $bars) . "\n";
        $out .= Html::endTag('div');

        return $out;
    }

    /**
     * Generates a bar.
     *
     * @param int $percent the percentage of the bar
     * @param string $label , optional, the label to display at the bar
     * @param array $options the HTML attributes of the bar
     *
     * @return string the rendering result.
     */
    protected function renderBar($percent, $label = '', $options = []): string
    {
        $valuePercent = (float)trim(rtrim($percent, '%'));

        $options = array_merge($options, [
            'role' => 'progressbar',
            'aria-valuenow' => $percent,
            'aria-valuemin' => 0,
            'aria-valuemax' => 100
        ]);

        Html::addCssClass($options, ['widget' => 'progress-bar']);
        Html::addCssStyle($options, ['width' => $valuePercent . '%'], true);

        return Html::tag('div', $label, $options);
    }

    public function __toString(): string
    {
        return $this->run();
    }

    /**
     * {@see bars}
     *
     * @param array $bars
     *
     * @return $this
     */
    public function bars(array $value): self
    {
        $this->bars = $value;

        return $this;
    }

    /**
     * {@see barOptions}
     *
     * @param array $barOptions
     *
     * @return $this
     */
    public function barOptions(array $value): self
    {
        $this->barOptions = $value;

        return $this;
    }

    /**
     * {@see label}
     *
     * @param string $label
     *
     * @return $this
     */
    public function label(string $value): self
    {
        $this->label = $value;

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
     * {@see percent}
     *
     * @param string $percent
     *
     * @return $this
     */
    public function percent(string $value): self
    {
        $this->percent = $value;

        return $this;
    }
}
