<?php

use yii\helpers\Html;
use yii\bootstrap\NavBar;
use app\assets\AppAsset;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body>

        <?php $this->beginBody() ?>
        <div class="wrap">
            <?php
            NavBar::begin([
                'brandLabel' => 'Làm trắc nghiệm',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);
            NavBar::end();
            ?>

            <div class="container" id="content">
            </div>
        </div>

        <footer class="footer">
            <div class="container">
                <div class="pull-left">
                    <div class="form-inline">
                        <div class="form-group">
                            <label for="txt-answer">Trả lời</label>
                            <input type="text" class="form-control" disabled="" id="txt-answer" placeholder="Nhập câu trả lời">
                        </div>
                        <button type="button" id="btn-answer" disabled="" class="btn btn-primary">Trả lời</button>
                    </div>
                </div>
                <div class="pull-right text-danger"><strong id="lbl-time" style="font-size: 30px">Chưa có câu hỏi</strong></div>
            </div>
        </footer>

        <?php $this->endBody() ?>
        <script src="//js.pusher.com/2.2/pusher.min.js" type="text/javascript"></script>
        <script type="text/javascript">
            // Enable pusher logging - don't include this in production
            Pusher.log = function (message) {
                if (window.console && window.console.log) {
                    window.console.log(message);
                }
            };

            var interval = null;
            var timeout = null;

            var pusher = new Pusher('0ae16f5aa4dfbdc8111f');
            var channel = pusher.subscribe('res');
            channel.bind('START', function (data) {
                $.ajax({
                    url: './question',
                    data: {id: data.questionId},
                    dataType: 'JSON',
                    success: function (result) {
                        if (result.success) {
                            $('#content').html(result.data.content);
                            $('#txt-answer').val('');
                            $('#txt-answer').removeAttr('disabled');
                            $('#btn-answer').removeAttr('disabled');
                        }
                    }
                });
                clearInterval(interval);
                clearTimeout(timeout);
                setTimeout(function () {
                    $('#content').html('<div class="alert alert-danger">Hết thời gian</div>');
                    clearInterval(interval);
                    $('#lbl-time').text('Hết thời gian');
                    $('#txt-answer').attr('disabled', 'disabled');
                    $('#btn-answer').attr('disabled', 'disabled');
                }, data.time * 1000);

                $('#lbl-time').text('Còn lại ' + data.time-- + ' giây');
                interval = setInterval(function () {
                    $('#lbl-time').text('Còn lại ' + data.time-- + ' giây');
                }, 1000);

                $('#btn-answer').unbind('click');
                $('#btn-answer').click(function () {
                    $('#txt-answer').attr('disabled', 'disabled');
                    $('#btn-answer').attr('disabled', 'disabled');
                    $('#btn-answer').text('Xin đợi...');
                    $.ajax({
                        url: './answer',
                        data: {
                            questionId: data.questionId,
                            sessionId: data.sessionId,
                            ans: $('#txt-answer').val()
                        },
                        dataType: 'JSON',
                        success: function (result) {
                            alert(result.message);
                            $('#btn-answer').text('Trả lời');
                        }
                    });
                });
            });
        </script>
    </body>
</html>
<?php $this->endPage() ?>
