<?php


namespace App\Module\AniList_APIv2\Endpoint;


use App\Module\AniList_APIv2\Client\ClientInterface;

class Endpoint
{
    const ANIME_LIST_API = 'ANIME_LIST_API';

    private $client;
    private $query;
    private $variables;

    public function __construct(ClientInterface $client) {
        $this->client = $client;
    }

    public function doRequest() {
        return $this->client->doRequest($this);
    }

    public function getUrl() {
        return $_SERVER[self::ANIME_LIST_API];
    }

    public function setQuery($query) {
        return $this->query = $query;
    }

    public function getQuery() {
        return $this->query;
    }
    
    public function setVariables($variables=[]) {
        $this->variables = $variables;
    }
    public function getVariables() {
        return $this->variables;
    }
}