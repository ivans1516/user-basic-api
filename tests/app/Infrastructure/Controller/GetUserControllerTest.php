<?php

namespace Tests\app\Infrastructure\Controller;

use App\Application\UserDataSource\UserDataSource;
use App\Domain\User;
use Exception;
use Mockery;
use Tests\TestCase;

class GetUserControllerTest extends TestCase
{
    private UserDataSource $userDataSource;

    /**
     * @setUp
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->userDataSource = Mockery::mock(UserDataSource::class);
        $this->app->bind(UserDataSource::class, fn () => $this->userDataSource);
    }

    /**
     * @test
     */
    public function userWithGivenIdDoesNotExist()
    {
        $this->userDataSource
            ->expects('findById')
            ->with('999')
            ->once()
            ->andThrow(new Exception('user does not exist'));

        $response = $this->get('/api/users/999');

        $response->assertExactJson(['error' => 'user does not exist']);
    }

    /**
     * @test
     */
    public function userWithBadIdSpecification()
    {
        $this->userDataSource
            ->expects('findById')
            ->with('id_user')
            ->once()
            ->andThrow(new Exception('Error launching the request',150));

        $response = $this->get('/api/users/id_user');

        $response->assertExactJson(['error' => 'Error launching the request']);
    }

    /**
     * @test
     */
    public function userWithNoGivenId()
    {
        $this->userDataSource
            ->expects('findById')
            ->with('user')
            ->never()
            ->andThrow(new Exception('User Id is obligatory'));

        $response = $this->get('/api/users/');

        $response->assertExactJson(['error' => 'User Id is obligatory']);
    }

    /**
     * @test
     */
    public function userWithGivenIdExist()
    {
        $user = new User(1, 'user@user.com');

        $this->userDataSource
            ->expects('findById')
            ->with('1')
            ->once()
            ->andReturn($user);

        $response = $this->get('/api/users/1');

        $response->assertExactJson(['id' => 1,'email' => 'user@user.com']);
    }





}
