<?php

namespace app\api\modules\v1\controllers;


use app\models\search\NodeSearch;
use app\models\WordExtractor;
use yii\rest\Controller;

class BlockController extends Controller
{
    public function actionIndex($userQuery)
    {
        $model = new WordExtractor([
            'text' => $userQuery
        ]);
        $nodes = null;
        $question = null;

//        if ($model->load(\Yii::$app->request->post()) || null !== $answer) {
        $nodes = (new NodeSearch([]))->search($model);
////            $question = (new Dialog([], $nodes))->getQuestion();
//        }
        return $nodes;
//        return $this->render('index', [
//            'model' => $model,
//            'nodes' => $nodes,
////            'question' => $question,
//            'answer' => $answer
//        ]);
    }

    public function actionIndexing($apiToken = null, $botId = null)
    {
        if (!empty($apiToken)) {
            \Yii::$app->get('botParser')->setApiToken($apiToken);
        }
        if (!empty($botId)) {
            \Yii::$app->get('botParser')->setBotId($botId);
        }
        $search = \Yii::$app->search;
        return $search->index();
    }
}