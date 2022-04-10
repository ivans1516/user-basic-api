<?php


namespace Tests\app\Doubles;
use App\Application\UserDataSource\UserDataSource;
use App\Domain\User;

class FakeUserData implements UserDataSource
{
    public function findByEmail(string $email): User
    {
    }

    public function getUserList(): array
    {
        return [];
    }
}
