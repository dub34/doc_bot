<?php
/**
 * Created by PhpStorm.
 * User: victor
 * Date: 19.09.16
 * Time: 20:25
 */

namespace app\controllers;


use app\models\RemoteNode;
use yii\web\Controller;

class NodeController extends Controller
{

    public function actionIndex()
    {
        var_dump(\Yii::$app->get('botParser')->getNodes()->all());
//        return $this->render('index');
    }

    public function actionIndexing(){
        \Yii::$app->session->removeAll();
        $search = \Yii::$app->search;
        $search->index();
    }
}