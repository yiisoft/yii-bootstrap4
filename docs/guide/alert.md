## Class Yiisoft\Yii\Bootstrap4\Alert
Renders a [Bootstrap alert component](https://getbootstrap.com/docs/4.5/components/alerts/).

### Usage

```php
use Yiisoft\Yii\Bootstrap4\Alert;

echo Alert::widget()
    ->options([
        'class' => 'alert-info',
    ])
    ->body('Say hello...');
```
