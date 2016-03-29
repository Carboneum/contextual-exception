<?php

namespace CarboneumTest\ContextualException\ExceptionTest\UserException;

/**
 * Class UserTestExceptionTwo
 * @package CarboneumTest\ContextualException
 */
class UserTestExceptionTwo extends UserTestExceptionOne
{
    const CODE = self::USER_ERROR_TWO;
    const MESSAGE = 'User %user_id% with role %role_name% cannot access "%resource_name%"';

    const PRE_MARKER = '%';
    const POST_MARKER = '%';

    const ROLE_NAME = 'role_name';
    const RESOURCE_NAME = 'resource_name';

    /**
     * @param int $userId
     * @param string $roleName
     * @param string $resourceName
     * @param \Exception|null $previous
     */
    public function __construct($userId, $roleName, $resourceName, \Exception $previous = null)
    {
        $this->setContextValues([self::ROLE_NAME => $roleName, self::RESOURCE_NAME => $resourceName]);
        parent::__construct($userId, $previous);
    }
}
