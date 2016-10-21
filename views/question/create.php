<?php
/**
 * Created by PhpStorm.
 * User: victor
 * Date: 19.09.16
 * Time: 23:28
 * @var $question \app\models\Question
 */
?>

<?php $form = \yii\widgets\ActiveForm::begin(); ?>
<div class="row">
    <div class="col-lg-4">
        <?= $form->field($question, 'root')->dropDownList(\app\models\search\NodeSearch::all()); ?>
    </div>
    <div class="col-lg-4">
        <?= $form->field($question, 'lvl')->dropDownList([
            1=>1, 2=>2, 3=>3, 4=>4
        ]); ?>
    </div>
</div>

<?= $form->field($question, 'text')->textarea(); ?>

<?= \yii\helpers\Html::submitButton('Сохранить', ['class' => 'btn btn-success']); ?>
<?php $form->end(); ?>
