<?php

namespace CarboneumTest\ContextualException\ExceptionTest;

use Carboneum\ContextualException\Exception;

/**
 * Class PackageRootException
 * @package CarboneumTest\ContextualException
 */
abstract class PackageRootException extends Exception
{
    const CODE_PACKAGE_PREFIX = 10000;

    const USER_ERROR_ONE = 5;
    const USER_ERROR_TWO = 6;
    const USER_ERROR_THREE = 7;
}
