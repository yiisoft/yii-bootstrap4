<?php

namespace Yiisoft\Yii\Bootstrap4\Tests\Data;

use Yiisoft\Yii\Bootstrap4\ActiveField;

/**
 * A customized extension from ActiveField
 *
 * @see \Yiisoft\Yii\Bootstrap4\Tests\ActiveFieldTest::testHorizontalCssClassesOverride()
 *
 * @author Michael Härtl <haertl.mike@gmail.com>
 */
class ExtendedActiveField extends ActiveField
{
    public $horizontalCssClasses = [
        'offset' => 'col-md-offset-4',
        'label' => 'col-md-4',
        'wrapper' => 'col-md-6',
        'error' => 'col-md-3',
        'hint' => 'col-md-3',
    ];
}
