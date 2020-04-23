<?php

namespace App\Validators;

use App\Database\Database;

abstract class AbstractValidator
{

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
     * @var mixed 
     */
    protected $value;

    /**
     * @var string 
     */
    protected $satisfier;

    /**
     * validateItems collection
     * 
     * @var array 
     */
    protected $validateItems;
    /**
     * @var Database|null
     */
    protected $dataBase;

    /**
     * @param string $field
     * @param mixed $value
     * @param string $satisfier
     * @param array $validateItems
     */
    public function __construct(string $field, $value, string $satisfier, array $validateItems)
    {
        $this->field = $field;
        $this->value = $value;
        $this->satisfier = $satisfier;
        $this->validateItems = $validateItems;
    }

    /**
     * get error message
     * 
     * @return string
     */
    public function getErrorMessage(): string
    {
        return $this->errorMessage;
    }

    /**
     * valid value 
     * 
     * @return bool
     */
    abstract public function valid(): bool;

    /**
     * checking if value(array or string) in field is empty
     * 
     * @return boolean
     */
    public function valueIsEmpty(): bool
    {
        $value = $this->value;

        if ((is_array($value) && empty(array_filter($value))) || (!is_array($value) && trim($value) == '')) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * set DataBase
     *
     * @param Database $database
     * 
     * @return void
     */
    public function setDataBase(Database $database): void
    {
        $this->dataBase = $database;
    }

    /**
     * get data base connection
     * 
     * @return Database
     */
    protected function getDataBase(): Database
    {
        return $this->dataBase;
    }
}
