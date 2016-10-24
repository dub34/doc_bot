<?php
/**
 * Created by PhpStorm.
 * User: victor
 * Date: 21.10.16
 * Time: 22:04
 */

namespace app\models;

use himiklab\yii2\search\behaviors\SearchBehavior;
use yii\base\Model;

class RemoteNode extends Model
{
    public $blockId;
    public $nodeId;
    public $nodeName;
    public $tags;
    public $nodeParent;

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['search'] = [
            'class' => SearchBehavior::className(),
//                'searchScope' => function ($model) {
            /** @var \yii\db\ActiveQuery $model */
//            $model->select(['keywords']);
//                },
            'searchFields' => function ($model) {
                /** @var self $model */
                return [
                    ['name' => 'nodeId', 'value' => $model->nodeId, SearchBehavior::FIELD_KEYWORD],
                    ['name' => 'blockId', 'value' => $model->blockId, SearchBehavior::FIELD_KEYWORD],
                    ['name' => 'tag', 'value' => strip_tags($model->tags), SearchBehavior::FIELD_KEYWORD],
//                    ['name' => 'lvl', 'value' => $model->lvl, SearchBehavior::FIELD_KEYWORD],
//                    ['name' => 'root', 'value' => $model->root, SearchBehavior::FIELD_KEYWORD],
                    ['name' => 'name', 'value' => $model->nodeName, SearchBehavior::FIELD_TEXT],
//                    ['name' => 'parent', 'value' => ArrayHelper::getValue($model->parents(1)->one(), 'id'), SearchBehavior::FIELD_KEYWORD]
                ];
            }
        ];
        return $behaviors;
    }

    public function find(){
        return \Yii::$app->get('botParser')->getNodes();
    }

    public function rules()
    {
        return [
            [
                [
                    'blockId',
                    'nodeId',
                    'nodeName',
                    'tags',
                    'nodeParent'
                ],
                'safe'
            ]
        ];
    }
}