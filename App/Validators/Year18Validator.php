<?php

namespace App\Validators;

use App\Validators\AbstractValidator;

class Year18Validator extends AbstractValidator {

    /**
     * validator key
     */
    CONST KEY = 'year18';

    /**
     * @var string 
     */
    protected $errorMessage = 'Aby zalozyc konto w tym serwisie musisz miec ukonczone 18 lat';

    /**
     * valid value 
     * 
     * @return bool
     */
    public function valid(): bool {
        $value = $this->value;

        if (!filter_var($value, FILTER_VALIDATE_INT)) {
            return false;
        } else {
            $check18YearsOld = date("Y") - $value;

            if ($check18YearsOld >= 18) {
                return true;
            } else {
                return false;
            }
        }
    }

}
