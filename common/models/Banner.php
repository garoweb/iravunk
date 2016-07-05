<?php

namespace common\models;
use Yii;
use yii\web\UploadedFile;
/**
 * This is the model class for table "{{%banners}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $name
 * @property string $img
 * @property string $link
 * @property string $code
 * @property string $text
 */
class Banner extends \yii\db\ActiveRecord
{

    public $imageFile;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%banners}}';
    }

    public function upload()
    {
        $this->imageFile = UploadedFile::getInstance($this, 'imageFile');
        if ($this->imageFile) {
            $path = Yii::getAlias('@frontend') .'/web/banners/';
            $name = rand(1,100).$this->imageFile->name;
            $this->imageFile->saveAs($path . $name);
            return $name;
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
            [['title', 'img', 'link', 'name', 'text'], 'string', 'max' => 255],
            [['code'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Դիրքը',
            'img' => 'Նկար',
            'link' => 'Հղում',
            'imageFile' => 'Բաններ',
            'name' => 'Անուն',
            'text' => 'Տեքստ'
        ];
    }
}
