<?php

namespace Yiisoft\Yii\Bootstrap4\Tests\Data;

use yii\base\Model;

/**
 * Class Singer
 *
 * @author Daniel Gomez Pan <pana_1990@hotmail.com>
 */
class Singer extends Model
{
    public $firstName;
    public $lastName;
    public $test;

    public function rules()
    {
        return [
            [['lastName'], 'default', 'value' => 'Lennon'],
            [['lastName'], 'required'],
            [['underscore_style'], '\yii\captcha\CaptchaValidator'],
            [['test'], 'required', 'when' => function ($model) {
                return $model->firstName === 'cebe';
            }],
        ];
    }
}
