<?php

namespace App\Validators;

use App\Validators\AbstractValidator;

class IntegerValidator extends AbstractValidator {

    /**
     * validator key
     */
    CONST KEY = 'isInteger';

    /**
     * @var string 
     */
    protected $errorMessage = 'To pole musi byc liczba…';

    /**
     * valid value 
     * 
     * @return bool
     */
    public function valid(): bool {
        return filter_var($this->value, FILTER_VALIDATE_INT);
    }

}
