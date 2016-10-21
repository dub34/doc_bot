<?php
/**
 * Created by PhpStorm.
 * User: victor
 * Date: 29.07.16
 * Time: 20:26
 */

namespace app\models\search;


use himiklab\yii2\search\behaviors\SearchBehavior;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\db\ActiveRecord;

class QuestionSearch extends \app\models\Question
{
    public function search()
    {
        $q = self::find();

        return new ActiveDataProvider([
            'query' => $q
        ]);
    }
}