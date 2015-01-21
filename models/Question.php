<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "question".
 *
 * @property integer $id
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
            [['position', 'time', 'answer'], 'required'],
            [['position', 'time', 'createTime', 'updateTime'], 'integer'],
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
            'id' => 'Mã câu hỏi',
            'position' => 'Thứ tự',
            'content' => 'Nội dung',
            'time' => 'Thời gian trả lời (giây)',
            'answer' => 'Câu trả lời đúng',
            'createTime' => 'Tạo lúc',
            'updateTime' => 'Sửa lúc',
        ];
    }
}
