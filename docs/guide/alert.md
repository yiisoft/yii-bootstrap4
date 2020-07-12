## Class Yiisoft\Yii\Bootstrap4\Alert
Alert renders an alert bootstrap component.

### Example

```php
use Yiisoft\Yii\Bootstrap4\Alert;

echo Alert::widget()
    ->options([
        'class' => 'alert-info',
    ])
    ->body('Say hello...');
```
