<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%facebook_groups}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $group_id
 * @property string $category_id
 */
class FacebookGroups extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%facebook_groups}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'group_id'], 'string', 'max' => 255],
            [['category_id'], 'integer'],
            [['group_id'], 'required'],
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
            'group_id' => 'Group ID',
        ];
    }
}
