<?php

namespace App\Infrastructure\Controllers;

use App\Application\GetUser\GetUserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;
use Exception;

class GetUserController extends BaseController
{
    private GetUserService $getUserService;

    /**
     * GetUserController constructor.
     */
    public function __construct(GetUserService $getUserService)
    {
        $this->getUserService = $getUserService;
    }
    public function __invoke(string $userId=null): JsonResponse
    {
        if(is_null($userId)){
            return response()->json([
                'error' => 'User Id is obligatory'
            ], Response::HTTP_BAD_REQUEST);
        }
        try {
            $getUser = $this->getUserService->execute($userId);
        }catch (Exception $exception){
            return response()->json([
                'error' => $exception->getMessage()
            ], Response::HTTP_BAD_REQUEST);
        }
        return response()->json([
            'id' => $getUser->getId(),
            'email' => $getUser->getEmail()
        ],Response::HTTP_OK);
    }
}
