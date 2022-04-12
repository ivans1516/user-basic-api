<?php


namespace Tests\app\Doubles;


namespace App\Infrastructure\Doubles;
use App\Application\UserDataSource\UserDataSource;
use App\Domain\User;

class FakeUserDataWithContent implements UserDataSource
{
    public function findByEmail(string $email): User
    {
    }

    public function getUserList(): array
    {
        return array("{id: '1'}", "{id: '2'}", "{id: '3'}");
    }
}
