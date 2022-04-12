<?php


namespace Tests\app\Doubles;


namespace App\Infrastructure\Doubles;
use App\Application\UserDataSource\UserDataSource;
use App\Domain\User;
use Mockery\Exception;

class FakeUserDataWithContent implements UserDataSource
{
    public function findByEmail(string $email): User
    {
    }

    public function getUserList(): array
    {
        return array(1,2,3);
    }

    public function findById(string $userId): User
    {
        if(intval($userId)>2){ //or (intval($userId)<=0)){
            throw new Exception('user does not exist');
        }
        elseif (intval($userId)==1){
            return new User(1, 'user@user.com');
        }
        elseif(!(is_numeric($userId))){
            throw new Exception('Error launching the request');
        }
        else{
            return new User(2, 'user2@user.com');
        }
        //return new User(2, 'user2@user.com');
    }
}
