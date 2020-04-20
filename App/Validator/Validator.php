<?php

namespace App\Validator;

use App\ErrorHandler\ErrorHandler;
use App\Validators\RequiredValidator;
use App\Validator\ValidatorCollection;

function dump($asd)
{
    echo '<pre>';
    var_dump($asd);
    echo '</pre>';
}

class Validator
{

    /**
     * @var array
     */
    protected $customErrors = [];

    /**
     * @var ErrorHandler 
     */
    protected $errorHandler;

    /**
     * validator collection
     *
     * @var array
     */
    protected $validatorCollection;

    /**
     * validate items 
     *
     * @var array
     */
    protected $validateItems;

    /**
     * @param ErrorHandler $errorHandler
     * @param ValidatorCollection $validatorCollection
     */
    function __construct(ErrorHandler $errorHandler, ValidatorCollection $validatorCollection)
    {
        $this->errorHandler = $errorHandler;
        $this->validatorCollection = $validatorCollection;
    }

    /**
     * check valdate items by rules
     * 
     * @param array $validateItems
     * @param string $rules
     * 
     * @return Validator
     */
    public function check(array $validateItems, array $rules): Validator
    {
        is_array($this->validateItems) ? array_merge($validateItems, $this->validateItems) : $this->validateItems = $validateItems;

        foreach ($rules as $itemName => $requireRuleString) {
            $requireRuleSepareteArray = [];
            $firstSeparator = explode("|", $requireRuleString);

            foreach ($firstSeparator as $key => $firstSeparatorValue) {
                $secondSeparator = explode(":", $firstSeparatorValue);
                $requireRuleSepareteArray[$secondSeparator[0]] = $secondSeparator[1];
            }

            $this->validate([
                'field' => $itemName,
                'value' => $validateItems[$itemName] ?? null,
                'rules' => $requireRuleSepareteArray,
            ]);
        }

        return $this;
    }

    /**
     * addd custom error message
     * 
     * @param array $customErrors
     * 
     * @return void
     */
    public function addCustomErrrorMessages(array $customErrors): void
    {
        $this->customErrors = $customErrors;
    }
    /**
     * get old string value
     *
     * @param string $value
     * 
     * @return string
     */
    public function oldStringValue(string $value): string
    {
        return $this->validateItems[$value] ?? '';
    }

    /**
     * select old value
     * 
     * @param type $value
     * 
     * @param string $itemName
     */
    public function selectOldValue($value, string $itemName)
    {
        if (isset($this->validateItems[$itemName]) && $this->validateItems[$itemName] == $value) {
            echo 'selected';
        }
    }

    /**
     * fails
     *
     * @return bool
     */
    public function fails(): bool
    {
        return $this->errorHandler->hasErrors();
    }

    /**
     * error handler
     * 
     * @return ErrorHandler
     */
    public function errors(): ErrorHandler
    {
        return $this->errorHandler;
    }

    /**
     * get custom message
     * 
     * @param string $key
     * 
     * @return string|null
     */
    private function getCustomMessage(string $field, $rule): ?string
    {
        return $this->customErrors[$field][$rule] ?? null;
    }

    /**
     * validate
     * 
     * @param array $item
     */
    protected function validate(array $item): void
    {
        $field = $item['field'];
        //set default require value if not exists
        if (!isset($item['rules']['required'])) {
            $item['rules']['required'] = false;
        }

        $item['rules']['required'] = in_array($item['rules']['required'], ['true', '1']) ? true : false;

        if ($this->checkRunValidators($item['rules']['required'], $item['value'])) {
            foreach ($item['rules'] as $rule => $satisfier) {
                $validatorFromCollection = $this->validatorCollection->getValidatorClassByKey($rule);
                $validator = new $validatorFromCollection($field, $item['value'], $satisfier, $this->validateItems);
                //get custom error message or default 
                $errorMessage = $this->customErrors[$field][$rule] ?? $validator->getErrorMessage();

                if (!$validator->valid()) {
                    $this->errorHandler->addError(
                        str_replace([':field', ':satisfier'], [$field, $satisfier], $errorMessage),
                        $field
                    );
                }
            }
        }
    }

    /**
     * check run validators
     * 
     * @param bool $require
     * @param mixes $value
     * 
     * @return boolean
     */
    private function checkRunValidators(bool $require, $value): bool
    {
        if ($require) {
            return true;
        }

        $requiredValidator = new RequiredValidator('', $value, '', []);

        return $requiredValidator->valueIsEmpty();
    }
}
