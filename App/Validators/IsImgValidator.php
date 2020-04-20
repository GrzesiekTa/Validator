<?php

namespace App\Validators;

use App\Validators\AbstractValidator;

class IsImgValidator extends AbstractValidator
{

    /**
     * validator key
     */
    const KEY = 'isImg';

    /**
     * @var string 
     */
    protected $errorMessage = 'Tylko jpeg, pjpeg, gif, png';

    /**
     * valid value 
     * 
     * @return bool
     */
    public function valid(): bool
    {
        $field = $this->field;

        if (!isset($_FILES[$field]["type"])) {
            return false;
        }

        if (!in_array($_FILES[$field]["type"], ['image/jpeg', 'image/pjpeg', 'image/gif', 'image/x-png'])) {
            return false;
        }

        return true;
    }
}
