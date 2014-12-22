<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "answer".
 *
 * @property integer $id
 * @property integer $sessionId
 * @property integer $examId
 * @property integer $questionId
 * @property integer $deviceId
 * @property integer $playerId
 * @property string $answer
 * @property integer $time
 */
class Answer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'answer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sessionId', 'examId', 'questionId', 'deviceId', 'answer', 'time'], 'required'],
            [['sessionId', 'examId', 'questionId', 'deviceId', 'playerId', 'time'], 'integer'],
            [['answer'], 'string', 'max' => 32]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sessionId' => 'Session ID',
            'examId' => 'Exam ID',
            'questionId' => 'Question ID',
            'deviceId' => 'Device ID',
            'playerId' => 'Player ID',
            'answer' => 'Answer',
            'time' => 'Time',
        ];
    }
}
