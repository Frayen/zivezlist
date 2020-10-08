<?php


namespace App\Module\AniList_APIv2\Intrepeter;


class Interpreter {

    private $result;

    public function __construct($result) {
        $this->result = $result;
    }

    public function GetDataIntrepeter(){
        return json_decode($this->result, true);
    }
}