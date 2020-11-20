<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Bootstrap4\Tests;

use Yiisoft\Yii\Bootstrap4\Progress;

/**
 * Tests for Progress widget.
 *
 * ProgressTest.
 */
final class ProgressTest extends TestCase
{
    public function testSimpleRender(): void
    {
        Progress::counter(0);

        $html = Progress::widget()
            ->label('Progress')
            ->percent('25')
            ->barOptions(['class' => 'bg-warning'])
            ->render();

        $expected = <<<HTML
<div id="w0-progress" class="progress">
<div class="bg-warning progress-bar" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: 25%;">Progress</div>
</div>
HTML;

        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testRender(): void
    {
        Progress::counter(0);

        $html = Progress::widget()
            ->bars([
                ['label' => 'Progress', 'percent' => '25'],
            ])
            ->render();

        $expected = <<<HTML
<div id="w0-progress" class="progress">
<div class="progress-bar" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: 25%;">Progress</div>
</div>
HTML;

        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testMultiple(): void
    {
        Progress::counter(0);

        $html = Progress::widget()
            ->bars([
                ['label' => '', 'percent' => '15'],
                ['label' => '', 'percent' => '30', 'options' => ['class' => ['bg-success']]],
                ['label' => '', 'percent' => '20', 'options' => ['class' => ['bg-info']]],
            ])
            ->render();

        $expected = <<<HTML
<div id="w0-progress" class="progress">
<div class="progress-bar" role="progressbar" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100" style="width: 15%;"></div>
<div class="bg-success progress-bar" role="progressbar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" style="width: 30%;"></div>
<div class="bg-info progress-bar" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%;"></div>
</div>
HTML;

        $this->assertEqualsWithoutLE($expected, $html);
    }
}
