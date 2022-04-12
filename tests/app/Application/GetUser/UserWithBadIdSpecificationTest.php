<?php


namespace Tests\app\Application\GetUser;

use App\Application\UserDataSource\UserDataSource;
use Mockery;
use app\Infrastructure\Doubles\FakeUserWithBadIdSpecification;
use Tests\TestCase;


final class UserWithBadIdSpecificationTest extends TestCase
{

    private UserDataSource $userDataSource;

    /**
     * @setUp
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->userDataSource = Mockery::mock(UserDataSource::class);

        $this->app->bind(FakeUserWithBadIdSpecification::class, fn () => $this->userDataSource);
    }

    /**
     * @test
     */
    public function fakeUserWithBadIdSpecification()
    {


        $response = $this->get('/api/users/id_user');

        $response->assertExactJson(['error' => 'Error launching the request']);
    }

}
