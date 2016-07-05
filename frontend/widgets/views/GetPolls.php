<?php
use yii\widgets\ActiveForm;
use yii\helpers\Url;
?>
<div class="single_sidebar wow fadeInDown poll_block">
    <h2><span>Հարցում</span></h2>
    <div class="col-md-12">
        <p class="poll_question text-center"><b><?=$poll->question?></b> <br/> <i class="fa fa-chevron-down"></i></p>
        <?php $form = ActiveForm::begin(['action' =>Url::toRoute('/poll-answer')]); ?>
        <input type="hidden" name="PollsUserAnswers[poll_id]" value="<?=$poll->id?>">
        <ul class="poll_answers">
        <?php foreach($poll->pollsAnswers as $answer):?>
            <li>
                <div class="row">
                    <div class="col-xs-1">
                        <input type="radio" name="PollsUserAnswers[answer_id]" required=""  id="answer_<?=$answer->id?>" value="<?=$answer->id?>">
                    </div>
                    <div class="col-xs-10">
                        <label for="answer_<?=$answer->id?>"><?=$answer->answer?></label>
                    </div>
                </div>
            </li>
        <?php endforeach?>
            <li><input type="submit" class="btn btn-orange" value="Քվեարկել"></li>
        </ul>
        <?php ActiveForm::end(); ?>
    </div>
</div>