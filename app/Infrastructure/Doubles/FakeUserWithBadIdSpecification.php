<?php


namespace app\Infrastructure\Doubles;
use App\Application\UserDataSource\UserDataSource;
use App\Domain\User;
use Mockery\Exception;

class FakeUserWithBadIdSpecification implements UserDataSource
{
    public function findByEmail(string $email): User
    {
    }

    public function findById(string $userId): User
    {
        throw new Exception('Error launching the request');
    }

    public function getUserList(): array
    {
    }
}
