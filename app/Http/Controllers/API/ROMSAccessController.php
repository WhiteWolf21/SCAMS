<?php


namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Controllers\API\APIBaseController as APIBaseController;
use App\Schedules;
use Illuminate\Support\Facades\DB;

class ROMSAccessController extends APIBaseController{

    public function index(){
        $schedule = DB::select('SELECT *, `Room`.`name` AS rname, `Department`.`name` AS dname FROM `Schedule`, `User`, `Room`, `Department` WHERE `Room`.`department_id` = `Department`.`department_id` AND `Schedule`.`room_id` = `Room`.`room_id` AND `User`.`user_id` = `Schedule`.`lecturer_id`');
        return $this->sendResponse($schedule, 'Schedules retrieved successfully.');
    }

    private function crypto_rand_secure($min, $max)
    {
        $range = $max - $min;
        if ($range < 1) return $min; // not so random...
        $log = ceil(log($range, 2));
        $bytes = (int) ($log / 8) + 1; // length in bytes
        $bits = (int) $log + 1; // length in bits
        $filter = (int) (1 << $bits) - 1; // set all lower bits to 1
        do {
            $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
            $rnd = $rnd & $filter; // discard irrelevant bits
        } while ($rnd > $range);
        return $min + $rnd;
    }

    private function getToken($length)
    {
        $token = "";
        $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
        $codeAlphabet.= "0123456789";
        $max = strlen($codeAlphabet); // edited

        for ($i=0; $i < $length; $i++) {
            $token .= $codeAlphabet[$this->crypto_rand_secure(0, $max-1)];
        }

        return $token;
    }

    public function store(Request $request){
        $check = true;
        $userdb = Schedules::where('room_id',$request->class)->where('date',$request->date)->get();
        if (count($userdb) > 0) {
            foreach ($userdb as $item) {
                if (($request->end < $item->start_lesson &&  $request->start < $request->end) || ($request->start > $item->end_lesson &&  $request->start < $request->end)){
                    $check = true;
                }
                else {
                    $check = false;
                    break;
                }
            }
        }

        if($check){
            $insertdb = new Schedules();
            $insertdb->schedule_id = $this->getToken(10);
            $insertdb->room_id = $request->class;
            $insertdb->lecturer_id = $request->lecturer;
            $insertdb->date = $request->date;
            $insertdb->start_lesson = $request->start;
            $insertdb->end_lesson = $request->end;
            $insertdb->save();

            $res = $this->sendResponse($request->all(), 'true');
        }
        else
            $res = $this->sendResponse($request->all(), strval($check));

        return $res;
    }

    public function destroy($id){
        $userdb = Schedules::find($id);
        $userdb->delete();
        return $this->sendResponse($id, 'true');
    }

}
