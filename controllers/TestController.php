<?php

namespace app\controllers;

/**
 * Description of TestController
 *
 * @author ThienPhu
 */
class TestController extends \yii\web\Controller {

    public function actionTest() {
        $app_id = '103892';
        $app_key = '0ae16f5aa4dfbdc8111f';
        $app_secret = '7a20317a987030fa98aa';

        $pusher = new \Pusher($app_key, $app_secret, $app_id);

        $data['message'] = 'hello world';
        $pusher->trigger('test_channel', 'my_event', $data);
    }

}
