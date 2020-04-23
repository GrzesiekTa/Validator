<?php

namespace Tests\ErrorHandler;

use PHPUnit\Framework\TestCase;
use App\ErrorHandler\ErrorHandler;

class ErrorHandlerTest extends TestCase
{
    /**
     * @dataProvider dataForTesting
     */
    public function test(array $errorsData, int $expectedNumberOfErrors, array $errorsDataForKey, bool $hasErrors, array $firstErrorsForKeys): void
    {
        $errorHandler = new ErrorHandler();

        foreach ($errorsData as $single) {
            $errorMessage = $single[0];
            $keyName = $single[1];
            $errorHandler->addError($errorMessage, $keyName);
        }

        $countAllErrorsKeys = $errorHandler->countErrors();
        $this->assertEquals($countAllErrorsKeys, $expectedNumberOfErrors);

        foreach ($errorsDataForKey as $single) {
            $keyName = $single[0];
            $expecteNumberOfErrorsForKey = $single[1];
            $countAllErrorsForKey = $errorHandler->countErrors($keyName);
            $this->assertEquals($expecteNumberOfErrorsForKey, $countAllErrorsForKey);
        }

        foreach ($firstErrorsForKeys as $single) {
            $keyName = $single[0];
            $expecteFirstMessageForKey = $single[1];
            $firstError = $errorHandler->firstError($keyName);
            $this->assertEquals($firstError, $expecteFirstMessageForKey);
        }

        //test if errorhandler has errors
        $this->assertEquals($errorHandler->hasErrors(), $hasErrors);
    }
    /**
     * @return array
     */
    public function dataForTesting(): array
    {
        return [
            [
                [ //$errorsData
                    ['error !!!',   'name'],
                    ['second error message',   'name'],
                    ['invalid email',   'email'],
                ],
                2, //$expectedNumberOfErrors
                [ //$errorsDataForKey
                    ['name', 2],
                    ['email', 1],
                ],
                true, //$hasErrors
                [ //$firstErrorsForKeys
                    ['name', 'error !!!'],
                    ['email', 'invalid email'],
                ]
            ],
            [
                [
                    [':D:D:::::D:D', 'name'],
                ],
                1,
                [
                    ['name', 1],
                    ['email', 0],
                    ['other', 0],
                ],
                true,
                [
                    ['name', ':D:D:::::D:D'],
                    ['email', null],
                ]
            ],
            [
                [],
                0,
                [],
                false,
                [
                    ['name', null],
                    ['email', null],
                ]
            ],
        ];
    }
}
