<?php

namespace App\Validators;

abstract class AbstractValidator {

    /**
     * default error message for validator
     * 
     * @var string
     */
    protected $errorMessage = 'TODO';

    /**
     * @var string 
     */
    protected $field;

    /**
     * @var string 
     */
    protected $value;

    /**
     * @var string 
     */
    protected $satisifier;

    /**
     * @param string $field
     * @param string $value
     * @param string $satisifier
     */
    public function __construct(string $field, string $value, string $satisifier) {
        $this->field = $field;
        $this->value = $value;
        $this->satisifier = $satisifier;
    }

    /**
     * get error message
     * 
     * @return string
     */
    public function getErrorMessage() {
        return $this->errorMessage;
    }

    /**
     * valid value 
     * 
     * @return bool
     */
    abstract public function valid(): bool;
}
