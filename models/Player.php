<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "player".
 *
 * @property string $id
 * @property string $name
 * @property string $lastPingTime
 */
class Player extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'player';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'name', 'lastPingTime'], 'required'],
            [['lastPingTime'], 'integer'],
            [['id'], 'string', 'max' => 64],
            [['name'], 'Tên học sinh', 'max' => 150]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'lastPingTime' => 'Last Ping Time',
        ];
    }
}
