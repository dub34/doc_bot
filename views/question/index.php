<?php
/**
 * Created by PhpStorm.
 * User: victor
 * Date: 19.09.16
 * Time: 23:20
 * @var $questions \app\models\Question[]
 */
?>

<?= \yii\bootstrap\Html::a('Добавить', ['create'])?>
<?=
\yii\grid\GridView::widget([
    'dataProvider' => $questions,
    'columns' => [
        'root',
        'lvl',
        'text',
    ]
])
?>
