<?php

namespace App\Validator;

use App\Validators\IntegerValidator;
use App\Validators\RegonValidator;
use App\Validators\MinLenghtValidator;
use App\Validators\MaxLenghtValidator;
use App\Validators\HasIntegerValidator;
use App\Validators\PostCodeValidator;
use App\Validators\UrlValidator;
use App\Validators\CaptchaValidator;
use App\Validators\NipValidator;
use App\Validators\PhoneValidator;
use App\Validators\IsImgValidator;
use App\Validators\RequiredValidator;
use App\Validators\MatchValidator;
use App\Validators\DateValidator;
use App\Validators\MaxFileSizeValidator;
use App\Validators\UniqueValidator;
use App\Validators\EmailValidator;

class ValidatorCollection
{

    /**
     * validators collection
     * 
     * @var array 
     */
    private $validators = [
        IntegerValidator::KEY => IntegerValidator::class,
        RegonValidator::KEY => RegonValidator::class,
        MinLenghtValidator::KEY => MinLenghtValidator::class,
        MaxLenghtValidator::KEY => MaxLenghtValidator::class,
        HasIntegerValidator::KEY => HasIntegerValidator::class,
        PostCodeValidator::KEY => PostCodeValidator::class,
        UrlValidator::KEY => UrlValidator::class,
        CaptchaValidator::KEY => CaptchaValidator::class,
        NipValidator::KEY => NipValidator::class,
        PhoneValidator::KEY => PhoneValidator::class,
        IsImgValidator::KEY => IsImgValidator::class,
        RequiredValidator::KEY => RequiredValidator::class,
        MatchValidator::KEY => MatchValidator::class,
        DateValidator::KEY => DateValidator::class,
        MaxFileSizeValidator::KEY => MaxFileSizeValidator::class,
        UniqueValidator::KEY => UniqueValidator::class,
        EmailValidator::KEY => EmailValidator::class,
    ];

    /**
     * get validator class by name
     * 
     * @param string $key
     * @return string
     * 
     * @throws \Exception
     */
    public function getValidatorClassByKey($key): string
    {
        if (isset($this->validators[$key])) {
            return $this->validators[$key];
        }

        throw new \Exception("Invalid validator $key value");
    }
}
