## Class Yiisoft\Yii\Bootstrap4\Progress
Renders a [Bootstrap dropdown menu component](https://getbootstrap.com/docs/4.5/components/dropdowns/).

### Usage

```php
<div class="dropdown">
    <?php
        echo Dropdown::widget()
            ->items([
                ['label' => 'DropdownA', 'url' => '/'],
                ['label' => 'DropdownB', 'url' => '#'],
            ]);
    ?>
</div>
```
