<?php


namespace Tests\app\Doubles;
use App\Application\UserDataSource\UserDataSource;
use App\Domain\User;

class FakeUserDataSource implements UserDataSource
{
    public function findByEmail(string $email): User
    {
    }

    public function getUserList(string $command): array
    {
        if(strcmp($command,"empty") == 0){
            return [];
        }else{

            return ["{id: '1'}","{id: '2'}","{id: '3'}"];
        }
    }
}
