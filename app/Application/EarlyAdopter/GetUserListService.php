<?php


namespace App\Application\EarlyAdopter;

use App\Application\UserDataSource\UserDataSource;
use Exception;

class GetUserListService
{

    private UserDataSource $userDataSource;

    public function __construct(UserDataSource $userDataSource)
    {
        $this->userDataSource = $userDataSource;
    }

    public function execute(): array
    {
        return $this->userDataSource->getUserList();
    }
}
