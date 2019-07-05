<?php

namespace App\Validators;

use App\Validators\AbstractValidator;

class MaxLenghtValidator extends AbstractValidator {

    /**
     * validator key
     */
    CONST KEY = 'maxlenght';

    /**
     * @var string 
     */
    protected $errorMessage = 'Pole :field musi mie� max :satisifer znak�w';

    /**
     * valid value 
     * 
     * @return bool
     */
    public function valid(): bool {
        return mb_strlen($this->value) >= $this->satisifer;
    }

}
