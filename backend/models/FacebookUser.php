<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%facebook_user}}".
 *
 * @property integer $id
 * @property string $user_token
 * @property string $page_token
 * @property string $name
 * @property integer $fb_id
 */
class FacebookUser extends \yii\db\ActiveRecord
{
	
	public $categories = [];
	
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%facebook_user}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_token', 'page_token', 'name'], 'string', 'max' => 255],
            [['fb_id'], 'integer'],
            [['user_token', 'fb_id', 'name', 'categories'], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_token' => 'User Token',
            'page_token' => 'Page Token',
        ];
    }
}
