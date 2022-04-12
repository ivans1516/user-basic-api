<?php

namespace App\Application\GetUser;

use App\Application\UserDataSource\UserDataSource;
use Exception;
use App\Domain\User;

class GetUserService
{
    /**
     * @var UserDataSource
     */
    private $userDataSource;

    /**
     * GetUserService constructor.
     * @param UserDataSource $userDataSource
     */
    public function __construct(UserDataSource $userDataSource)
    {
        $this->userDataSource = $userDataSource;
    }

    /**
     * @param string $userId
     * @return User
     * @throws Exception
     */
    public function execute(string $userId): User
    {
        return  $this->userDataSource->findById($userId);
    }
}
