<?php


namespace App\Module\AniList_APIv2\Client;


use App\Module\AniList_APIv2\Endpoint\Endpoint;
use GuzzleHttp\Client;

class AniListClient implements ClientInterface
{
    public function doRequest(Endpoint $endpoint) {
//        $ch = curl_init();
//
//        curl_setopt($ch, CURLOPT_URL, $endpoint->getUrl());
//        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 0);
//        curl_setopt($ch, CURLOPT_POSTFIELDS,  json_encode(['query' => $endpoint->getQuery(), 'variables' =>$endpoint->getVariables()]));
//        curl_setopt($ch, CURLOPT_POST, 1);
//        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
//
//        $result = curl_exec($ch);

        $http = new Client();
        $response = $http->post($endpoint->getUrl(), [
            'json' => [
                'query' => $endpoint->getQuery(),
                'variables' => $endpoint->getVariables(),
            ]
        ]);
        return $response->getBody();
    }
}