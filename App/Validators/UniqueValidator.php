<?php

namespace App\Validators;

use App\Validators\AbstractValidator;

class UniqueValidator extends AbstractValidator
{

    /**
     * validator key
     */
    const KEY = 'unique';

    /**
     * @var string 
     */
    protected $errorMessage = 'Podane pole :field juz istnieje w bazie musisz urzyc innego';

    /**
     * valid value 
     * 
     * @return bool
     */
    public function valid(): bool
    {
        $dataBase = $this->getDataBase();

        try {
            return !$dataBase->table($this->satisfier)->exists([
                $this->field => $this->value,
            ]);
        } catch (\Exception $ex) {
            return false;
        }
    }
}
