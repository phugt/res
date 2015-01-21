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

}
