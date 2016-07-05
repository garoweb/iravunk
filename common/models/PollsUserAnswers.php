<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%polls_user_answers}}".
 *
 * @property integer $id
 * @property integer $poll_id
 * @property integer $answer_id
 * @property string $user_key
 * @property string $created
 *
 * @property PollsAnswers $answer
 * @property Polls $poll
 */
class PollsUserAnswers extends \yii\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%polls_user_answers}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['poll_id', 'answer_id', 'user_key'], 'required'],
            [['poll_id', 'answer_id'], 'integer'],
            [['created'], 'safe'],
            [['user_key'], 'string', 'max' => 255]
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
            'answer_id' => 'Answer ID',
            'user_key' => 'User Key',
            'created' => 'Created',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnswer()
    {
        return $this->hasOne(PollsAnswers::className(), ['id' => 'answer_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPoll()
    {
        return $this->hasOne(Polls::className(), ['id' => 'poll_id']);
    }
}
