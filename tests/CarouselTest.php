<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Bootstrap4\Tests;

use Yiisoft\Yii\Bootstrap4\Carousel;

/**
 * Tests for Carousel widget.
 *
 * CarouselTest.
 */
final class CarouselTest extends TestCase
{
    public function testContainerOptions(): void
    {
        Carousel::counter(0);

        $html = Carousel::widget()
            ->items([
                [
                    'content' => '<img src="https://via.placeholder.com/800x400?text=First+slide" class="d-block w-100">',
                    'caption' => '<h5>First slide label</h5><p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p>',
                    'captionOptions' => [
                        'class' => ['d-none', 'd-md-block'],
                    ],
                ],
                [
                    'content' => '<img src="https://via.placeholder.com/800x400?text=Second+slide" class="d-block w-100">',
                    'caption' => '<h5>Second slide label</h5><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>',
                    'captionOptions' => [
                        'class' => ['d-none', 'd-md-block'],
                    ],
                ],
                [
                    'content' => '<img src="https://via.placeholder.com/800x400?text=Third+slide" class="d-block w-100">',
                    'caption' => '<h5>Third slide label</h5><p>Praesent commodo cursus magna, vel scelerisque nisl consectetur.</p>',
                    'captionOptions' => [
                        'class' => ['d-none', 'd-md-block'],
                    ],
                ],
            ])
            ->render();

        $expected = <<<HTML
<div id="w0-carousel" class="carousel slide" data-ride="carousel">
<ol class="carousel-indicators"><li class="active" data-target="#w0-carousel" data-slide-to="0"></li>
<li data-target="#w0-carousel" data-slide-to="1"></li>
<li data-target="#w0-carousel" data-slide-to="2"></li></ol>
<div class="carousel-inner"><div class="carousel-item active"><img src="https://via.placeholder.com/800x400?text=First+slide" class="d-block w-100">
<div class="d-none d-md-block carousel-caption"><h5>First slide label</h5><p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p></div></div>
<div class="carousel-item"><img src="https://via.placeholder.com/800x400?text=Second+slide" class="d-block w-100">
<div class="d-none d-md-block carousel-caption"><h5>Second slide label</h5><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p></div></div>
<div class="carousel-item"><img src="https://via.placeholder.com/800x400?text=Third+slide" class="d-block w-100">
<div class="d-none d-md-block carousel-caption"><h5>Third slide label</h5><p>Praesent commodo cursus magna, vel scelerisque nisl consectetur.</p></div></div></div>
<a class="carousel-control-prev" href="#w0-carousel" data-slide="prev" role="button"><span class="carousel-control-prev-icon" aria-hidden="true"></span><span class="sr-only">Previous</span></a>
<a class="carousel-control-next" href="#w0-carousel" data-slide="next" role="button"><span class="carousel-control-next-icon" aria-hidden="true"></span><span class="sr-only">Next</span></a>
</div>

HTML;

        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testCrossfade(): void
    {
        Carousel::counter(0);

        $html = Carousel::widget()
            ->crossfade(true)
            ->items([
                [
                    'content' => '<img src="https://via.placeholder.com/800x400?text=First+slide" class="d-block w-100">',
                    'caption' => '<h5>First slide label</h5><p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p>',
                    'captionOptions' => [
                        'class' => ['d-none', 'd-md-block'],
                    ],
                ],
                [
                    'content' => '<img src="https://via.placeholder.com/800x400?text=Second+slide" class="d-block w-100">',
                    'caption' => '<h5>Second slide label</h5><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>',
                    'captionOptions' => [
                        'class' => ['d-none', 'd-md-block'],
                    ],
                ],
                [
                    'content' => '<img src="https://via.placeholder.com/800x400?text=Third+slide" class="d-block w-100">',
                    'caption' => '<h5>Third slide label</h5><p>Praesent commodo cursus magna, vel scelerisque nisl consectetur.</p>',
                    'captionOptions' => [
                        'class' => ['d-none', 'd-md-block'],
                    ],
                ],
            ])
            ->render();

        $this->assertStringContainsString('class="carousel slide carousel-fade"', $html);
    }
}
