<?php

namespace app\controllers;

/**
 * Description of QuestionController
 *
 * @author ThienPhu
 */
class QuestionController extends \yii\web\Controller {

    public function init() {
        parent::init();
        if (\Yii::$app->session->get('signed') == null) {
            return $this->redirect(['site/signin']);
        }
    }

    public function actionList() {
        $this->view->title = 'Soạn thảo câu hỏi';

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

    public function actionCreate() {
        $new = new \app\models\Question();
        if ($new->load(\Yii::$app->request->post())) {
            $new->createTime = time();
            $new->updateTime = time();
            if ($new->save()) {
                \Yii::$app->session->setFlash('success', 'Thêm câu hỏi thành công!');
                return $this->redirect(['list']);
            }
        }

        return $this->render('create', ['model' => $new]);
    }

    public function actionUpdate($id) {
        $this->view->title = 'Sửa Câu hỏi';

        $old = \app\models\Question::findOne($id);
        if (!isset($old)) {
            \Yii::$app->session->setFlash('error', 'Câu hỏi không tồn tại, không thể sửa!');
            return $this->redirect(['list']);
        }

        $new = new \app\models\Question();
        if ($new->load(\Yii::$app->request->post())) {
            $new->id = $old->id;
            if ($new->validate()) {
                $old->position = $new->position;
                $old->content = $new->content;
                $old->answer = $new->answer;
                $old->time = $new->time;
                $old->updateTime = time();

                $old->update(false);
                \Yii::$app->session->setFlash('success', 'Sửa câu hỏi thành công!');

                return $this->redirect(['list']);
            } else {
                return $this->render('update', ['model' => $new]);
            }
        }

        return $this->render('update', ['model' => $old]);
    }

    public function actionDelete($id) {
        $old = Style::findOne($id);
        if (isset($old)) {
            \Yii::$app->session->setFlash('success', 'Xóa câu hỏi thành công!');
            $old->delete();
        } else {
            \Yii::$app->session->setFlash('error', 'Câu hỏi không tồn tại, không thể xóa!');
        }
        $this->redirect(['list']);
    }

}
