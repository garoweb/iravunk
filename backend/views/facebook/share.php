<?php
use yii\widgets\ActiveForm;
$form = ActiveForm::begin(['method' => 'get']); ?>
<div class="row" style="margin-top: 80px">
    <div class="form-group">
        <br /> <br /> <br />
    </div>
</div>

<div class="form-group">

    <input type="url" name="url" class="form-control" placeholder="url">
</div>
<div class="form-group">
    <input type="submit" class="btn btn-primary" value="share">
</div>

<?php ActiveForm::end(); ?>