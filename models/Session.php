<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "session".
 *
 * @property integer $id
 * @property integer $questionId
 * @property integer $startTime
 * @property integer $endTime
 */
class Session extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'session';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['questionId', 'startTime', 'endTime'], 'required'],
            [['questionId', 'startTime', 'endTime'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'questionId' => 'Question ID',
            'startTime' => 'Start Time',
            'endTime' => 'End Time',
        ];
    }
}
