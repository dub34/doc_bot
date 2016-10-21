<?php
/**
 * Created by PhpStorm.
 * User: victor
 * Date: 29.07.16
 * Time: 20:24
 */

namespace app\controllers;


use app\models\Question;
use app\models\search\NodeSearch;
use app\models\search\QuestionSearch;
use yii\web\Controller;

class QuestionController extends Controller
{
    public function actionIndex()
    {
        $dataProvider = (new QuestionSearch())->search();
        return $this->render('index', ['questions' => $dataProvider]);
    }

    public function actionCreate()
    {
        $question = new Question();

        if ($question->load(\Yii::$app->request->post()) && $question->validate()) {
            $question->save();
            return $this->redirect(['/question']);
        }
        return $this->render('create', ['question' => $question]);
    }
}