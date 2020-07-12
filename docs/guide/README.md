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

This [Yii Framework] extension encapsulates [Twitter Bootstrap 4] components and plugins in terms of Yii widgets, and thus makes using Bootstrap components/plugins in Yii applications extremely easy.

[Yii Framework]:        http://www.yiiframework.com/
[Twitter Bootstrap 4]:  https://getbootstrap.com/docs/4.1/getting-started/introduction/

The extension includes support for the [Bootstrap 4](http://getbootstrap.com/) markup and components framework
(also known as "Twitter Bootstrap"). Bootstrap is an excellent, responsive framework that can greatly speed up the
client-side of your development process.

The core of Bootstrap is represented by two parts:

- CSS basics, such as a grid layout system, typography, helper classes, and responsive utilities.
- Ready to use components, such as forms, menus, pagination, modal boxes, tabs etc.

- [Installation](#installation)
- [Using Assets](#using-assets)
    - [Basic Usage](#basic-usage)
    - [Register asset in view layout or individual view](#register-asset-in-view-layout-or-individual-view)
    - [Register asset in application params](#register-asset-in-application-params)
- [Widgets Usage](#widgets-usage)
    - [Yiisoft\Yii\Bootstrap4\Accordion]()
    - [Yiisoft\Yii\Bootstrap4\ActiveField]()
    - [Yiisoft\Yii\Bootstrap4\ActiveForm]()
    - [Yiisoft\Yii\Bootstrap4\Alert]()
    - [Yiisoft\Yii\Bootstrap4\Breadcrumbs]()
    - [Yiisoft\Yii\Bootstrap4\Button](button.md)
    - [Yiisoft\Yii\Bootstrap4\ButtonDropdown]()
    - [Yiisoft\Yii\Bootstrap4\ButtonGroup]()
    - [Yiisoft\Yii\Bootstrap4\ButtonToolbar]()
    - [Yiisoft\Yii\Bootstrap4\Carousel]()
    - [Yiisoft\Yii\Bootstrap4\Dropdown]()
    - [Yiisoft\Yii\Bootstrap4\Modal]()
    - [Yiisoft\Yii\Bootstrap4\Nav]()
    - [[Yiisoft\Yii\Bootstrap4\NavBar]()
    - [Yiisoft\Yii\Bootstrap4\Progress](progress.md)
    - [Yiisoft\Yii\Bootstrap4\Tabs]()
    - [Yiisoft\Yii\Bootstrap4\ToggleButtonGroup]()
    
## Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

```php 
composer require yiisoft/yii-bootstrap4
```
## Using assets
Bootstrap is a complex front-end solution, which includes CSS, JavaScript, fonts and so on. In order to allow you the most flexible control over Bootstrap components, this extension provides two asset bundles

- [BootstrapAsset:](https://getbootstrap.com/) CSS, SASS, JS  files.
- [JqueryAsset:](https://jquery.com)  Provides the jQuery JavaScript library

To use widgets only, register `BootstrapAsset::class`, which we can do in several ways explained below.

### Basic Usage
Yii provides a convenient way to include bootstrap assets in your pages with a single line added to `AppAsset.php` located in your
`@app/Asset` directory:

```php
public $depends = [
    'Yiisoft\Yii\Bootstrap4\BootstrapAsset',
];
```

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

## Widgets usage

Most complex bootstrap components are wrapped into Yii widgets to allow more robust syntax and integrate with
framework features. All widgets belong to `\Yiisoft\Yii\Bootstrap4` namespace:

- [Yiisoft\Yii\Bootstrap4\Accordion]
- [Yiisoft\Yii\Bootstrap4\ActiveField]
- [Yiisoft\Yii\Bootstrap4\ActiveForm]
- [Yiisoft\Yii\Bootstrap4\Alert]
- [Yiisoft\Yii\Bootstrap4\Breadcrumbs]
- [Yiisoft\Yii\Bootstrap4\Button]
- [Yiisoft\Yii\Bootstrap4\ButtonDropdown]
- [Yiisoft\Yii\Bootstrap4\ButtonGroup]
- [Yiisoft\Yii\Bootstrap4\ButtonToolbar]
- [Yiisoft\Yii\Bootstrap4\Carousel]
- [Yiisoft\Yii\Bootstrap4\Dropdown]
- [Yiisoft\Yii\Bootstrap4\Modal]
- [Yiisoft\Yii\Bootstrap4\Nav]
- [[Yiisoft\Yii\Bootstrap4\NavBar]
- [Yiisoft\Yii\Bootstrap4\Progress]
- [Yiisoft\Yii\Bootstrap4\Tabs]
- [Yiisoft\Yii\Bootstrap4\ToggleButtonGroup]
