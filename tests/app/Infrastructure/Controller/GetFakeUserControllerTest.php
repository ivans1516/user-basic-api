<?php


namespace Tests\app\Infrastructure\Controller;


use App\Application\UserDataSource\UserDataSource;
use App\Infrastructure\Doubles\FakeUserData;
use App\Infrastructure\Doubles\FakeUserDataWithContent;
use Tests\TestCase;

class GetFakeUserControllerTest extends Testcase
{
    /**
     * @setUp
     */
    protected function setUp(): void
    {
        parent::setUp();

    }

    /**
     * @test
     */
    public function getEmptyUserList()
    {
        $this->app->bind(UserDataSource::class, fn () => new FakeUserData());

        $response = $this->get('/api/users/list');

        $response->assertExactJson([]);
    }

    /**
     * @test
     */
    public function checkUsersInList()
    {
        $this->app->bind(UserDataSource::class, fn () => new FakeUserDataWithContent());

        $response = $this->get('/api/users/list');

        $response->assertExactJson(["{id: '1'}", "{id: '2'}", "{id: '3'}"]);
    }
}
