<?php

namespace app\controllers;

/**
 * Description of QuestionController
 *
 * @author ThienPhu
 */
class PlayerController extends \yii\web\Controller {

    public function init() {
        parent::init();
    }

    public function actionList() {
        $this->view->title = 'Danh sách học sinh';

        $dataProvider = new \yii\data\ActiveDataProvider([
            'query' => \app\models\Player::find(),
            'pagination' => [
                'pageSize' => 500
            ],
            'sort' => [
                'defaultOrder' => [
                    'lastPingTime' => SORT_ASC,
                ]
            ],
        ]);

        return $this->render('list', [
                    'data' => $dataProvider,
        ]);
    }


}
