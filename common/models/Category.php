<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%categories}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $type
 * @property string $sort
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%categories}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['title'], 'string', 'max' => 255],
            [['type', 'sort'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Անվանում'),
            'type' => 'Տիպը',
            'sort' => 'Սորտավորում',
        ];
    }
}
