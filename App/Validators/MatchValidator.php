<?php

namespace App\Validators;

use App\Validators\AbstractValidator;

class MatchValidator extends AbstractValidator {

    /**
     * validator key
     */
    CONST KEY = 'match';

    /**
     * @var string 
     */
    protected $errorMessage = 'Has³a nie s¹ takie same';

    /**
     * valid value 
     * 
     * @return bool
     */
    public function valid(): bool {
        if (!isset($this->validateItems[$this->satisfier])) {
            return false;
        }

        return $this->value === $this->validateItems[$this->satisfier];
    }

}
