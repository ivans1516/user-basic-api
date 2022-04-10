<?php

namespace App\Infrastructure\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;

class GetUserController extends BaseController
{
    public function __invoke(string $userId): JsonResponse
    {
        if(strcmp($userId, 'list') == 0){
            return response()->json([]);
        }
        return response()->json([
            'error' => "user does not exist"
        ], Response::HTTP_BAD_REQUEST);
    }
}
