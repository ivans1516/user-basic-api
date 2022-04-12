<?php


namespace App\Infrastructure\Controllers;

use App\Application\EarlyAdopter\GetUserListService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;
use Exception;

class GetUserListController extends BaseController
{

    private GetUserListService $getUserListService;

    public function __construct(GetUserListService $getUserListService)
    {
        $this->getUserListService = $getUserListService;
    }

    public function __invoke(): JsonResponse
    {
        try {
            $list = $this->getUserListService->execute();

            if (empty($list)){
                return response()->json([]);
            }else{
                $array = array();
                $text = "";
                $i = 0;
                foreach ($list as $user){
                    array_push($array,"{id: '".$user."'}");
                }
                return response()->json($array, Response::HTTP_OK);
            }
        }catch (Exception $exception) {
            return response()->json([
                'error' => $exception->getMessage()
            ], Response::HTTP_BAD_REQUEST);
        }
    }
}
