<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%fb_user_categories}}".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $category_id
 */
class FbUserCategories extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%fb_user_categories}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'category_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'category_id' => 'Category ID',
        ];
    }
}
