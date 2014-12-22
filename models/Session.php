<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "session".
 *
 * @property integer $id
 * @property integer $examId
 * @property string $name
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
            [['examId', 'name', 'startTime', 'endTime'], 'required'],
            [['examId', 'startTime', 'endTime'], 'integer'],
            [['name'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'examId' => 'Exam ID',
            'name' => 'Name',
            'startTime' => 'Start Time',
            'endTime' => 'End Time',
        ];
    }
}
