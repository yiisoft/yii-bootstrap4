<p align="center">
    <a href="https://github.com/yiisoft" target="_blank">
        <img src="https://yiisoft.github.io/docs/images/yii_logo.svg" height="80px">
    </a>
    <a href="http://getbootstrap.com/" target="_blank" rel="external">
        <img src="https://v4-alpha.getbootstrap.com/assets/brand/bootstrap-solid.svg" height="80px">
    </a>
    <h1 align="center">Yii Framework Twitter Bootstrap 4 Extension</h1>
    <br>
</p>

> ⚠️ Please do not start new projects with Bootstrap 4. There is [Bootstrap 5 package available](https://github.com/yiisoft/yii-bootstrap5).

This [Yii Framework] extension encapsulates [Twitter Bootstrap 4] components
and plugins in terms of Yii widgets, and thus makes using Bootstrap components/plugins
in Yii applications extremely easy.

[Yii Framework]:        http://www.yiiframework.com/
[Twitter Bootstrap 4]:  https://getbootstrap.com/docs/4.1/getting-started/introduction/

Documentation is at [docs/guide/README.md](docs/guide/README.md).

[![Latest Stable Version](https://poser.pugx.org/yiisoft/yii-bootstrap4/v/stable.png)](https://packagist.org/packages/yiisoft/yii-bootstrap4)
[![Total Downloads](https://poser.pugx.org/yiisoft/yii-bootstrap4/downloads.png)](https://packagist.org/packages/yiisoft/yii-bootstrap4)
[![Build status](https://github.com/yiisoft/yii-bootstrap4/workflows/build/badge.svg)](https://github.com/yiisoft/yii-bootstrap4/actions?query=workflow%3Abuild)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/yiisoft/yii-bootstrap4/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/yiisoft/yii-bootstrap4/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/yiisoft/yii-bootstrap4/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/yiisoft/yii-bootstrap4/?branch=master)
[![Mutation testing badge](https://img.shields.io/endpoint?style=flat&url=https%3A%2F%2Fbadge-api.stryker-mutator.io%2Fgithub.com%2Fyiisoft%2Fyii-bootstrap4%2Fmaster)](https://dashboard.stryker-mutator.io/reports/github.com/yiisoft/yii-bootstrap4/master)
[![static analysis](https://github.com/yiisoft/yii-bootstrap4/workflows/static%20analysis/badge.svg)](https://github.com/yiisoft/yii-bootstrap4/actions?query=workflow%3A%22static+analysis%22)
[![type-coverage](https://shepherd.dev/github/yiisoft/yii-bootstrap4/coverage.svg)](https://shepherd.dev/github/yiisoft/yii-bootstrap4)

### Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

```
composer require yiisoft/yii-bootstrap4
```

### Usage

For example, the following
single line of code in a view file would render a Bootstrap Progress plugin:

```php
<?= Progress::widget()->percent('60')->label(test); ?>
```
Read [Documentation](docs/guide/README.md) for more information

### Unit testing

The package is tested with [PHPUnit](https://phpunit.de/). To run tests:

```shell
./vendor/bin/phpunit
```

### Mutation testing

The package tests are checked with [Infection](https://infection.github.io/) mutation framework. To run it:

```shell
./vendor/bin/infection
```

### Static analysis

The code is statically analyzed with [Psalm](https://psalm.dev/). To run static analysis:

```shell
./vendor/bin/psalm
```

### Support the project

[![Open Collective](https://img.shields.io/badge/Open%20Collective-sponsor-7eadf1?logo=open%20collective&logoColor=7eadf1&labelColor=555555)](https://opencollective.com/yiisoft)

### Follow updates

[![Official website](https://img.shields.io/badge/Powered_by-Yii_Framework-green.svg?style=flat)](https://www.yiiframework.com/)
[![Twitter](https://img.shields.io/badge/twitter-follow-1DA1F2?logo=twitter&logoColor=1DA1F2&labelColor=555555?style=flat)](https://twitter.com/yiiframework)
[![Telegram](https://img.shields.io/badge/telegram-join-1DA1F2?style=flat&logo=telegram)](https://t.me/yii3en)
[![Facebook](https://img.shields.io/badge/facebook-join-1DA1F2?style=flat&logo=facebook&logoColor=ffffff)](https://www.facebook.com/groups/yiitalk)
[![Slack](https://img.shields.io/badge/slack-join-1DA1F2?style=flat&logo=slack)](https://yiiframework.com/go/slack)

## License

The Yii Framework Twitter Bootstrap 4 Extension is free software. It is released under the terms of the BSD License.
Please see [`LICENSE`](./LICENSE.md) for more information.

Maintained by [Yii Software](https://www.yiiframework.com/).
