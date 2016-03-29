<?php

namespace CarboneumTest\ContextualException\ExceptionTest;

/**
 * Class UserTestExceptionThree
 * @package CarboneumTest\ContextualException
 */
class UserTestExceptionThree extends PackageRootException
{
    const CODE = self::USER_ERROR_THREE;

    const PARAM1 = 'param1';
    const PARAM2 = 'param2';
    const PARAM3 = 'param3';
    const PARAM4 = 'param4';

    /**
     * @param string $param1
     * @param int $param2
     * @param bool $param3
     * @param null $param4
     * @param \Exception|null $previous
     */
    public function __construct($param1, $param2, $param3, $param4, \Exception $previous = null)
    {
        $this->setContextValues(
            [
                self::PARAM1 => $param1,
                self::PARAM2 => $param2,
                self::PARAM3 => $param3,
                self::PARAM4 => $param4
            ]
        );
        parent::__construct($previous);
    }
}
