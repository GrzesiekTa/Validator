<?php

namespace Tests\Validators;

use App\Validators\YearOfBirthValidator;
use PHPUnit\Framework\TestCase;

class YearOfBirthValidatorTest extends TestCase
{
    /**
     * @dataProvider firstDataForTesting
     */
    public function testFirst(string $field, $value, $satisfier, array $validateItems, bool $expectedValid)
    {
        $yearOfBirthValidator = new YearOfBirthValidator($field, $value, $satisfier, $validateItems);
        $yearOfBirthValidator->setMockDateTime(new \DateTime('2020-04-23'));

        $this->assertEquals($yearOfBirthValidator->valid(), $expectedValid);
    }

    /**
     * @dataProvider secondDataForTesting
     */
    public function testSecond(string $field, $value, $satisfier, array $validateItems, bool $expectedValid)
    {
        $yearOfBirthValidator = new YearOfBirthValidator($field, $value, $satisfier, $validateItems);
        $yearOfBirthValidator->setMockDateTime(new \DateTime('2018-04-23'));

        $this->assertEquals($yearOfBirthValidator->valid(), $expectedValid);
    }

    /**
     * @return array
     */
    public function firstDataForTesting(): array
    {
        return [
            ['test', 2000, '18', [], true],
            ['test', 2001, '18', [], true],
            ['test', 2002, 18, [], true],
            ['test', 2003, '17', [], true],
            ['test', 2003, '18', [], false],
            ['test', 2004, '18', [], false],
            ['test', 2005, '18', [], false],
            ['test', 2006, '18', [], false],
            ['test', null, '18', [], false],
            ['test', 'a', '18', [], false],
            ['test', 'asadfdsa', '18', [], false],
        ];
    }
    /**
     * @return array
     */
    public function secondDataForTesting(): array
    {
        return [
            ['test', 1990, '18', [], true],
            ['test', 1998, 18, [], true],
            ['test', 1999, '18', [], true],
            ['test', 2000, '18', [], true],
            ['test', 2001, '18', [], false],
            ['test', 2002, '18', [], false],
            ['test', 2003, '18', [], false],
            ['test', 2004, '18', [], false],
            ['test', 2005, '18', [], false],
            ['test', 2006, '18', [], false],
            ['test', 2100, '18', [], false],
        ];
    }
}
