<?php

namespace app\controllers;

/**
 * Description of QuestionController
 *
 * @author ThienPhu
 */
class QuestionController extends \yii\web\Controller {

    public function actionList() {
        $this->view->title = 'Soạn thảo câu hỏi';

        $dataProvider = new \yii\data\ActiveDataProvider([
            'query' => \app\models\Question::find(),
            'pagination' => [
                'pageSize' => 500
            ],
            'sort' => [
                'defaultOrder' => [
                    'updateTime' => SORT_DESC,
                ]
            ],
        ]);

        return $this->render('list', [
                    'data' => $dataProvider,
        ]);
    }
    
    public function actionCreate(){
        $new = new \app\models\Question();
        if ($new->load(\Yii::$app->request->post())) {
            $new->createTime = time();
            $new->updateTime = time();
            if($new->save()){
                \Yii::$app->session->setFlash('success', 'Thêm câu hỏi!');
                return $this->redirect(['list']);
            }
        }

        return $this->render('create', ['model' => $new]);
    }

}
