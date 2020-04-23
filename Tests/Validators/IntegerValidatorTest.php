<?php

namespace Tests\Validators;

use App\Validators\IntegerValidator;
use PHPUnit\Framework\TestCase;

class IntegerValidatorTest extends TestCase
{
    /**
     * @dataProvider dataForTesting
     */
    public function test(string $field, $value, string $satisfier, array $validateItems, bool $expectedValid)
    {
        $integerValidator = new IntegerValidator($field, $value, $satisfier, $validateItems);
        $this->assertEquals($integerValidator->valid(), $expectedValid);
    }

    /**
     * @return array
     */
    public function dataForTesting(): array
    {
        return [
            ['test', -1000, '', [], true],
            ['test', -1, '', [], true],
            ['test', 0, '', [], true],
            ['test', 1, '', [], true],
            ['test', 10, '', [], true],
            ['test', 100, '', [], true],
            ['test', 1000, '', [], true],
            ['test', '-1000', '', [], true],
            ['test', '-1', '', [], true],
            ['test', '0', '', [], true],
            ['test', '1', '', [], true],
            ['test', '10', '', [], true],
            ['test', '100', '', [], true],
            ['test', '1000', '', [], true],
            //=============================
            ['test', null, '', [], false],
            ['test', '', '', [], false],
            ['test', 'aaa', '', [], false],
            ['test', '10a', '', [], false],
            ['test', 'a10', '', [], false],
            ['test', 12.15, '', [], false],
            ['test', '12.15', '', [], false],
            ['test', '12,15', '', [], false],
        ];
    }
}
