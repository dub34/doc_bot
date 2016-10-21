<?php
/**
 * Created by PhpStorm.
 * User: victor
 * Date: 21.10.16
 * Time: 22:37
 */

namespace app\components;


use app\models\RemoteNode;
use yii\base\Model;
use yii\helpers\ArrayHelper;

class Request
{
    /**
     * @var $request \yii\httpclient\Request
     */
    public $request;
    public $model = RemoteNode::class;

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function all()
    {
        $response = $this->request->send();
        if ($response->isOk) {
            return $this->prepareResult($response->data);
        }
        return [];
    }

    private function prepareResult($data)
    {
        $models = [];
        if (!empty($data['results'])) {

            foreach ($data['results'] as $modelData) {
                /**
                 * @var $model Model
                 */
                $model = new $this->model;
                $model->nodeId = ArrayHelper::getValue($modelData, 'node.id');
                $model->blockId = ArrayHelper::getValue($modelData, 'id');
                $model->nodeName = ArrayHelper::getValue($modelData, 'node.text');
                $model->tags = implode(' ', ArrayHelper::getValue($modelData, 'tag_names', []));
                $model->nodeParent = ArrayHelper::getValue($modelData, 'node.parent');
                $models[] = $model;
            }
        }
        return $models;
    }
}