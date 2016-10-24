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
            <div class="col-lg-4">
<!--                --><?php //if (!empty($model->getStemm())) : ?>
                    <h4>Найдены блоки</h4>
<!--                    --><?php //foreach ($nodes as $key => $tree): ?>
                        <?= var_dump($nodes); ?>
<!--                        <h5>Корень --><?//= $key; ?><!-- </h5>-->
<!--                        --><?php //foreach ($tree as $item) {
//                            echo \yii\helpers\ArrayHelper::getValue($item, 'name', false);
//                            echo '---';
//                            echo \yii\helpers\ArrayHelper::getValue($item->parents(1)->one(), 'id');
//                            echo '---';
//                            echo \yii\helpers\ArrayHelper::getValue($item, 'id', false);
//                            echo "<br>";
//                        } ?>
<!--                    --><?php //endforeach; ?>
<!---->
<!--                    <!--                    -->
<!--                --><?php //endif; ?>
                <!--                --><?php //if (!empty($model->getStemm())) : ?>
                <!---->
                <!---->
                <!--                    <h4>Стеммы</h4>-->
                <!--                    --><?php //= implode(', ', $model->getStemm()->words); ?>
                <!--                --><?php //endif; ?>
                <!---->
            </div>

        </div>


        <!--        --><?php //var_dump($nodes); ?>
<!--        --><?php //if (null !== $question): ?>
<!--            --><?php //if (!$answer): ?>
<!--                --><?//= $question->text; ?>
<!---->
<!--                --><?//= Html::a('Да', ['/', 'answer' => true], ['class' => 'btn btn-success btn-xs']); ?>
<!--                --><?//= Html::a('Нет', ['/', 'answer' => false], ['class' => 'btn btn-danger btn-xs']); ?>
<!--            --><?php //else: ?>
<!--                Найден узел: --><?//= $question->node->name; ?>
<!--                ID: --><?//= $question->node->id; ?>
<!--            --><?php //endif; ?>
<!--            --><?php ////= implode(', ', \yii\helpers\ArrayHelper::getColumn($question->getTags(), 'name')); ?>
<!--        --><?php //endif; ?>
    </div>
</div>
