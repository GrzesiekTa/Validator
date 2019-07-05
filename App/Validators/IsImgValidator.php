<?php

namespace App\Validators;

use App\Validators\AbstractValidator;

class IsImgValidator extends AbstractValidator {

    /**
     * validator key
     */
    CONST KEY = 'isImg';

    /**
     * @var string 
     */
    protected $errorMessage = 'Tylko jpeg, pjpeg, gif, png';

    /**
     * valid value 
     * 
     * @return bool
     */
    public function valid(): bool {
        $field = $this->field;

        if ((($_FILES[$field]["type"] !== "image/jpeg" && $_FILES[$field]["type"] !== "image/pjpeg" && $_FILES[$field]["type"] !== "image/gif" && $_FILES[$field]["type"] !== "image/x-png"))) {
            return false;
        }

        return true;
    }

}
