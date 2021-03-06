<?php

use yii\grid\GridView;
use yii\grid\Column;
use yii\grid\DataColumn;
use yii\grid\ActionColumn;
use yii\helpers\Url;
?>

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Danh sách câu hỏi</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <?php if (Yii::$app->session->hasFlash('error')): ?>
                <div class="alert alert-danger" role="alert">
                    <?= Yii::$app->session->getFlash('error') ?>
                </div>
            <?php endif; ?>
            <?php if (Yii::$app->session->hasFlash('success')): ?>
                <div class="alert alert-success" role="alert">
                    <?= Yii::$app->session->getFlash('success') ?>
                </div>
            <?php endif; ?>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="table-responsive">
                <?php

                function displayContent($model) {
                    return yii\helpers\StringHelper::truncate(strip_tags($model->content), 100);
                }

                function displayAction($model) {
                    return '<div for="' . $model->id . '" class="btn-group"><button onclick="session.start(' . $model->id . ')" class="btn btn-primary">Làm bài</button><button disabled class="btn btn-info">Xem kết quả</button></div>';
                }

                echo GridView::widget([
                    'dataProvider' => $data,
                    'columns' => [
                        [
                            'class' => DataColumn::className(),
                            'attribute' => 'position',
                            'format' => 'text',
                        ],
                        [
                            'class' => Column::className(),
                            'header' => 'Tóm tắt nội dung',
                            'content' => 'displayContent'
                        ],
                        [
                            'class' => DataColumn::className(),
                            'attribute' => 'time',
                            'format' => 'text',
                        ],
                        [
                            'class' => Column::className(),
                            'header' => 'Làm bài',
                            'content' => 'displayAction'
                        ]
                    ],
                ])
                ?>
            </div>
            <!-- /.table-responsive -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
</div>