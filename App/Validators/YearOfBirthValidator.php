<?php

namespace App\Validators;

use App\Exceptions\SatisfierException;
use App\Validators\AbstractValidator;
use DateTime;

/**
 * checks if client is 18 based on the year of birth
 */
class YearOfBirthValidator extends AbstractValidator
{
    /**
     * @var null|DateTime
     */
    protected $mockDateTime = null;
    /**
     * validator key
     */
    const KEY = 'yearOfBirth';
    /**
     * @var string 
     */
    protected $errorMessage = 'Aby zalozyc konto w tym serwisie musisz miec ukonczone :satisfier lat';
    /**
     * set mock date time - for tests
     *
     * @param DateTime $dateTime
     * 
     * @return void
     */
    public function setMockDateTime(DateTime $dateTime): void
    {
        $this->mockDateTime = $dateTime;
    }
    /**
     * get date time 
     *
     * @return DateTime
     */
    private function getDateTime(): DateTime
    {
        if ($this->mockDateTime) {
            return $this->mockDateTime;
        }

        return new DateTime();
    }
    /**
     * valid value 
     * 
     * @return bool
     */
    public function valid(): bool
    {
        if (filter_var($this->satisfier, FILTER_VALIDATE_INT) === false) {
            throw new SatisfierException('No age given or age is invalid');
        }

        $value = $this->value;

        if (filter_var($value, FILTER_VALIDATE_INT) === false) {
            return false;
        }

        $check18YearsOld = ($this->getDateTime()->format('Y')) - $value;

        return ($check18YearsOld >= $this->satisfier) ? true : false;
    }
}
