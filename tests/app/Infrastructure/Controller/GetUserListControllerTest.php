<?php

namespace Tests\app\Infrastructure\Controller;


use App\Application\UserDataSource\UserDataSource;
use App\Domain\User;
use Exception;
use Illuminate\Http\Response;
use Mockery;
use PHPUnit\Framework\Test;
use Tests\app\Doubles\FakeUserData;
use Tests\TestCase;

class GetUserListControllerTest extends TestCase
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
    public function isEmptyUserList()
    {
        $this->userDataSource
            ->expects('getUserList')
            ->with()
            ->once()
            ->andReturn([]);

        $response = $this->get('/api/users/list');

        $response->assertExactJson([]);
    }

    /**
     * @test
     */
    public function checkUsersInList()
    {
        $user1 = new User(1, 'email@email.com');
        $user2 = new User(2, 'email2@email.com');
        $user3 = new User(3, 'email3@email.com');

        $this->userDataSource
            ->expects('getUserList')
            ->once()
            ->andReturn([$user1->getId(),$user2->getId(),$user3->getId()]);

        $response = $this->get('/api/users/list');

        $response->assertExactJson(["{id: '1'}","{id: '2'}","{id: '3'}"]);
    }

    /**
     * @test
     */
    public function getGenericError()
    {
        $this->userDataSource
            ->expects('getUserList')
            ->once()
            ->andThrow(new Exception('There was an issue in the request process'));

        $response = $this->get('/api/users/list');

        $response->assertStatus(Response::HTTP_BAD_REQUEST)->assertExactJson(['error' => 'There was an issue in the request process']);
    }
}
