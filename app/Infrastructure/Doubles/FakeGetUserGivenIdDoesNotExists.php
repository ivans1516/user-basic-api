<?php


namespace app\Infrastructure\Doubles;
use App\Application\UserDataSource\UserDataSource;
use App\Domain\User;
use Mockery\Exception;

class FakeGetUSerGivenIdDoesNotExists implements UserDataSource
{
    public function findByEmail(string $email): User
    {
    }

    public function findById(string $userId): User
    {
        throw new Exception('User does not exists');
    }

    public function getUserList(): array
    {
    }
}
