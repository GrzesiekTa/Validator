<?php

namespace App\Validator;

use App\Database\Database;
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
     * @param Database $database
     * @param ErrorHandler $errorHandler
     */
    function __construct(Database $database, ErrorHandler $errorHandler) {
        $this->errorHandler = $errorHandler;
        $this->database = $database;

        $this->validatorCollection = new ValidatorCollection();
    }

    /**
     * 
     * @param array $validateItems
     * @param string $rules
     * 
     * @return $this
     */
    public function check(array $validateItems, array $rules) {
        $this->validateItems = $validateItems;

        foreach ($rules as $itemName => $requireRuleString) {
            $requireRuleSepareteArray = [];
            $firstSeparator = explode("|", $requireRuleString);

            foreach ($firstSeparator as $key => $firstSeparatorValue) {
                $secondSeparator = explode(":", $firstSeparatorValue);

                if (in_array($secondSeparator[1], ['true', 'false'])) {
                    $requireRuleSepareteArray[$secondSeparator[0]] = $secondSeparator[1] === 'true' ? true : false;
                } else {
                    $requireRuleSepareteArray[$secondSeparator[0]] = $secondSeparator[1];
                }
            }

            @$this->validate([
                        'field' => $itemName,
                        'value' => $validateItems[$itemName],
                        'rules' => $requireRuleSepareteArray,
            ]);
        }

        return $this;
    }

    /**
     *
     * @param array $customErrors
     */
    public function addCustomErrrorMessages(array $customErrors) {
        $this->customErrors = $customErrors;
    }

    public function oldValue(string $value) {
        echo $this->validateItems[$value];
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
     * @param array $item
     */
    protected function validate(array $item): void {
        $field = $item['field'];
        //wymuszanie wprowadznie require
        if (!isset($item['rules']['required'])) {
            echo "walidujac pole  <b>{$field}</b> pole musisz przypisać require true or false";
            die;
        }
        //walidator odpalany jest tylko w przypadku gdy pole ma require true lub require false ale nie jest puste
        if ($item['rules']['required'] == 1 || ($item['rules']['required'] == 0 && $this->valueIsEmpty($item['value']))) {
            foreach ($item['rules'] as $rule => $satisfier) {
                $validatorNamespace = $this->validatorCollection->getValidatorClassByKey($rule);
                $validator = new $validatorNamespace($field, $item['value'], $satisfier, $this->validateItems);

                if (!$validator->valid()) {
                    $this->errorHandler->addError(
                            str_replace([':field', ':satisfier'], [$field, $satisfier], $validator->getErrorMessage() ?? $messages[$rule]), $field
                    );
                }
            }
        }
    }

}

?>