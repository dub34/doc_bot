<?php

namespace app\controllers;

use app\models\WordExtractor;
use Yii;
use yii\data\ArrayDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        $model = new WordExtractor();
        if (\Yii::$app->request->get('answer')) {
            $model->searchQuestion(\Yii::$app->request->get('question'));

        } else {
            if ($model->load(\Yii::$app->request->post())) {
                {
                    $model->extractWords()
                        ->stemmWords()
                        ->searchQuestion();
                }
            }
        }
        return $this->render('index', ['model' => $model]);
    }

//    public function actionSearch($q = '')
//    {
//        /** @var \himiklab\yii2\search\Search $search */
//        $search = Yii::$app->search;
//        $searchData = $search->find($q); // Search by full index.
//        //$searchData = $search->find($q, ['model' => 'page']); // Search by index provided only by model `page`.
//
//        $dataProvider = new ArrayDataProvider([
//            'allModels' => $searchData['results'],
//            'pagination' => ['pageSize' => 10],
//        ]);
//
//        var_dump($dataProvider->getModels()[0]->uid);
//    }

    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    public function actionAbout()
    {
        return $this->render('about');
    }

}
