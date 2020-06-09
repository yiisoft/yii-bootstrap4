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
[![static analysis with phan](https://github.com/yiisoft/yii-bootstrap4/workflows/static%20analysis%20with%20phan/badge.svg)](https://github.com/yiisoft/yii-bootstrap4/actions?query=workflow%3A%22static+analysis+with+phan%22)


Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

```
php composer.phar require --prefer-dist yiisoft/yii-bootstrap4
```

Usage
----

For example, the following
single line of code in a view file would render a Bootstrap Progress plugin:

```php
<?= Yiisoft\Yii\Bootstrap4\Progress::widget(['percent' => 60, 'label' => 'test']) ?>
```
