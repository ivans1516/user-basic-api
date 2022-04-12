<?php


namespace app\Infrastructure\Doubles;
use App\Application\UserDataSource\UserDataSource;
use App\Domain\User;

class FakeGetUSerGivenIdExists implements UserDataSource
{
    public function findByEmail(string $email): User
    {
    }

    public function findById(string $userId): User
    {
        $user = new User('1','user@user.com');
        return $user;
    }

    public function getUserList(): array
    {
    }
}
