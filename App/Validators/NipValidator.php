<?php

namespace App\Validators;

use App\Validators\AbstractValidator;

class NipValidator extends AbstractValidator {

    /**
     * validator key
     */
    CONST KEY = 'nip';

    /**
     * @var string 
     */
    protected $errorMessage = 'Nip nie jest poprawny';

    /**
     * valid value 
     * 
     * @return bool
     */
    public function valid(): bool {
        $value = preg_replace("/[^0-9]+/", "", $this->value);
        if (strlen($value) != 10) {
            return false;
        }

        $arrSteps = array(6, 5, 7, 2, 3, 4, 5, 6, 7);
        $intSum = 0;

        for ($i = 0; $i < 9; $i++) {
            $intSum += $arrSteps[$i] * $value[$i];
        }

        $int = $intSum % 11;

        $intControlNr = ($int == 10) ? 0 : $int;
        if ($intControlNr == $value[9]) {
            return true;
        }

        return false;
    }

}
