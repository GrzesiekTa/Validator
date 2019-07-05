<?php

namespace App\Validators;

use App\Validators\AbstractValidator;

class CaptchaValidator extends AbstractValidator {

    /**
     * validator key
     */
    CONST KEY = 'captcha';

    /**
     * @var string 
     */
    protected $errorMessage = 'Potwierdz ¿e nie jesteœ botem';

    /**
     * valid value 
     * 
     * @return bool
     */
    public function valid(): bool {
        if (in_array($_SERVER['REMOTE_ADDR'], array('127.0.0.1', '::1'))) {
            $sekret = "6Lci3BoTAAAAAKBdjxF-5gyYkCX9UtSvZYW_Gx71"; //localhost
        } else {
            $sekret = "6Lf7hCgUAAAAADXJumgdQk4-M8Bo26gpL04yP_o2"; //notloacl host
        }
        try {
            $check = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $sekret . '&response=' . $this->value);
            $answer = json_decode($check);

            return $answer->success;
        } catch (\Exception $ex) {
            return false;
        }
    }

}
