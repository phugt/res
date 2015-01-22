<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "answer".
 *
 * @property integer $id
 * @property integer $sessionId
 * @property integer $questionId
 * @property string $playerId
 * @property string $answer
 * @property integer $time
 * @property string $playerName
 * @property integer $true
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
            [['sessionId', 'questionId', 'answer', 'time', 'true'], 'required'],
            [['sessionId', 'questionId', 'time', 'true'], 'integer'],
            [['playerId'], 'string', 'max' => 64],
            [['answer', 'playerName'], 'string', 'max' => 32]
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
            'questionId' => 'Question ID',
            'playerId' => 'Player ID',
            'answer' => 'Answer',
            'time' => 'Time',
            'playerName' => 'Player Name',
            'true' => 'True',
        ];
    }
}
