<?php
/**
 * Created by PhpStorm.
 * User: victor
 * Date: 19.09.16
 * Time: 23:17
 */

namespace app\models\search;


use app\models\Node;
use app\models\WordExtractor;
use Mystem\ArticleWord;
use yii\helpers\ArrayHelper;

class NodeSearch extends Node
{
    public function init()
    {
        $this->root = \Yii::$app->session->get('root');
        $this->lvl = \Yii::$app->session->get('lvl');
        $this->id = \Yii::$app->session->get('node');
        $this->foundNodes = \Yii::$app->session->get('foundNodes');
        $this->negativeAnsweredNodes = \Yii::$app->session->get('negativeAnsweredNodes');
        parent::init();
    }

    public function search(WordExtractor $model, $answer = null)
    {
        if (null !== $answer) {
            return $this->searchByAnswer($answer);
        } else {
            return $this->searchByKeywords($model);
        }
    }


    public function searchByKeywords(WordExtractor $model)
    {
        $keywords = $model->extractWords()->stemmWords();

        $models = [];
        /**
         * @var $keyword ArticleWord
         */
        foreach ($keywords->getStemm()->words as $keyword) {
            $queryString = 'tag:' . $keyword->normalized();

            if (null !== $this->root && !is_array($this->root)) {
                $queryString .= " root:(+$this->root)";
            }

            if (null !== $this->id) {
                $queryString .= "parent:(+$this->id)";
            }

            $query = \Yii::$app->search->find($queryString);
            foreach (ArrayHelper::getValue($query, 'results', []) as $found) {
                if (!in_array($found->node_id, $models)) {
                    $models[$found->root][] = Node::findOne($found->node_id);
                }
            }
        }
        return $models;
    }

    public function searchByAnswer($answer)
    {

        if (false == $answer && null !== $this->foundNodes) {
            $this->negativeAnsweredNodes[] = $this->id;
            \Yii::$app->session->set('negativeAnsweredNodes', $this->negativeAnsweredNodes);
            $this->id = current(array_diff($this->foundNodes, $this->negativeAnsweredNodes));
        }
        if(false == $this->id){
            return null;
        }
        $models[$this->root][] = Node::findOne($this->id);
        return $models;
    }
}