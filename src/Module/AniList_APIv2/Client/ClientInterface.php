<?php


namespace App\Module\AniList_APIv2\Client;

use App\Module\AniList_APIv2\Endpoint\Endpoint;

interface ClientInterface
{
    public function doRequest(Endpoint $endpoint);
}