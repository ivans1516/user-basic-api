<?php

namespace Tests\app\Application\GetUser;

use App\Application\UserDataSource\UserDataSource;
use Mockery;
use app\Infrastructure\Doubles\FakeGetUSerGivenIdExists;
use Tests\TestCase;

final class GetUserGivenIdExistsTest extends TestCase
{
    private UserDataSource $userDataSource;

    /**
     * @setUp
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->userDataSource = Mockery::mock(UserDataSource::class);

        $this->app->bind(FakeGetUSerGivenIdExists::class, fn () => $this->userDataSource);
    }

    /**
     * @test
     */
    public function fakeGetUserGivenIdExists()
    {


        $response = $this->get('/api/users/1');

        $response->assertExactJson(['id' => 1,'email' => 'user@user.com']);
    }

}
