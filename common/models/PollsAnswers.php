<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%polls_answers}}".
 *
 * @property integer $id
 * @property integer $poll_id
 * @property string $answer
 *
 * @property Polls $poll
 * @property PollsUserAnswers[] $pollsUserAnswers
 */
class PollsAnswers extends \yii\db\ActiveRecord
{


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%polls_answers}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['poll_id', 'answer'], 'required'],
            [['poll_id'], 'integer'],
            [['answer'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'poll_id' => 'Poll ID',
            'answer' => 'Answer',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPoll()
    {
        return $this->hasOne(Polls::className(), ['id' => 'poll_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPollsUserAnswers()
    {
        return $this->hasMany(PollsUserAnswers::className(), ['answer_id' => 'id']);
    }
}
