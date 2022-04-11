<?php


namespace Tests\app\Infrastructure\Controller;


use App\Application\UserDataSource\UserDataSource;
use App\Domain\User;
use Exception;
use Illuminate\Http\Response;
use Mockery;
use Tests\app\Doubles\FakeUserData;
use Tests\TestCase;

class GetFakeUserControllerTest extends Testcase
{
    /**
     * @setUp
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->app->bind(UserDataSource::class, fn () => new FakeUserData());
    }

    /**
     * @test
     */
    public function isEmptyUserList()
    {
        $response = $this->get('/api/users/list');

        $response->assertExactJson([]);
    }
}
