<?php
use yii\bootstrap\Html;

/* @var $this yii\web\View */
/* @var $model \app\models\WordExtractor */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <?php $form = \yii\widgets\ActiveForm::begin([
                    'action' => \yii\helpers\Url::home()
                ]); ?>
                <?= $form->field($model, 'text'); ?>
                <?= Html::submitButton('Ввести', [
                    'class' => 'btn btn-success'
                ]); ?>
                <?php $form->end(); ?>
            </div>
            <!--            <div class="col-lg-4">-->
            <!--                --><?php //if (!empty($model->getStemm())) : ?>
            <!--                    <h4>Выделенные ключевые слова</h4>-->
            <!--                    --><?php //= implode(', ', $model->getExtractedWords()); ?>
            <!--                --><?php //endif; ?>
            <!--                --><?php //if (!empty($model->getStemm())) : ?>
            <!---->
            <!---->
            <!--                    <h4>Стеммы</h4>-->
            <!--                    --><?php //= implode(', ', $model->getStemm()->words); ?>
            <!--                --><?php //endif; ?>
            <!---->
            <!--            </div>-->

        </div>
        <div class="row">
            <div class="col-lg-4">
                <?php if (null !== $model->getQuestion()): ?>
                    <p><?= $model->getQuestion()->text; ?></p>

                    <?= Html::a('ДА', ['', 'answer' => 1, 'question' => $model->getQuestion()->id], ['class' => 'btn btn-success btn-xs']); ?>

                    <?= Html::a('Нет', ['', 'answer' => 0, 'question' => $model->getQuestion()->id],
                        ['class' => 'btn btn-danger btn-xs']); ?>

                    <?php if (\Yii::$app->request->get('answer') == 1) : ?>
                        <p>    <?= $model->getQuestion()->answer['text']; ?> </p>
                        <?= Html::ul($model->getQuestion()->answer['options']); ?>
                    <?php endif; ?>
                <?php elseif ($model->text) : ?>
                    <p> Команда не распознана</p>
                <?php endif; ?>

            </div>
        </div>

    </div>
</div>
