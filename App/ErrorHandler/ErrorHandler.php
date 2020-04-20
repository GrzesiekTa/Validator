<?php

namespace App\ErrorHandler;

class ErrorHandler {

    /**
     * @var array
     */
    protected $errors = [];

    /**
     * @param string $errors
     * @param string $key
     */
    public function addError(string $errors, string $key = null): void {
        if ($key) {
            $this->errors[$key][] = $errors;
        } else {
            $this->errors[] = $errors;
        }
    }

    /**
     * @param string $key
     * @return type
     */
    public function allErrors(string $key = null) {
        return isset($this->errors[$key]) ? $this->errors[$key] : $this->errors;
    }

    /**
     * check errors
     * 
     * @return bool
     */
    public function hasErrors(): bool {
        return count($this->allErrors()) ? true : false;
    }

    /**
     * firsterror
     * 
     * @param string $key
     * 
     * @return string|null
     */
    public function firstError(string $key):?string {
        return $this->allErrors()[$key][0] ?? null;
    }

}
