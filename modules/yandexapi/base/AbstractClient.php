<?php
/**
 * Created by PhpStorm.
 * User: ilypk
 * Date: 02.10.2018
 * Time: 0:01
 */
namespace app\modules\yandexapi\base;

use GuzzleHttp\Client;

abstract class AbstractClient
{

    public $module;

    protected $client;

    protected $token;

    protected $version;

    public function __construct()
    {
        $this->baseUrl = $this->baseUrl."/".$this->version;
        $this->setToken($this->module->params['token']);
    }

    public function getClient() {
        if($this->client === null) {
            $this->client = new Client();
        }
        return $this->client;
    }

    public function sendRequest($method = 'GET', $url, $options) {
        $client = $this->getClient();
        return $client->request($method, $url, [
            'Authorization' => $this->token
        ]);
    }

    public function setToken($token) {
        $this->token = $token;
        return $this;
    }

    public function setApiVersion($version) {
        $this->version = $version;
        return $this;
    }

}