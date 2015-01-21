<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\controllers;

/**
 * Description of PlayController
 *
 * @author ThienPhu
 */
class PlayController extends \yii\web\Controller {

    public function actionIndex($name) {

        session_start();
        $this->layout = 'empty';
        $this->view->title = 'Làm trắc nghiệm';

        $player = \app\models\Player::findOne(['id' => session_id()]);
        if ($player == null) {
            if (\app\models\Player::find()->where(['name' => $name])->one() != null) {
                \Yii::$app->session->setFlash('error', 'Tên đã được người khác chọn, xin chọn lại!');
                return $this->redirect(['site/signin']);
            }
            $player = new \app\models\Player();
            $player->id = session_id();
        }
        $player->name = $name;
        $player->lastPingTime = time();
        $player->save();

        return $this->render('index', ['player' => $player]);
    }

    public function actionPing() {
        session_start();
        $player = \app\models\Player::findOne(['id' => session_id()]);
        if ($player != null) {
            $player->lastPingTime = time();
            $player->save();
            echo \yii\helpers\Json::encode([
                'event' => 0,
            ]);
        }
    }

}
