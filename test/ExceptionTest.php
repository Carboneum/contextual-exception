<?php

namespace CarboneumTest\ContextualException;

use CarboneumTest\ContextualException\ExceptionTest\UserException\UserTestExceptionOne;
use CarboneumTest\ContextualException\ExceptionTest\UserTestExceptionThree;
use CarboneumTest\ContextualException\ExceptionTest\UserException\UserTestExceptionTwo;

/**
 * Class ExceptionTest
 * @package CarboneumTest\ContextualException
 */
class ExceptionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @param callable $exceptionFactory
     * @param int $expectedCode
     * @param array $expectedContext
     * @param string $expectedMessage
     *
     * @dataProvider provideTestExceptions
     */
    public function testExceptions($exceptionFactory, $expectedCode, $expectedContext, $expectedMessage)
    {
        $exception = call_user_func($exceptionFactory);

        $this->assertInstanceOf(\Exception::class, $exception);
        $this->assertEquals($expectedCode, $exception->getCode());
        $this->assertEquals($expectedContext, $exception->getContext());
        $this->assertEquals($expectedMessage, $exception->getMessage());
    }

    /**
     * @return array
     */
    public function provideTestExceptions()
    {
        return [
            'simple exception' => [
                'exceptionFactory' => function () {
                    return new UserTestExceptionOne(1);
                },
                'expectedCode' => 10005,
                'expectedContext' => [UserTestExceptionOne::USER_ID => 1],
                'expectedMessage' => 'User 1 not found'
            ],
            'inherited exception and redefined markers' => [
                'exceptionFactory' => function () {
                    return new UserTestExceptionTwo(100, 'partner', 'Admin page');
                },
                'expectedCode' => 10006,
                'expectedContext' => [
                    UserTestExceptionOne::USER_ID => 100,
                    UserTestExceptionTwo::RESOURCE_NAME => 'Admin page',
                    UserTestExceptionTwo::ROLE_NAME => 'partner',
                ],
                'expectedMessage' => 'User 100 with role partner cannot access "Admin page"'
            ],
            'exception with auto message' => [
                'exceptionFactory' => function () {
                    return new UserTestExceptionThree('foo', 200, false, null);
                },
                'expectedCode' => 10007,
                'expectedContext' => [
                    UserTestExceptionThree::PARAM1 => 'foo',
                    UserTestExceptionThree::PARAM2 => 200,
                    UserTestExceptionThree::PARAM3 => false,
                    UserTestExceptionThree::PARAM4 => null,
                ],
                'expectedMessage' => 'Exception context: [param1: "foo", param2: 200, param3: false, param4: null]'
            ],
        ];
    }
}
