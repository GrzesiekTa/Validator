<?php

namespace App\Validators;

use App\Validators\AbstractValidator;

class MinLenghtValidator extends AbstractValidator
{

    /**
     * validator key
     */
    const KEY = 'minlenght';

    /**
     * @var string 
     */
    protected $errorMessage = 'Pole :field musi miec min :satisfier znakow';

    /**
     * valid value 
     * 
     * @return bool
     */
    public function valid(): bool
    {
        return mb_strlen($this->value) >= $this->satisfier;
    }
}
