<?php


namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Request as otherRequest;
use Illuminate\Support\Facades\DB;
use App\UserInfo;
use App\Device;
use App\AccountRequest;
use Carbon\Carbon;
use App\AI;


class MainController extends Controller {

    public function home(Request $request){
        if ($request->session()->get('user_id') != '') {
            $device = DB::table('Device')
                ->join('Room', 'Device.room_id', '=', 'Room.room_id')
                ->join('Department', 'Device.department_id', '=', 'Department.department_id')
                ->select('Device.*', 'Room.name AS rname', 'Department.name AS dname')
                ->get();
            return view('home', compact('device'));
        }
        else
            return view('login');
    }

    public function logout(Request $request){
        $request->session()->put('user_id','');
        $request->session()->put('username','');
        $request->session()->put('password','');
        $request->session()->put('type','');
        return view('login');
    }

    public function account(Request $request){
        if ($request->session()->get('user_id') != '') {
            $account= AccountRequest::all();
            return view('account', compact('account'));
        }
        else
            return view('login');
    }

    public function acceptAccount(Request $request){
        $userdb = AccountRequest::find($request->user_id);
        if ($request->switch == 'accept') {
            $insertdb = new UserInfo();
            $insertdb->user_id = $userdb->user_id;
            $insertdb->username = $userdb->username;
            $insertdb->password = $userdb->password;
            $insertdb->type = $userdb->type;
            $insertdb->email = $userdb->email;
            $insertdb->save();
            $userdb->delete();
            return redirect()->back()->with('msg','User Accepted')->with('msg_type', 'success');
        }
        else {
            $userdb->delete();
            return redirect()->back()->with('msg','User Deleted')->with('msg_type', 'danger');
        }
    }

    public function get_room_schedule(Request $request){
        if ($request->session()->get('user_id') == '')
            return view('login');

        $originalInput = otherRequest::input();

        $request = otherRequest::create('api/schedule', 'GET');

        otherRequest::replace($request->input());

//        $response = app()->handle($request);

        $instance = json_decode(app()->handle($request)->getContent());

        otherRequest::replace($originalInput);

        return view('schedule', compact('instance'));
    }

    public function update_room_schedule(Request $request){

        $originalInput = otherRequest::input();

        if ($request->switch == 'delete')
            $request = otherRequest::create('api/schedule/'.$request->id, 'DELETE');
        else
            $request = otherRequest::create('api/schedule', 'POST', $originalInput);

        otherRequest::replace($request->input());

//        $response = app()->handle($request);

        $instance = json_decode(app()->handle($request)->getContent());

        otherRequest::replace($originalInput);

        if ($instance->message == 'true') {
            if ($request->switch == 'delete')
                return redirect()->back()->with('msg', 'Your Schedule Had Beed Delete')->with('msg_type', 'danger');
            else
                return redirect()->back()->with('msg', 'Your Schedule Had Beed Added/Edit. Please Check By Yourself Again')->with('msg_type', 'success');
        }
        else
            return redirect()->back()->with('msg', 'Unavailable Schedule')->with('msg_type', 'danger');

    }

    public function switch(Request $request){
        $userdb = Device::find($request->device);
        if ($request->switch == 'on') {
            $userdb->status = 1;
            $userdb->save();
            return redirect()->back()->with('msg', $request->item.' belongs to room '.$request->room.' in department '.str_replace('_',' ',$request->department).'had been turned on')->with('msg_type', 'success');
        }
        else {
            $userdb->status = 0;
            $userdb->save();
            return redirect()->back()->with('msg', $request->item.' belongs to room '.$request->room.' in department '.str_replace('_',' ',$request->department).'had been turned off')->with('msg_type', 'danger');
        }
    }

    public function loginRequest(Request $request){
        $request->session()->put('default',0);
        if ($request->login_button == 'guest'){
            $userdb = UserInfo::where('user_id', '12345Guest')->get();
            $currentUser = $userdb->first();
            $request->session()->put('user_id',$currentUser->user_id);
            $request->session()->put('username',$currentUser->username);
            $request->session()->put('password',$currentUser->password);
            $request->session()->put('type',$currentUser->type);
            return redirect('home');
        }
        else{
            $username = $request->username;
            $password = md5($request->password);

            $userdb = UserInfo::where('username', $username)->where('password', $password)->get();
            if (count($userdb) > 0){
                $currentUser = $userdb->first();
                $request->session()->put('user_id',$currentUser->user_id);
                $request->session()->put('username',$currentUser->username);
                $request->session()->put('password',$currentUser->password);
                $request->session()->put('type',$currentUser->type);
                return redirect('home');
            } else {
                return redirect()->back()->with('msg', 'Login Failed !!!')->with('msg_type', 'danger');
            }
        }
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

    public function requestAccount(Request $request){
        $request->session()->put('default',1);
        $validatedData = $request->validate([
            'username' => 'required|min:5|max:255|unique:AccountRequest',
            'password' => 'required|min:3|confirmed',
            'email' => 'unique:AccountRequest|unique:User',
            'type' => 'required',
        ],
            [
                'username.required' => 'Username Required',
                'username.min' => 'Username Needs At Least 5 Symbols',
                'username.unique' => 'Username Existed',
                'password.required' => 'Password Required',
                'password.min' => 'Password Needs At Least 3 Symbols',
                'password.confirmed' => 'Password Not Confirmed',
                'email.unique' => 'Email Existed',
                'type.required' => 'Role Required',
            ]);
        $user_id = $this->getToken(10);
        $find= UserInfo::where('user_id', $user_id)->get();
        while (count($find) > 0){
            $user_id = $this->getToken(10);
            $find= UserInfo::where('user_id', $user_id)->get();
        }
        $username = $request->username;
        $password = md5($request->password);
        $type = $request->type;
        $email = $request->email;

        $userdb = new AccountRequest();
        $userdb->user_id = $user_id;
        $userdb->username = $username;
        $userdb->password = $password;
        $userdb->type = $type;
        $userdb->email = $email;
        $userdb->save();

        return redirect()->back()->with('msg', 'Request Sent !!!')->with('msg_type', 'success');
    }

    public function get_human_in_area(Request $request){

        $originalInput = otherRequest::input();

        $request = otherRequest::create('api/ai', 'GET');

        otherRequest::replace($request->input());

//        $response = app()->handle($request);

        $instance = json_decode(app()->handle($request)->getContent());

        otherRequest::replace($originalInput);

        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $datetime = strval(date('MM/DD/YYYY'));
        if (intval(strval(date('H'))) >= 21 && $instance->data >= 1)
            $sound_alarm = 1;
        else
            $sound_alarm = 0;

        $insertdb = new AI();
        $insertdb->human = $instance->data;
        $insertdb->sound_alarm = $sound_alarm;
        $insertdb->datetime = $datetime;
        $insertdb->save();

    }
}
