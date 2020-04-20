<?php

namespace App\Validators;

use App\Validators\AbstractValidator;

class RegonValidator extends AbstractValidator
{

    /**
     * validator key
     */
    const KEY = 'regon';

    /**
     * @var string 
     */
    protected $errorMessage = 'Regon nie jest poprawny';

    /**
     * valid value 
     * 
     * @return bool
     */
    public function valid(): bool
    {
        if (strlen($this->value) != 9) {
            return false;
        }

        $arrSteps = array(8, 9, 2, 3, 4, 5, 6, 7);
        $intSum = 0;
        for ($i = 0; $i < 8; $i++) {
            $intSum += $arrSteps[$i] * $this->value[$i];
        }
        $int = $intSum % 11;
        $intControlNr = ($int == 10) ? 0 : $int;

        if ($intControlNr == $this->value[8]) {
            return true;
        }

        return false;
    }
}
