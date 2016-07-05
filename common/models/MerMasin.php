<?php

namespace common\models;

use Yii;
use yii\web\UploadedFile;
use yii\imagine\Image;
use Imagine\Gd;
use Imagine\Image\Box;
/**
 * This is the model class for table "{{%mer_masin}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $content
 * @property string $meta_key
 * @property string $created
 * @property integer $hits
 * @property integer $type
 * @property integer $user_id
 *
 * @property User $user
 */
class MerMasin extends \yii\db\ActiveRecord
{
    public $imageFile;
    public function upload()
    {
        $this->imageFile = UploadedFile::getInstance($this, 'imageFile');
        if ($this->imageFile) {
            $path = Yii::getAlias('@frontend') .'/web/about_uploads/';
            $fileName = $path . $this->id . '.' . 'jpg';
            $this->imageFile->saveAs($fileName);
            Image::getImagine()->open($fileName)->thumbnail(new Box(800, 800))->save($fileName , ['quality' => 80]);
            return true;
        } else {
            return false;
        }
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%mer_masin}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'user_id', 'content'], 'required'],
            [['content'], 'string'],
            [['created'], 'safe'],
            [['hits', 'type', 'user_id'], 'integer'],
            [['title', 'meta_key'], 'string', 'max' => 255],
            ['imageFile', 'required', 'on' => 'create'],
            [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, gif', 'maxSize' => 1024 * 1024 * 2]
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
            'content' => 'Տեքստ',
            'meta_key' => 'Meta Key',
            'created' => 'Ստեղծման ամսաթիվ',
            'hits' => 'Դիտումների քանակ',
            'type' => 'Տիպը',
            'user_id' => 'User ID',
            'imageFile' => 'Նկար',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
