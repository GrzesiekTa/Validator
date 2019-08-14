<?php

namespace App\Validator;

use App\ErrorHandler\ErrorHandler;
use App\Validator\ValidatorCollection;

function dump($asd) {
    echo '<pre>';
    var_dump($asd);
    echo '</pre>';
}

class Validator {

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
     */
    function __construct(ErrorHandler $errorHandler) {
        $this->errorHandler = $errorHandler;

        $this->validatorCollection = new ValidatorCollection();
    }

    /**
     * check valdate items by rules
     * 
     * @param array $validateItems
     * @param string $rules
     * 
     * @return Validator
     */
    public function check(array $validateItems, array $rules): Validator {
        if (is_array($this->validateItems)) {
            $this->validateItems = array_merge($validateItems, $this->validateItems);
        } else {
            $this->validateItems = $validateItems;
        }

        foreach ($rules as $itemName => $requireRuleString) {
            $requireRuleSepareteArray = [];
            $firstSeparator = explode("|", $requireRuleString);

            foreach ($firstSeparator as $key => $firstSeparatorValue) {
                $secondSeparator = explode(":", $firstSeparatorValue);
                $requireRuleSepareteArray[$secondSeparator[0]] = $secondSeparator[1];
            }

            @$this->validate([
                        'field' => $itemName,
                        'value' => $validateItems[$itemName] ?? null,
                        'rules' => $requireRuleSepareteArray,
            ]);
        }

        return $this;
    }

    /**
     *
     * @param array $customErrors
     */
    public function addCustomErrrorMessages(array $customErrors): void {
        $this->customErrors = $customErrors;
    }

    public function oldValue(string $value) {
        echo $this->validateItems[$value] ?? '';
    }

    public function select_old_value($value, $itemName) {
        if (isset($this->validateItems[$itemName]) && $this->validateItems[$itemName] == $value) {
            echo 'selected';
        }
    }

    public function fails() {
        return $this->errorHandler->hasErrors();
    }

    public function errors() {
        return $this->errorHandler;
    }

    /**
     * get custom message
     * 
     * @param string $key
     * 
     * @return string|null
     */
    private function getCustomMessage(string $field, $rule): ?string {
        return $this->customErrors[$field][$rule] ?? null;
    }

    /**
     * @param array $item
     */
    protected function validate(array $item): void {
        $field = $item['field'];
        //set default require value if not exists
        if (!isset($item['rules']['required'])) {
            $item['rules']['required'] = false;
        }

        $item['rules']['required'] = in_array($item['rules']['required'], ['true', '1']) ? true : false;

        //walidator odpalany jest tylko w przypadku gdy pole ma require true lub require false ale nie jest puste
        if ($this->checkRunValidators($item['rules']['required'], $item['value'])) {
            foreach ($item['rules'] as $rule => $satisfier) {
                $validatorNamespace = $this->validatorCollection->getValidatorClassByKey($rule);
                $validator = new $validatorNamespace($field, $item['value'], $satisfier, $this->validateItems);
                //get custom error message or default 
                $errorMessage = $this->customErrors[$field][$rule] ?? $validator->getErrorMessage();

                if (!$validator->valid()) {
                    $this->errorHandler->addError(
                            str_replace([':field', ':satisfier'], [$field, $satisfier], $errorMessage), $field
                    );
                }
            }
        }
    }

    /**
     * check run validators
     * 
     * @param bool $require
     * @param type $value
     * 
     * @return boolean
     */
    private function checkRunValidators(bool $require, $value): bool {
        if ($require) {
            return true;
        }

        return !$this->valueIsEmpty($value);
    }

    /**
     * TODO - for separation
     * 
     * checking if value(array or string) in field is empty
     * 
     * @return boolean
     */
    public function valueIsEmpty($value): bool {
        if ((is_array($value) && empty(array_filter($value)) ) || (!is_array($value) && trim($value) == '')) {
            return true;
        } else {
            return false;
        }
    }

}

?>