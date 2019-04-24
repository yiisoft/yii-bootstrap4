资源包
=============

Bootstrap是一个复杂的前端解决方案，其中包括 CSS ， JavaScript ，字体等。
为了灵活的控制 Bootstrap 组件，此扩展提供了多个资源包。
如下:

- [[Yiisoft\Yii\Bootstrap4\BootstrapAsset|BootstrapAsset]] - 只包含主要的 CSS 文件.
- [[Yiisoft\Yii\Bootstrap4\BootstrapPluginAsset|BootstrapPluginAsset]] - 包含 javascript 文件, 依赖于 [[Yiisoft\Yii\Bootstrap4\BootstrapAsset]] .

特定的应用可能需要加载不同的资源包，（或者资源包组合）.
如果只需要 CSS 文件, 引入 [[Yiisoft\Yii\Bootstrap4\BootstrapAsset]] 即可. 但是, 如果需要使用 Bootstrap 的 JavaScript, 则需要引入 [[Yiisoft\Yii\Bootstrap4\BootstrapPluginAsset]].

> 提示：大多数小部件会自动注册到 [[Yiisoft\Yii\Bootstrap4\BootstrapPluginAsset]] 。
