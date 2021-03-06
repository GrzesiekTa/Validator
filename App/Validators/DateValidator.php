<?php

namespace App\Validators;

use App\Validators\AbstractValidator;

class DateValidator extends AbstractValidator
{

    /**
     * validator key
     */
    const KEY = 'date';

    /**
     * @var string 
     */
    protected $errorMessage = 'Nie poprawny format daty';

    /**
     * valid value 
     * 
     * @return bool
     */
    public function valid(): bool
    {
        return strtotime($this->value);
    }
}
