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

    public function actionQuestion($id) {
        $question = \app\models\Question::findOne($id);
        if ($question == null) {
            return \yii\helpers\Json::encode([
                        'success' => false,
                        'message' => 'Câu hỏi không tồn tại'
            ]);
        }
        return \yii\helpers\Json::encode([
                    'success' => true,
                    'data' => $question
        ]);
    }

    public function actionAnswer($questionId, $sessionId, $ans) {
        session_start();
        $answer = new \app\models\Answer();
        $answer->sessionId = $sessionId;
        $answer->questionId = $questionId;
        $answer->playerId = session_id();
        $answer->time = time();
        $answer->answer = $ans;

        $player = \app\models\Player::findOne(session_id());
        $question = \app\models\Question::findOne($questionId);

        $answer->playerName = $player->name;
        $answer->true = 0;
        if ($this->convertToAscii(strtolower(trim($question->answer))) == $this->convertToAscii(strtolower(trim($ans)))) {
            $answer->true = 1;
        }
        $answer->save();

        return \yii\helpers\Json::encode([
                    'message' => 'Gửi câu trả lời thành công'
        ]);
    }

    function convertToAscii($str) {
        $vnCode = array('à', 'á', 'ạ', 'ả', 'ã', 'â', 'ầ', 'ấ', 'ậ', 'ẩ', 'ẫ', 'ă', 'ằ', 'ắ', 'ặ', 'ẳ', 'ẵ', 'è', 'é', 'ẹ', 'ẻ', 'ẽ', 'ê', 'ề', 'ế', 'ệ', 'ể', 'ễ', 'ì', 'í', 'ị', 'ỉ', 'ĩ', 'ò', 'ó', 'ọ', 'ỏ', 'õ', 'ô', 'ồ', 'ố', 'ộ', 'ổ', 'ỗ', 'ơ', 'ờ', 'ớ', 'ợ', 'ở', 'ỡ', 'ù', 'ú', 'ụ', 'ủ', 'ũ', 'ư', 'ừ', 'ứ', 'ự', 'ử', 'ữ', 'ỳ', 'ý', 'ỵ', 'ỷ', 'ỹ', 'đ', 'À', 'Á', 'Ạ', 'Ả', 'Ã', 'Â', 'Ầ', 'Ấ', 'Ậ', 'Ẩ', 'Ẫ', 'Ă', 'Ằ', 'Ắ', 'Ặ', 'Ẳ', 'Ẵ', 'È', 'É', 'Ẹ', 'Ẻ', 'Ẽ', 'Ê', 'Ề', 'Ế', 'Ệ', 'Ể', 'Ễ', 'Ì', 'Í', 'Ị', 'Ỉ', 'Ĩ', 'Ò', 'Ó', 'Ọ', 'Ỏ', 'Õ', 'Ô', 'Ồ', 'Ố', 'Ộ', 'Ổ', 'Ỗ', 'Ơ', 'Ờ', 'Ớ', 'Ợ', 'Ở', 'Ỡ', 'Ù', 'Ú', 'Ụ', 'Ủ', 'Ũ', 'Ư', 'Ừ', 'Ứ', 'Ự', 'Ử', 'Ữ', 'Ỳ', 'Ý', 'Ỵ', 'Ỷ', 'Ỹ', 'Đ');
        $unsignCode = array('a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'i', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'y', 'y', 'y', 'y', 'y', 'd', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'E', 'E', 'E', 'E', 'E', 'E', 'E', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'I', 'O', 'O', 'O', 'O', 'O', 'O', 'O', 'O', 'O', 'O', 'O', 'O', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U', 'U', 'U', 'U', 'U', 'U', 'U', 'U', 'U', 'Y', 'Y', 'Y', 'Y', 'Y', 'D');
        return str_replace($vnCode, $unsignCode, $str);
    }

}
