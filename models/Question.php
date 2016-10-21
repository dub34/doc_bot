<?php
/**
 * Created by PhpStorm.
 * User: victor
 * Date: 29.07.16
 * Time: 20:26
 */

namespace app\models;

use himiklab\yii2\search\behaviors\SearchBehavior;
use yii\db\ActiveRecord;

class Question extends ActiveRecord
{
    public function rules()
    {
        return [
            [['text',], 'string'],
            [['lvl', 'root'], 'integer'],
            [['lvl', 'root'], 'unique', 'targetAttribute' => ['lvl', 'root']]
        ];
    }

    public static function tableName()
    {
        return '{{%question}}';
    }


    public static function find()
    {
        return new QuestionQuery(get_called_class());
    }

    public function getTags()
    {
        $nodeId = \Yii::$app->session->get('node');
        $node = Node::find()->where(['id' => $nodeId])->one();
        if (null !== $node) {
            $nodes = $node->children(1)->all();
        } else {
            $nodes = [];
        }
        return $nodes;
//        return Node::find()->andWhere(['lvl' => $this->lvl, 'root' => $this->root])->all();
//        return Node::find()->andWhere(['lvl' => $this->lvl, 'root' => $this->root])->all();
    }

    public function getNode()
    {
        return $this->hasOne(Node::className(), ['id' => 'node_id']);
    }
}