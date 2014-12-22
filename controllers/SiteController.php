<?php

namespace app\controllers;

class SiteController extends \yii\web\Controller {

    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
            ],
        ];
    }

    public function actionIndex() {
        return $this->render('index');
    }

}
