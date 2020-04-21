<?php

namespace App\ErrorHandler;

abstract class AbstractErrorHandler
{
    /**
     * @var array
     */
    protected $errors = [];

    /**
     * add error
     * 
     * @param string $errors
     * 
     * @param string $key
     */
    public function addError(string $errorMessage, string $key): void
    {
        $this->errors[$key][] = $errorMessage;
    }

    /**
     * this method return array with all errors or errors array for specific key
     * 
     * @param string $key
     * 
     * @return array
     */
    public function getErrors(string $key = null): array
    {
        if ($key) {
            return $this->errors[$key] ?? [];
        }

        return $this->errors;
    }

    /**
     * check errors
     * 
     * @return bool
     */
    public function hasErrors(): bool
    {
        return count($this->errors) ? true : false;
    }

    /**
     * get first error
     * 
     * @param string $key
     * 
     * @return string|null
     */
    public function firstError(string $key): ?string
    {
        return $this->errors[$key][0] ?? null;
    }
    /**
     * this method will count all errors or errors for a given key
     *
     * @param string $key
     * 
     * @return integer
     */
    public function countErrors(string $key = null): int
    {
        return count($this->getErrors($key));
    }
}
