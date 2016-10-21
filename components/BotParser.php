<?php
/**
 * Created by PhpStorm.
 * User: victor
 * Date: 21.10.16
 * Time: 22:09
 */

namespace app\components;


use yii\base\Model;
use yii\base\Object;
use yii\helpers\ArrayHelper;
use yii\httpclient\Client;
use yii\httpclient\Request;

class BotParser extends Object
{
    public $botId = 92;
    public $url = 'http://getmybot.herokuapp.com/api/semantic_blocks/';
    public $apiToken;

    /**
     * @return Request
     */
    public function getNodes()
    {
        $client = new Client();
        $request = $client->createRequest()
            ->setMethod('get')
            ->setUrl($this->url)
            ->setData(['bot_id' => $this->botId])
            ->setHeaders([
                'Authorization' => 'Basic ' . $this->apiToken
            ]);
        return new \app\components\Request($request);
    }


    public function setApiToken($value)
    {
        $this->apiToken = $value;
        return $this;
    }

    public function setBotId($value)
    {
        $this->botId = $value;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * @param mixed $model
     */
    public function setModel($model)
    {
        $this->model = $model;
    }

}