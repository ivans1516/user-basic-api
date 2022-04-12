<?php


namespace App\Infrastructure\Controllers;

use App\Application\EarlyAdopter\IsEarlyAdopterService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;

class GetUserListController extends BaseController
{

    private $isEarlyAdopterService;

    public function __construct(IsEarlyAdopterService $isEarlyAdopterService)
    {
        $this->isEarlyAdopterService = $isEarlyAdopterService;
    }

    public function __invoke(): JsonResponse
    {
            $list = $this->isEarlyAdopterService->getUserList();

            return response()->json($list);
    }
}
