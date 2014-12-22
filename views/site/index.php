<?php
$this->title = 'Hệ thống trắc nghiệm thời gian thực';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Xin chào!</h1>

        <p class="lead">Chào bạn đến với hệ thống trắc nghiệm thời gian thực.</p>
        
        <p><a class="btn btn-lg btn-success" href="<?= yii\helpers\Url::to('session/start') ?>">Làm trắc nghiệm ngay</a></p>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <h2>Đề thi</h2>

                <p>Quản lý ngân hàng đề thi, tại đây bạn có thể soạn đề thi trắc nghiệm cùng với các nội dung câu hỏi bằng nhiều hình thức, ngân hàng đề thi và câu hỏi có thể dùng lại cho nhiều lần.</p>

                <p><a class="btn btn-default" href="<?= yii\helpers\Url::to('exam/list') ?>">Quản lý đề thi &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Làm bài</h2>

                <p>Tại đây bạn có thể cho các thí sinh làm bài thi trắc nghiệm với sự hỗ trợ của thiết bị trắc nghiệm thời gian thực cũng như xem kết quả trắc nghiệm.<br/><br/></p>

                <p><a class="btn btn-default" href="<?= yii\helpers\Url::to('session/list') ?>">Làm bài thi &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Cấu hình</h2>

                <p>Cấu hình các cài đặt hệ thống, danh sách thí sinh, thiết bị...<br/><br/><br/></p>

                <p><a class="btn btn-default" href="<?= yii\helpers\Url::to('player/list') ?>">Cấu hình hệ thống &raquo;</a></p>
            </div>
        </div>

    </div>
</div>
