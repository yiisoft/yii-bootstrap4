## Class Yiisoft\Yii\Bootstrap4\Alert
Renders a [Bootstrap Alert component](https://getbootstrap.com/docs/4.5/components/alerts/).

### Usage

```php
declare(strict_types=1);

use Yiisoft\Yii\Bootstrap4\Alert;

echo Alert::widget()
    ->options([
        'class' => 'alert-info',
    ])
    ->body('Say hello...');
```
