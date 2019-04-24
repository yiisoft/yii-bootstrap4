HTML helper
===========

Bootstrap führt viele konsistente HTML Strukturen ein, welche es erlauben, verschiedene visuelle Effekte einfach zu verwenden.
Ausschliesslich die komplexesten von ihnen sind mittels Widgets in dieser Erweiterung umgesetzt worden. Der Rest kann manuell
mittels HTML zusammengestellt werden.
Einige spezielle Bootstrap Markups sind implementiert im [[\Yiisoft\Yii\Bootstrap4\Html]]-Helper.
Die [[\Yiisoft\Yii\Bootstrap4\Html]]-Klasse ist eine Erweiterung der regulären [[\yii\helpers\Html]]-Klasse mit Anpassungen zur 
Verwendung mit Bootstrap. Sie bietet verschiedene nützliche Methoden.

Die [[\Yiisoft\Yii\Bootstrap4\Html]]-Klasse erbt von der [[\yii\helpers\Html]]-Klasse und ersetzt diese dadurch vollumfänglich.
Sie benötigen folglich **nicht** beide in Ihren Views.
Beispiel:

```php
<?php
use Yiisoft\Yii\Bootstrap4\Button;
use Yiisoft\Yii\Bootstrap4\Html;
?>
<?= Button::widget([
    'label' => Html::tag('i', ['class' => 'fas fa-check']) . Html::encode('Save & apply'),
    'encodeLabel' => false,
    'options' => ['class' => 'btn-primary'],
]); ?>
```

> Vorsicht: Verwechseln Sie [[\Yiisoft\Yii\Bootstrap4\Html]] und [[\yii\helpers\Html]] Klassen nicht und bedenken Sie jeweils 
  welche Sie in Ihren Views verwenden.
