<?php

use yii\helpers\Html;
use app\assets\SigninAsset;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;

SigninAsset::register($this);
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
        <div class="container">

            <?php $form = ActiveForm::begin(['options' => ['class' => 'form-signin']]); ?>
            <h2 class="form-signin-heading">Giáo viên</h2>
            <label for="inputUsername" class="sr-only">Tên đăng nhập</label>
            <?= Html::activeTextInput($model, 'username', ['class' => 'form-control top', 'id' => 'inputUsername', 'placeholder' => 'Tên đăng nhập', 'required' => '']) ?>
            <label for="inputPassword" class="sr-only">Mật khẩu</label>
            <?= Html::activePasswordInput($model, 'password', ['class' => 'form-control bottom', 'id' => 'inputPassword', 'placeholder' => 'Mật khẩu', 'required' => '']) ?>
            <?php if (isset($error)) { ?>
                <div class="alert alert-danger"><?= $error ?></div>
            <?php } ?>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Đăng nhập</button>
            <?php ActiveForm::end(); ?>

            <form class="form-signin" method="GET" action="<?= Url::to(['play/index']) ?>">
                <h2 class="form-signin-heading">Học sinh</h2>
                <label for="inputName" class="sr-only">Họ và tên</label>
                <input type="text" name="name" id="inputName" class="form-control single" placeholder="Họ và tên" required>
                <?php if (Yii::$app->session->hasFlash('error')): ?>
                    <div class="alert alert-danger" role="alert">
                        <?= Yii::$app->session->getFlash('error') ?>
                    </div>
                <?php endif; ?>
                <button class="btn btn-lg btn-primary btn-block" type="submit">Đăng nhập</button>
            </form>
        </div> <!-- /container -->
        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
