<?php

namespace App\Validators;

use App\Validators\AbstractValidator;

class PhoneValidator extends AbstractValidator
{

    /**
     * validator key
     */
    const KEY = 'phone';

    /**
     * @var string 
     */
    protected $errorMessage = '"Numer tel nie jest poprawny: przyklad 500-500-500, 34-315-43-34,500500500, 343154334';

    /**
     * valid value 
     * 
     * @return bool
     */
    public function valid(): bool
    {
        $value = preg_replace("([- ]+)", "", $this->value);
        $reg = '/^[0-9]{8,13}$/';

        return preg_match($reg, $value);
    }
}
