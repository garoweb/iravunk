<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%videos}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $link
 * * @property integer $user_id
 * @property string $created
 */
class Video extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%videos}}';
    }

    public function get_video_id()
    {
        $out = [];
        preg_match("/^(?:https?:\/\/)?(?:www\.)?youtube\.com\/watch\?(?=.*v=((\w|-){11}))(?:\S+)?$/", $this->link, $out);
        if(isset($out[1])) {
            return $out[1];
        }
        return false;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'link'], 'required'],
            [['created'], 'safe'],
            [['user_id'], 'integer'],
            [['title', 'link'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Վերնագիր',
            'link' => 'Youtube link',
            'created' => 'Ավելացման ամսաթիվ',
        ];
    }
}
