<p align="center">
    <a href="https://github.com/yiisoft" target="_blank">
        <img src="https://avatars0.githubusercontent.com/u/993323" height="80px">
    </a>
    <a href="http://getbootstrap.com/" target="_blank" rel="external">
        <img src="https://v4-alpha.getbootstrap.com/assets/brand/bootstrap-solid.svg" height="80px">
    </a>
    <h1 align="center">Yii Framework Twitter Bootstrap 4 Extension</h1>
    <br>
</p>

This [Yii Framework] extension encapsulates [Twitter Bootstrap 4] components
and plugins in terms of Yii widgets, and thus makes using Bootstrap components/plugins
in Yii applications extremely easy.

[Yii Framework]:        http://www.yiiframework.com/
[Twitter Bootstrap 4]:  https://getbootstrap.com/docs/4.1/getting-started/introduction/

For license information check the [LICENSE](LICENSE.md)-file.

Documentation is at [docs/guide/README.md](docs/guide/README.md).

[![Latest Stable Version](https://poser.pugx.org/yiisoft/yii-bootstrap4/v/stable.png)](https://packagist.org/packages/yiisoft/yii-bootstrap4)
[![Total Downloads](https://poser.pugx.org/yiisoft/yii-bootstrap4/downloads.png)](https://packagist.org/packages/yiisoft/yii-bootstrap4)
[![Build status](https://github.com/yiisoft/yii-bootstrap4/workflows/build/badge.svg)](https://github.com/yiisoft/yii-bootstrap4/actions?query=workflow%3Abuild)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/yiisoft/yii-bootstrap4/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/yiisoft/yii-bootstrap4/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/yiisoft/yii-bootstrap4/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/yiisoft/yii-bootstrap4/?branch=master)
[![Mutation testing badge](https://img.shields.io/endpoint?style=flat&url=https%3A%2F%2Fbadge-api.stryker-mutator.io%2Fgithub.com%2Fyiisoft%2Fyii-bootstrap4%2Fmaster)](https://dashboard.stryker-mutator.io/reports/github.com/yiisoft/yii-bootstrap4/master)
[![static analysis](https://github.com/yiisoft/yii-bootstrap4/workflows/static%20analysis/badge.svg)](https://github.com/yiisoft/yii-bootstrap4/actions?query=workflow%3A%22static+analysis%22)

### Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

```php 
composer require yiisoft/yii-bootstrap4
```

Bootstrap is a complex front-end solution, which includes CSS, JavaScript, fonts and so on. In order to allow you the most flexible control over Bootstrap components, this extension provides two asset bundles

- [BootstrapAsset:](https://getbootstrap.com/) CSS, SASS, JavsScript files
- [JqueryAsset:](https://jquery.com)  Provides the jQuery JavaScript library

To use widgets only, register `BootstrapAsset::class`, which we can do in several ways explained below.

### Register asset in view layout or individual view

By registering the Asset in the `resources/layout/main.php` it will be available for all views. If you need it registered for individual view (such as `resources/views/site/contact.php`) only, register it in that view.


```php
use  Yiisoft\Yii\Bootstrap4\Assets\BootstrapAsset;

/**
 * @var Yiisoft\Assets\AssetManager $assetManager
 * @var Yiisoft\View\WebView $this
 */

$assetManager->register([
    BootstrapAsset::class,
]);

$this->setCssFiles($assetManager->getCssFiles());
$this->setJsFiles($assetManager->getJsFiles());
```

### Register asset in application params

You can register asset in the application parameters, `config/params.php`. Asset will be available for all views of this application.

```php
use  Yiisoft\Yii\Bootstrap4\Assets\BootstrapAsset;

'yiisoft/asset' => [
    'assetManager' => [
        'register' => [
            BootstrapAsset::class
        ],
    ],
],
```

Then in `main.php`:

```php
/* @var Yiisoft\View\WebView $this */

$this->setCssFiles($assetManager->getCssFiles());
$this->setJsFiles($assetManager->getJsFiles());
```

### Widgets usage

Most complex bootstrap components are wrapped into Yii widgets to allow more robust syntax and integrate with
framework features. All widgets belong to `\Yiisoft\Yii\Bootstrap4` namespace:

- [[Yiisoft\Yii\Bootstrap4\Accordion|Accordion]]
- [[Yiisoft\Yii\Bootstrap4\ActiveField|ActiveField]]
- [[Yiisoft\Yii\Bootstrap4\ActiveForm|ActiveForm]]
- [[Yiisoft\Yii\Bootstrap4\Alert|Alert]]
- [[Yiisoft\Yii\Bootstrap4\Breadcrumbs|Breadcrumbs]]
- [[Yiisoft\Yii\Bootstrap4\Button|Button]]
- [[Yiisoft\Yii\Bootstrap4\ButtonDropdown|ButtonDropdown]]
- [[Yiisoft\Yii\Bootstrap4\ButtonGroup|ButtonGroup]]
- [[Yiisoft\Yii\Bootstrap4\ButtonToolbar|ButtonToolbar]]
- [[Yiisoft\Yii\Bootstrap4\Carousel|Carousel]]
- [[Yiisoft\Yii\Bootstrap4\Dropdown|Dropdown]]
- [[Yiisoft\Yii\Bootstrap4\Modal|Modal]]
- [[Yiisoft\Yii\Bootstrap4\Nav|Nav]]
- [[Yiisoft\Yii\Bootstrap4\NavBar|NavBar]]
- [[Yiisoft\Yii\Bootstrap4\Progress|Progress]]
- [[Yiisoft\Yii\Bootstrap4\Tabs|Tabs]]
- [[Yiisoft\Yii\Bootstrap4\ToggleButtonGroup|ToggleButtonGroup]]

### Unit testing

The package is tested with [PHPUnit](https://phpunit.de/). To run tests:

```php
./vendor/bin/phpunit
```

### Mutation testing

The package tests are checked with [Infection](https://infection.github.io/) mutation framework. To run it:

```php
./vendor/bin/infection
```

### Static analysis

The code is statically analyzed with [Phan](https://github.com/phan/phan/wiki). To run static analysis:

```php
./vendor/bin/phan
```
********
