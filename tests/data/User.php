<?php
/**
 * @package yii2-bootstrap
 * @author Simon Karlen <simi.albi@gmail.com>
 */
namespace yii\bootstrap4\tests\data;

use yii\base\Model;

class User extends Model
{
    public $firstName;
    public $lastName;
    public $username;
    public $password;
    /**
     * {@inheritdoc}
     */
    public function attributeHints()
    {
        return [
            'username' => 'Your username must be at least 4 characters long',
            'password' => 'Your password must be 8-20 characters long, contain letters and numbers, and must not contain spaces, special characters, or emoji.'
        ];
    }
}
