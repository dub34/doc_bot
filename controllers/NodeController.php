<?php
/**
 * Created by PhpStorm.
 * User: victor
 * Date: 19.09.16
 * Time: 20:25
 */

namespace app\controllers;


use yii\web\Controller;

class NodeController extends Controller
{

    public function actionIndex()
    {
        return $this->render('index');
    }
}