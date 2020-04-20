<?php

namespace App\Validators;

use App\Validators\AbstractValidator;

class MaxLenghtValidator extends AbstractValidator
{

    /**
     * validator key
     */
    const KEY = 'maxlenght';

    /**
     * @var string 
     */
    protected $errorMessage = 'Pole :field musi miec max :satisfier znakow';

    /**
     * valid value 
     * 
     * @return bool
     */
    public function valid(): bool
    {
        return mb_strlen($this->value) <= $this->satisfier;
    }
}
