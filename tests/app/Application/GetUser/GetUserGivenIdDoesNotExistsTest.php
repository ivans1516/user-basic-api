<?php


namespace Tests\app\Application\GetUser;

use App\Application\UserDataSource\UserDataSource;
use Mockery;
use app\Infrastructure\Doubles\FakeGetUSerGivenIdDoesNotExists;
use Tests\TestCase;


final class GetUserGivenIdDoesNotExistsTest extends TestCase
{

    private UserDataSource $userDataSource;

    /**
     * @setUp
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->userDataSource = Mockery::mock(UserDataSource::class);

        $this->app->bind(FakeGetUSerGivenIdDoesNotExists::class, fn () => $this->userDataSource);
    }

    /**
     * @test
     */
    public function fakeGetUserGivenIdDoesNotExists()
    {


        $response = $this->get('/api/users/999');

        $response->assertExactJson(['error' => 'user does not exist']);
    }

}
