<?php

namespace App\Validators;

use App\Validators\AbstractValidator;

class HasIntegerValidator extends AbstractValidator {

    /**
     * validator key
     */
    CONST KEY = 'hasInteger';

    /**
     * @var string 
     */
    protected $errorMessage = 'To :field musi zawierac liczbe';

    /**
     * valid value 
     * 
     * @return bool
     */
    public function valid(): bool {
        return ctype_alnum($rhis->value);
    }

}
