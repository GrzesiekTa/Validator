<?php

namespace App\Validators;

use App\Validators\AbstractValidator;

class MinLenghtValidator extends AbstractValidator {

    /**
     * validator key
     */
    CONST KEY = 'minlenght';

    /**
     * @var string 
     */
    protected $errorMessage = 'Pole :field musi mieæ min :satisifer znaków';

    /**
     * valid value 
     * 
     * @return bool
     */
    public function valid(): bool {
        return mb_strlen($this->value) >= $this->satisifer;
    }

}
