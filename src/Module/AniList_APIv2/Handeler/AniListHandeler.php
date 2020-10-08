<?php


namespace App\Module\AniList_APIv2\Handeler;


use App\Module\AniList_APIv2\Endpoint\Endpoint;
use App\Module\AniList_APIv2\Intrepeter\Interpreter;

class AniListHandeler {

    private $endpoint;

    public function __construct(Endpoint $endpoint) {
        $this->endpoint = $endpoint;
    }

    public function getData($variables, $query) {
        $this->endpoint->setVariables($variables);
        $this->endpoint->setQuery($query);



        $intrepeter = new Interpreter($this->endpoint->doRequest());

        $formattedData = $intrepeter->GetDataIntrepeter();


        if (isset($formattedData) && empty($formattedData)) {
//            throw ();
        }
        return $formattedData;
    }
    public function test() {

    }
}