## Class Yiisoft\Yii\Bootstrap4\Dropdown
Renders a [Bootstrap Dropdown menu component](https://getbootstrap.com/docs/4.5/components/dropdowns/).

### Usage

```php
<?php 
    declare(strict_types=1);

    use Yiisoft\Yii\Bootstrap4\Dropdown; 
?>

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
