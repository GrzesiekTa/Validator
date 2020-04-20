<?php

namespace App\Validators;

use App\Validators\AbstractValidator;

class EmailValidator extends AbstractValidator
{

    /**
     * validator key
     */
    const KEY = 'email';

    /**
     * @var string 
     */
    protected $errorMessage = 'Email nie jest poprawny';

    /**
     * valid value 
     * 
     * @return bool
     */
    public function valid(): bool
    {
        return filter_var($this->value, FILTER_VALIDATE_EMAIL);
    }
}
