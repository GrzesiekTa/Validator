<?php

namespace App\Validators;

use App\Validators\AbstractValidator;

class PostCodeValidator extends AbstractValidator {

    /**
     * validator key
     */
    CONST KEY = 'postCode';

    /**
     * @var string 
     */
    protected $errorMessage = 'Adres pocztowy nie jest poprawny';

    /**
     * valid value 
     * 
     * @return bool
     */
    public function valid(): bool {
        $value = preg_replace("([-]+)", "", $this->value);
        return preg_match('/^[0-9]{2}-?[0-9]{3}$/Du', $value);
    }

}
