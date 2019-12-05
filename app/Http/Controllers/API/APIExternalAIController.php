<?php


namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Controllers\API\APIBaseController as APIBaseController;
use App\Schedules;
use Illuminate\Support\Facades\DB;

class APIExternalAIController extends APIBaseController{

    public function index(){
        return $this->sendResponse(mt_rand(0,100), 'Number Of Human');
    }

}
