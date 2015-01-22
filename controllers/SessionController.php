<?php

namespace app\controllers;

class SessionController extends \yii\web\Controller {

    public function actionList() {
        $this->view->title = 'Làm trắc nghiệm';

        $dataProvider = new \yii\data\ActiveDataProvider([
            'query' => \app\models\Question::find(),
            'pagination' => [
                'pageSize' => 500
            ],
            'sort' => [
                'defaultOrder' => [
                    'position' => SORT_ASC,
                ]
            ],
        ]);

        return $this->render('list', [
                    'data' => $dataProvider,
        ]);
    }

    public function actionStart($id) {
        $question = \app\models\Question::findOne($id);
        if ($question == null) {
            return \yii\helpers\Json::encode([
                        'success' => false,
                        'message' => 'Câu hỏi không tồn tại'
            ]);
        }

        $session = new \app\models\Session();
        $session->questionId = $question->id;
        $session->startTime = time();
        $session->endTime = time() + $question->time;
        $session->save();

        $app_id = '103892';
        $app_key = '0ae16f5aa4dfbdc8111f';
        $app_secret = '7a20317a987030fa98aa';

        $pusher = new \Pusher($app_key, $app_secret, $app_id);

        $pusher->trigger('res', 'START', [
            'sessionId' => $session->id,
            'questionId' => $question->id,
            'time' => $question->time
        ]);

        return \yii\helpers\Json::encode([
                    'success' => true,
                    'question' => $question,
                    'session' => $session
        ]);
    }

    public function actionStat($id) {
        return \yii\helpers\Json::encode([
                    'success' => true,
                    'answers' => \app\models\Answer::findAll(['sessionId' => $id]),
                    'session' => \app\models\Session::findOne($id),
                    'question' => \app\models\Question::findOne(\app\models\Session::findOne($id)->questionId)
        ]);
    }

}
