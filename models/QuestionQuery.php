<?php
/**
 * Created by PhpStorm.
 * User: victor
 * Date: 29.07.16
 * Time: 21:44
 */

namespace app\models;


use yii\db\ActiveQuery;
use yii\db\Query;

class QuestionQuery extends ActiveQuery
{
    public function all($db = null)
    {
        $q = [];
        foreach (Question::questions() as $question) {
            $q[] = new Question($question);
        }
        return $q;
    }

}