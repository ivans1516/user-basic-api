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
}
