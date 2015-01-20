<?php
namespace app\models;

class SigninForm extends \yii\base\Model{
    public $username;
    public $password;
    
    public function rules()
    {
        return [
            [['username', 'password'], 'required'],
        ];
    }

}