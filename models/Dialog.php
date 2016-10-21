<?php
/**
 * Created by PhpStorm.
 * User: victor
 * Date: 20.09.16
 * Time: 22:44
 */

namespace app\models;


use yii\base\Model;
use yii\helpers\ArrayHelper;

class Dialog extends Model
{
    const MAX_LEVEL = 4;

    public $root;
    public $lvl;
    public $exactNode;
    public $questionAnswer = null;

    public function __construct(array $config, $indexSearchResult)
    {
        parent::__construct($config);
        if (null == $this->questionAnswer) {
            $this->prepareSearchResult($indexSearchResult);
        }
        $this->lvl = \Yii::$app->session->get('lvl');
        $this->exactNode = \Yii::$app->session->get('node');
    }

    private function prepareSearchResult($searchResult)
    {
        $this->prepareRoot($searchResult);
        $this->prepareLevel($searchResult);
    }

    private function prepareRoot($searchResult)
    {
        if (null == $this->root && null !== $searchResult) {
            $this->root = (count($searchResult) > 1) ? array_keys($searchResult) : current(array_keys($searchResult));
        }
        \Yii::$app->session->set('root', $this->root);
    }

    private function prepareLevel($searchResult)
    {
        if (empty($searchResult) || is_array($this->root)) {
            $this->lvl = 0;
            $this->exactNode = null;
        } else {
            $searchResult[$this->root] = self::removeDuplicates($searchResult[$this->root]);
            if (count($searchResult[$this->root]) == 1) {
                $this->lvl = ArrayHelper::getValue(current($searchResult), '0.lvl') + 1;
                $this->exactNode = ArrayHelper::getValue(current($searchResult), '0.id');
            } else {
                $levels = ArrayHelper::getColumn($searchResult[$this->root], 'lvl', false);
                $this->lvl = $this->getMaxLevel($levels);
                $this->exactNode = $this->getExactNode($searchResult[$this->root]);
            }

            if ($this->lvl > self::MAX_LEVEL) {
                $this->lvl = self::MAX_LEVEL;
            }

        }
            \Yii::$app->session->set('lvl', $this->lvl);
            \Yii::$app->session->set('node', $this->exactNode);
        /*
         *
         * 1) {n1:1;n2:2...}
         * 2) {n1:1;n2:1;n3:5...}
         *
         * lvl_exact, id_exact
         */
    }

    private function getExactNode($nodes)
    {
        ArrayHelper::multisort($nodes, 'lvl', SORT_DESC);
        $lvlPrev = $nodes[0]['lvl'];
        $nodeId = $nodes[0]['id'];
        $nodesByLvl = [];
        for ($i = 1; $i < count($nodes); $i++) {
            $nodesByLvl[] = $nodes[$i - 1]['id'];
            if ($lvlPrev !== $nodes[$i]['lvl']) {
                break;
            }
            $lvlPrev = $nodes[$i]['lvl'];
            $nodeId = $nodes[$i - 1]['id'];
        }
        \Yii::$app->session->set('foundNodes', $nodesByLvl);
        return $nodeId;
    }

    private function getMinLevel(array $levels = [])
    {
        $level = 0;
        sort($levels);
        for ($i = 0; $i < count($levels); $i++) {
            if ($i > 0 && $levels[$i] == $levels[$i - 1]) {
                if ($i == 1) {
                    $level++;
                }
                break;
            }
            $level = $levels[$i];
        }
        return $level;
    }

    private function getMaxLevel(array $levels = [])
    {
        $level = 0;
        rsort($levels);
        for ($i = 0; $i < count($levels); $i++) {
            if ($i > 0 && $levels[$i] == $levels[$i - 1]) {
                break;
            }
            $level = $levels[$i];
        }
        return $level;
    }

    public function getQuestion()
    {
        if (null !== $this->exactNode) {
            return (new Question())->find()->where(['node_id' => $this->exactNode])->one();
        }
        return null;
    }

    public static function removeDuplicates($array)
    {
        $newArray = [];
        foreach ($array as $key => $value) {
            if (!array_key_exists($value->id, $newArray)) {
                $newArray[$value->id] = $value;
            }
        }
        return array_values($newArray);
    }
}