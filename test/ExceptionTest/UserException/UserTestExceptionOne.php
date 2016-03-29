<?php

namespace CarboneumTest\ContextualException\ExceptionTest\UserException;

use CarboneumTest\ContextualException\ExceptionTest\PackageRootException;

/**
 * Class UserTestExceptionOne
 * @package CarboneumTest\ContextualException
 */
class UserTestExceptionOne extends PackageRootException
{
    const CODE = self::USER_ERROR_ONE;
    const MESSAGE = 'User {user_id} not found';

    const USER_ID = 'user_id';

    /**
     * @param int $userId
     * @param \Exception|null $previous
     */
    public function __construct($userId, \Exception $previous = null)
    {
        $this->setContextValue(self::USER_ID, $userId);
        parent::__construct($previous);
    }
}
