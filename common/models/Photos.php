<?php

namespace common\models;

use Yii;
use yii\web\UploadedFile;
use yii\imagine\Image;
use Imagine\Gd;
use Imagine\Image\Box;
/**
 * This is the model class for table "{{%photos}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $created
 */
class Photos extends \yii\db\ActiveRecord
{
    public $imageFile;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%photos}}';
    }

    public function upload()
    {
        $this->imageFile = UploadedFile::getInstance($this, 'imageFile');
        if ($this->imageFile) {
            $path = Yii::getAlias('@frontend') .'/web/photos/';
            $fileName = $path . $this->id . '.' . 'png';
            $this->imageFile->saveAs($fileName);
            Image::getImagine()->open($fileName)->thumbnail(new Box(800, 800))->save($fileName , ['quality' => 90]);
            return true;
        } else {
            return false;
        }
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['created'], 'safe'],
            [['title'], 'string', 'max' => 255],
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
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Անվանում'),
            'created' => Yii::t('app', 'Ավելացման ամսաթիվ'),
        ];
    }
}
