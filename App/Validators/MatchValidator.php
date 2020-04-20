<?php

namespace App\Validators;

use App\Validators\AbstractValidator;

class MatchValidator extends AbstractValidator
{

    /**
     * validator key
     */
    const KEY = 'match';

    /**
     * @var string 
     */
    protected $errorMessage = 'Hasla nie sa takie same';

    /**
     * valid value 
     * 
     * @return bool
     */
    public function valid(): bool
    {
        if (!isset($this->validateItems[$this->satisfier])) {
            return false;
        }

        return $this->value === $this->validateItems[$this->satisfier];
    }
}
