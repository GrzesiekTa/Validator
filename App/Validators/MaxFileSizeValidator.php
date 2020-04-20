<?php

namespace App\Validators;

use App\Validators\AbstractValidator;

class MaxFileSizeValidator extends AbstractValidator
{

    /**
     * validator key
     */
    const KEY = 'maxFileSize';

    /**
     * @var string 
     */
    protected $errorMessage = 'za duzy plik max :satisfier kb';

    /**
     * valid value 
     * 
     * @return bool
     */
    public function valid(): bool
    {
        $field = $this->field;

        if (!isset($_FILES[$field]["size"])) {
            return false;
        }

        if ($_FILES[$field]["size"] > $this->satisfier) {
            return false;
        }

        return true;
    }
}
