<?php
/**
 * Created by PhpStorm.
 * User: ilypk
 * Date: 02.10.2018
 * Time: 0:21
 */
namespace app\modules\yandexapi\marketapi\reviews;

use app\modules\yandexapi\marketapi\MarketClient;
use GuzzleHttp\Exception\ClientException;

class Reviews extends MarketClient
{

    public function getModelReviews($modelId = null) {
        try {
            $result = $this->sendRequest('GET', $this->baseUrl."/models/{$modelId}/opinions", [])->getBody();
        } catch (ClientException $e) {
            return [];
        }
        return $result;
    }
}