<?php
/**
 * Created by PhpStorm.
 * User: victor
 * Date: 29.07.16
 * Time: 20:26
 */

namespace app\models;


use himiklab\yii2\search\behaviors\SearchBehavior;
use yii\base\Model;
use yii\db\ActiveRecord;

class Question extends Model
{
    public $id;
    public $text;
    public $keywords;
    public $answer;

    public function rules()
    {
        return [
            [['id', 'text', 'keywords', 'answer'], 'safe']
        ];
    }

    public static function tableName()
    {
        return 'question';
    }


    public static function find()
    {
        return new QuestionQuery(get_called_class());
    }


    public function behaviors()
    {
        return [
            'search' => [
                'class' => SearchBehavior::className(),
//                'searchScope' => function ($model) {
                    /** @var \yii\db\ActiveQuery $model */
//            $model->select(['keywords']);
//                },
                'searchFields' => function ($model) {
                    /** @var self $model */
                    return [
                        ['name' => 'uid', 'value' => $model->id],
                        ['name' => 'keywords', 'value' => strip_tags($model->keywords)],
                    ];
                }
            ],
        ];
    }

    public static function questions()
    {
        return [
            [
                'id' => 1,
                'text' => 'Вы хотите отремонтировать автомобиль Mazda?',
                'keywords' => 'ремонт,ремонтировать,ремонт проблема,сломаться,ломаться,
                            обслуживание,замена, заменить, сервис,автосервис,запчасти, мазда,mazda,трешка,шестерка,хотеть,починить,починять,хочу починить,отремонтировать',
                'answer' => [
                    'text' => 'Выберите модель:',
                    'options' =>
                        [
                            'Mazda 3',
                            'Mazda 6',
                            'CX-5',
                            'CX-7',
                        ]
                ]
            ],
            [
                'id' => 2,
                'text' => 'Вы хотите отремонтировать автомобиль Mercedes?',
                'keywords' => 'ремонт,ремонтировать,ремонт проблема,сломаться,ломаться,
                            обслуживание,замена, заменить, сервис,автосервис,запчасти,mercedes,мерседес,mersedes, мерин',
                'answer' => [
                    'text' => 'Выберите год выпуска:',
                    'options' => [
                        '2016',
                        '2015',
                        '2014',
                        '2013',
                        '2012',
                        '2011',
                        '2010 и старше',
                    ]
                ]
            ],
            [
                'id' => 3,
                'text' => 'Вас интересуют новые модели Mercedes ?',
                'keywords' => 'купить,новый,модель,новинка, хотеть,mercedes,мерседес,mersedes, мерин',
                'answer' => [
                    'text' => 'Какой класс автомобиля вас интересует?',
                    'options' => [
                        'Седаны',
                        'Хэтчбэки',
                        'Универсалы',
                        'Купе',
                        'Кабриолеты и родстеры',
                        'Внедородники',
                        'Минивэны',
                    ]
                ]
            ],
            [
                'id' => 4,
                'text' => 'Вас интересуют новые модели Mazda?',
                'keywords' => 'купить,новый,модель,новинка,хотеть,мазда,mazda,трешка,шестерка',
                'answer' => [
                    'text' => 'Какая модель вас интересует?',
                    'options' => [
                        'Mazda 3',
                        'Mazda 6',
                        'CX-5',
                        'CX-7',
                    ]
                ]
            ],
        ];
    }

//    public function getSearchModels(){
//        return new QuestionQuery(get_called_class());
//    }
}