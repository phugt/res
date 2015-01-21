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
                    <form class="form-inline">
                        <div class="form-group">
                            <label for="txt-answer">Trả lời</label>
                            <input type="text" class="form-control" id="txt-answer" placeholder="Nhập câu trả lời">
                        </div>
                        <button type="button" id="btn-answer" class="btn btn-default">Gửi</button>
                    </form>
                </div>
                <div class="pull-right text-danger"><strong style="font-size: 30px">Chưa có câu hỏi</strong></div>
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

            var pusher = new Pusher('0ae16f5aa4dfbdc8111f');
            var channel = pusher.subscribe('test_channel');
            channel.bind('my_event', function (data) {
                alert(data.message);
            });
        </script>
    </body>
</html>
<?php $this->endPage() ?>
