<?php

namespace App\Validators;

use App\Validators\AbstractValidator;

class UrlValidator extends AbstractValidator {

    /**
     * validator key
     */
    CONST KEY = 'url';

    /**
     * @var string 
     */
    protected $errorMessage = 'Adres url nie jest poprawny';

    /**
     * valid value 
     * 
     * @return bool
     */
    public function valid(): bool {
        return filter_var($this->value, FILTER_VALIDATE_URL);
    }

}
