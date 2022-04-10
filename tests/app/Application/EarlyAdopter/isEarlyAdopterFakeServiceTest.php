<?php


namespace Tests\app\Application\EarlyAdopter;

use App\Application\EarlyAdopter\IsEarlyAdopterService;
use App\Application\UserDataSource\UserDataSource;
use App\Domain\User;
use Exception;
use Mockery;
use PHPUnit\Framework\TestCase;
use Tests\app\Doubles\FakeUserDataSource;

class isEarlyAdopterFakeServiceTest extends TestCase
{
    private IsEarlyAdopterService $isEarlyAdopterService;

    /**
     * @setUp
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->isEarlyAdopterService = new IsEarlyAdopterService(new FakeUserDataSource());
    }

    /**
     * @test
     */
    public function checkEmptyList()
    {
        $isUserEarlyAdopterResponse = $this->isEarlyAdopterService->getUserList("empty");

        $this->assertEquals([],$isUserEarlyAdopterResponse);
    }

    /**
     * @test
     */
    public function checkContentInList()
    {
        $isUserEarlyAdopterResponse = $this->isEarlyAdopterService->getUserList("list");

        $this->assertEquals(["{id: '1'}","{id: '2'}","{id: '3'}"],$isUserEarlyAdopterResponse);
    }
}
