<?php
/**
 * Created by PhpStorm.
 * User: victor
 * Date: 29.07.16
 * Time: 20:24
 */

namespace app\controllers;


use yii\web\Controller;

class QuestionController extends Controller
{
    public function actionIndex()
    {
        $search = \Yii::$app->search;
        $search->index();
    }

}