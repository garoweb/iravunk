<?php

namespace common\models;

use Yii;
use yii\web\UploadedFile;
use yii\imagine\Image;
use Imagine\Gd;
use Imagine\Image\Box;
/**
 * This is the model class for table "{{%news}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $content
 * @property string $video
 * @property string $meta_key
 * @property string $created
 * @property string $published
 * @property integer $is_published
 * @property integer $important
 * @property integer $hits
 * @property integer $user_id
 * @property integer $place
 *
 * @property CategoryRelations[] $categoryRelations
 * @property Category[] $categories
 */
class News extends \yii\db\ActiveRecord
{
	/**
	 * @inheritdoc
	 */

	public $imageFile;
	public $categories = [];

	public static function tableName()
	{
		return '{{%news}}';
	}
	
	public function create_thumb() {
		$path = Yii::getAlias('@frontend') .'/web/thumbnails/';
		$newFileName = $path . $this->id . '.' . 'jpg';
		$link = 'http://iravunk.com/thumb.php?src=/frontend/web/uploads/'.$this->id.'.png&h=70&w=90';
		$content = file_get_contents($link);
		file_put_contents($newFileName, $content);
	}

	public function upload()
	{
		$this->imageFile = UploadedFile::getInstance($this, 'imageFile');
		if ($this->imageFile) {
			$path = Yii::getAlias('@frontend') .'/web/uploads/';
            $fileName = $path . $this->id . '.' . 'jpg';
            $newFileName = $path . $this->id . '.' . 'png';
			$this->imageFile->saveAs($fileName);
            Image::getImagine()->open($fileName)->thumbnail(new Box(800, 800))->save($fileName , ['quality' => 70]);
            $content = file_get_contents($fileName);
            file_put_contents($newFileName, $content);
            unlink($fileName);
			$this->create_thumb();
			return true;
		} else {
			return false;
		}
	}

    public function get_video_id()
    {
        $out = [];
        preg_match("/^(?:https?:\/\/)?(?:www\.)?youtube\.com\/watch\?(?=.*v=((\w|-){11}))(?:\S+)?$/", $this->video, $out);
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
			[['title', 'content'], 'required'],
			[['content'], 'string'],
			[['created', 'published'], 'safe'],
			[['is_published', 'important', 'hits', 'place', 'user_id'], 'integer'],
			[['title', 'video', 'meta_key'], 'string', 'max' => 255],
			['imageFile', 'required', 'on' => 'create'],
            [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, gif', 'maxSize' => 1024 * 1024 * 2, 'minSize' => 30000]
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id' => Yii::t('app', 'ID'),
			'title' => Yii::t('app', 'Վերնագիր'),
			'content' => Yii::t('app', 'Տեքստ'),
			'video' => Yii::t('app', 'Վիդեո'),
			'meta_key' => Yii::t('app', 'Տեգեր'),
			'created' => Yii::t('app', 'Ստեղծման ամսաթիվ'),
			'published' => Yii::t('app', 'Հրապարակման ամսաթիվ'),
			'is_published' => Yii::t('app', 'Հրապարակել'),
			'important' => Yii::t('app', 'Գլխավոր'),
			'hits' => Yii::t('app', 'Դիտվել է'),
            'place' => 'Դիրքը',
            'imageFile' => 'Նկար',
		];
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getCategoryRelations()
	{
		return $this->hasMany(CategoryRelations::className(), ['news_id' => 'id']);
	}
	

    public static function cut_title($string, $count)
    {
		$string = strip_tags($string);
		$string = trim(mb_substr($string, 0, $count, 'utf-8'));
		$words = explode(' ', $string);
		if($words && count($words) > 5) {
			unset($words[count($words)-1]);
		}
		$string = implode(' ', $words);
		return $string;
    }
}
