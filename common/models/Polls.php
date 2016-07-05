<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%polls}}".
 *
 * @property integer $id
 * @property string $question
 * @property string $created
 * @property integer $is_published
 *
 * @property PollsAnswers[] $pollsAnswers
 * @property PollsUserAnswers[] $pollsUserAnswers
 */
class Polls extends \yii\db\ActiveRecord
{
    public static function getForNewUser()
    {
        return self::find()->where(['is_published' => 1])->orderBy('id DESC')->all();
    }

    public static function getForOldUser($userKey)
    {
        return self::find()->where("id NOT IN (SELECT poll_id FROM {{%polls_user_answers}} WHERE user_key = '$userKey')")->andWhere(['is_published' => 1])->orderBy('id DESC')->all();
    }

    public function getAnswersStat()
    {
        $result = PollsUserAnswers::find()
                                    ->select('answer_id, COUNT(answer_id) as total')
                                    ->where(['poll_id' => $this->id])
                                    ->groupBy('answer_id')
                                    //->orderBy('total DESC')
                                    ->asArray()
                                    ->all();
        $stat = [];
        $keys = [];
        $allTotal = 0;
        foreach($this->pollsAnswers as $pollAnswer) {
            $keys[] = $pollAnswer->id;
        }
        foreach($result as $answer) {
            $key = array_search($answer['answer_id'], $keys);
            if($key !== false) {
                $stat[$answer['answer_id']] = $answer['total'];
                $allTotal += $answer['total'];
                unset($keys[$key]);
            }
        }
        foreach($keys as $answer_id) {
            $stat[$answer_id] = 0;
        }
        $result = [];
        foreach($stat as $answer_id => $total) {
            $result[] = [
                'total' => floor($total/$allTotal*100),
                'answer_id' => $answer_id,
                'answer' => PollsAnswers::findOne(['id' => $answer_id])->answer
            ];
        }
        return $result;
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%polls}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['question'], 'required'],
            [['created'], 'safe'],
            [['is_published'], 'integer'],
            [['question'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'question' => 'Հարց',
            'created' => 'Ստեղծման ամսաթիվ',
            'is_published' => 'Հրապարակված է',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPollsAnswers()
    {
        return $this->hasMany(PollsAnswers::className(), ['poll_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPollsUserAnswers()
    {
        return $this->hasMany(PollsUserAnswers::className(), ['poll_id' => 'id']);
    }
}
