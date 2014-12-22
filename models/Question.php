<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "question".
 *
 * @property integer $id
 * @property integer $examId
 * @property integer $position
 * @property string $content
 * @property integer $time
 * @property string $answer
 * @property integer $createTime
 * @property integer $updateTime
 */
class Question extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'question';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['examId', 'position', 'content', 'time', 'answer', 'createTime', 'updateTime'], 'required'],
            [['examId', 'position', 'time', 'createTime', 'updateTime'], 'integer'],
            [['content'], 'string'],
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
            'examId' => 'Exam ID',
            'position' => 'Position',
            'content' => 'Content',
            'time' => 'Time',
            'answer' => 'Answer',
            'createTime' => 'Create Time',
            'updateTime' => 'Update Time',
        ];
    }
}
