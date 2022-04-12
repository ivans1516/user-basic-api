<?php


namespace Tests\app\Application\EarlyAdopter;

use App\Application\EarlyAdopter\IsEarlyAdopterService;
use App\Application\UserDataSource\UserDataSource;
use App\Domain\User;
use Exception;
use Mockery;
use PHPUnit\Framework\TestCase;
use Tests\app\Doubles\FakeUserData;
use Tests\app\Doubles\FakeUserDataWithContent;

class isEarlyAdopterFakeServiceTest extends TestCase
{
    private IsEarlyAdopterService $isEarlyAdopterService;

    /**
     * @setUp
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->isEarlyAdopterService = new IsEarlyAdopterService(new FakeUserData());
    }

    /**
     * @test
     */
    public function checkEmptyList()
    {
        $isUserEarlyAdopterResponse = $this->isEarlyAdopterService->getUserList();

        $this->assertEquals([],$isUserEarlyAdopterResponse);
    }

    /**
     * @test
     */
    public function checkUserInList()
    {
        $this->isEarlyAdopterService = new IsEarlyAdopterService(new FakeUserDataWithContent());

        $isUserEarlyAdopterResponse = $this->isEarlyAdopterService->getUserList();

        $this->assertEquals(["{id: '1'}", "{id: '2'}", "{id: '3'}"],$isUserEarlyAdopterResponse);
    }

}
