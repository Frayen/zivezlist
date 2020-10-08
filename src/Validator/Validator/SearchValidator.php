<?php


namespace App\Validator\Validator;


use App\Entity\SearchAnime;
use App\Validator\Constraints\Sort;
use Symfony\Component\Validator\Mapping\ClassMetadata;

class SearchValidator
{

    public function validateVariables(ClassMetadata $sortValidator, $var) {
        if (isset($var['sort'] ) && !empty($var['sort'])) {
            $sortValidator->addPropertyConstraint($var['sort'], new Sort());
        }
        return true;
    }
}