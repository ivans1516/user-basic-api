<?php


namespace App\Infrastructure\Controllers;

use App\Application\EarlyAdopter\GetUserListService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;

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
                $text = "";
                $i = 0;
                foreach ($list as $user){
                    if($i == 0){
                        $text = "{id: '".$user."'}";
                    }else{
                        $text .= ",{id: '".$user."'}";
                    }
                    $i +=1;
                }
                return response()->json([$text], Response::HTTP_OK);
            }
        }catch (Exception $exception) {
            return response()->json([
                'error' => "An error has occurred"
            ], Response::HTTP_BAD_REQUEST);
        }
    }
}
