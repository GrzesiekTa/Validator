<?php

namespace App\Validators;

use App\Validators\AbstractValidator;

class RequiredValidator extends AbstractValidator
{

    /**
     * validator key
     */
    const KEY = 'required';

    /**
     * @var string 
     */
    protected $errorMessage = 'Pole :field jest wymagane';

    /**
     * valid value 
     * 
     * @return bool
     */
    public function valid(): bool
    {
        $value = $this->value;

        if (!is_array($value)) {
            if (!is_null($value) && (trim($value) != '')) {
                return true;
            } else {
                return false;
            }
        } elseif (is_array($value)) {
            //type file
            if (isset($value['size'])) {
                if ($value['size'] > 0) {
                    return true;
                } else {
                    return false;
                }
            }

            //empty array return false
            if (empty(array_filter($value))) {
                return false;
            }

            return true;
        } else {
            //TODO
            return false;
        }
    }
}
