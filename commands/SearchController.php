<?php
/**
 * Created by PhpStorm.
 * User: victor
 * Date: 29.07.16
 * Time: 21:38
 */

namespace app\commands;


use yii\console\Controller;
use Yii;

class SearchController extends Controller
{
    public function actionIndexing()
    {
        /** @var \himiklab\yii2\search\Search $search */
        $search = Yii::$app->search;
        $search->index();
    }
}