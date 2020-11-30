<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Bootstrap4\Tests;

use Yiisoft\Yii\Bootstrap4\Nav;
use Yiisoft\Yii\Bootstrap4\NavBar;

/**
 * Tests for NavBar widget.
 *
 * NavBarTest
 */
final class NavBarTest extends TestCase
{
    public function testRender(): void
    {
        NavBar::counter(0);

        $html = NavBar::widget()
            ->brandLabel('My Company')
            ->brandUrl('/')
            ->options([
                'class' => 'navbar-inverse navbar-static-top navbar-frontend',
            ])
            ->begin();

        $html .= NavBar::end();

        $expected = <<<EXPECTED
<nav id="w0-navbar" class="navbar-inverse navbar-static-top navbar-frontend navbar">
<div class="container">
<a class="navbar-brand" href="/">My Company</a>
<button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#w0-collapse" aria-controls="w0-collapse" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
<div id="w0-collapse" class="collapse navbar-collapse">
</div>
</div>
</nav>
EXPECTED;

        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testBrandImage(): void
    {
        NavBar::counter(0);

        $html = NavBar::widget()
            ->brandImage('/images/test.jpg')
            ->brandUrl('/')
            ->begin();

        $html .= NavBar::end();

        $this->assertStringContainsString(
            '<a class="navbar-brand" href="/"><img src="/images/test.jpg" alt=""></a>',
            $html
        );
    }

    public function testBrandLink(): void
    {
        NavBar::counter(0);

        $html = NavBar::widget()
            ->brandLabel('Yii Framework')
            ->brandUrl('/index.php')
            ->begin();

        $html .= NavBar::end();

        $this->assertStringContainsString(
            '<a class="navbar-brand" href="/index.php">Yii Framework</a>',
            $html
        );
    }

    public function testBrandSpan(): void
    {
        NavBar::counter(0);

        $html = NavBar::widget()
            ->brandLabel('Yii Framework')
            ->brandUrl('')
            ->begin();

        $html .= NavBar::end();

        $this->assertStringContainsString(
            '<span class="navbar-brand">Yii Framework</span>',
            $html
        );
    }

    public function testNavAndForm(): void
    {
        NavBar::counter(0);

        $html = NavBar::widget()
            ->brandLabel('My Company')
            ->brandUrl('/')
            ->begin();

        $html .= Nav::widget()
            ->items([
                ['label' => 'Home', 'url' => '#'],
                ['label' => 'Link', 'url' => '#'],
                ['label' => 'Dropdown', 'items' => [
                    ['label' => 'Action', 'url' => '#'],
                    ['label' => 'Another action', 'url' => '#'],
                    '-',
                    ['label' => 'Something else here', 'url' => '#'],
                ],
                ],
            ])
            ->options(['class' => ['mr-auto']])
            ->render();

        $html .= <<<HTML
<form class="form-inline my-2 my-lg-0">
<input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
</form>
HTML;

        $html .= NavBar::end();

        $expected = <<<EXPECTED
<nav id="w0-navbar" class="navbar navbar-expand-lg navbar-light bg-light">
<div class="container">
<a class="navbar-brand" href="/">My Company</a>
<button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#w0-collapse" aria-controls="w0-collapse" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
<div id="w0-collapse" class="collapse navbar-collapse">
<ul id="w1-nav" class="mr-auto nav"><li class="nav-item"><a class="nav-link" href="#">Home</a></li>
<li class="nav-item"><a class="nav-link" href="#">Link</a></li>
<li class="dropdown nav-item"><a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown">Dropdown</a><div id="w2-dropdown" class="dropdown-menu"><a class="dropdown-item" href="#">Action</a>
<a class="dropdown-item" href="#">Another action</a>
<div class="dropdown-divider"></div>
<a class="dropdown-item" href="#">Something else here</a></div></li></ul><form class="form-inline my-2 my-lg-0">
<input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
</form></div>
</div>
</nav>
EXPECTED;

        $this->assertEqualsWithoutLE($expected, $html);
    }
}
