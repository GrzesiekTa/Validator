<?php

namespace App\Validators;

use App\Validators\AbstractValidator;

class IntegerValidator extends AbstractValidator
{

    /**
     * validator key
     */
    const KEY = 'isInteger';

    /**
     * @var string 
     */
    protected $errorMessage = 'To pole musi byc liczba';

    /**
     * valid value 
     * 
     * @return bool
     */
    public function valid(): bool
    {
        if (filter_var($this->value, FILTER_VALIDATE_INT) === false) {
            return false;
        }

        return true;
    }
}
