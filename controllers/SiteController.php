<?php

namespace app\controllers;

class SiteController extends \yii\web\Controller {

    public function init() {
        parent::init();
        $this->layout = 'empty';
    }

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
        if (\Yii::$app->session->get('signed') != null) {
            return $this->redirect(['question/list']);
        } else {
            return $this->redirect(['site/signin']);
        }
    }

    public function actionSignin() {
        $this->view->title = "Đăng nhập hệ thống";
        $error = null;
        $model = new \app\models\SigninForm();

        if ($model->load(\Yii::$app->request->post())) {
            if ($model->username == 'admin' && $model->password == 'admin') {
                \Yii::$app->session->set('signed', true);
                return $this->redirect(['question/list']);
            } else {
                $error = 'Sai thông tin đăng nhập';
            }
        }

        return $this->render('signin', ['model' => $model, 'error' => $error]);
    }

}
