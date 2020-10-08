<?php


namespace App\Validator\Constraints;


use Symfony\Component\Validator\Constraint;

class Sort extends Constraint
{
    public $message = 'The sort "{{ string }}" is not valid!';

    public function validateBy(){
        return \get_class($this) . 'Validator';
    }
}