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
    protected $errorMessage = 'To pole musi być liczbą';

    /**
     * valid value 
     * 
     * @return bool
     */
    public function valid(): bool {
        return is_integer($this->value);
    }

}
