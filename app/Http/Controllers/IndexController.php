<?php

namespace App\Http\Controllers;

use App\Models\customer;
use Illuminate\Http\Request;
use App\Helpers\Jdate;
use App\Models\pro_city;
use App\Models\partner;
use App\Models\keyword;
use Session;
use Auth;
use App\Models\rank;
require_once('RankChecker.class.php');
use GoogleRankChecker;





class IndexController extends Controller
{


    public function index()
    {
        //Session::forget('partner');
        if ( Session::has('partner') ){
            $date = Jdate::medate();
            return view('layouts.partners',array('date'=>Jdate::fn($date['date4'])));
        }
        else {
            $pros = pro_city::where('pro_id',0)->orderBy('id','ASC')->get();
            $cities = pro_city::where('pro_id',1)->orderBy('id','ASC')->get();
            $date = Jdate::medate();
            return view('layouts.guest',array('date'=>Jdate::fn($date['date4']),'pros'=>$pros,'cities'=>$cities));

        }


    }
    public function cities(Request $request){
            $cities = pro_city::where('pro_id',$request->id)->orderBy('id','ASC')->get();
        return view('master.cities',array('cities'=>$cities));

    }
    public function checkEmail(Request $request){
        $email = partner::where('email',$request->email)->exists();
        $ret = 1;
        if ( $email ) $ret = 0;
        return $ret;

    }
    public function google(){

        $newGoogleRankChecker   = new GoogleRankChecker();
        $useproxies             = false;
        $arrayproxies           = [];
        //require("google/index2.php");


        $items = keyword::all();
        foreach ($items as $item){
            $newquery               = $item;

            $googledata             = $newGoogleRankChecker->find($newquery, $useproxies, $arrayproxies);


            foreach ($googledata as $result) {
                $rank = New rank();
                $rank->keyword = $newquery;
                $rank->rank = $result['rank'];
                $rank->url = $result['url'];
                $rank->save();

            }
            $time = rand(40,65);
            sleep($time);

        }
    }
    public function googleNum($num){

        $newGoogleRankChecker   = new GoogleRankChecker();
        $useproxies             = false;
        $arrayproxies           = [];


            require("google/index1.php");


    }
    public function checkMobile(Request $request){
        $mobile = customer::where('mobile',$request->mobile)->exists();
        $ret = 1;
        if ( $mobile ) $ret = 0;
        return $ret;

    }
    public function checkMelicode(Request $request){
        $n_code = partner::where('n_code',$request->n_code)->exists();
        $ret = 1;
        if ( $n_code ) $ret = 0;
        return array('status'=>$ret);

    }
    public function admin(){
    if (Auth::check()) {
        $date = Jdate::medate();

        return view('layouts.admins',array('date'=>Jdate::fn($date['date4'])));
    }
    else{
        return view('master.gust');
    }
}
    public function Adlogin(Request $request)
    {
        $c_login = false;
        $msg = 'نام کاربری و رمز عبور صحیح نیست<br /> یا کاربری شما غیر فعال شده';
        $data=array(
            'email'=>$request->get('username'),
            'password'=>$request->get('password')
        );

        if(Auth::attempt($data))
        {
            $c_login = true;
            $msg     = '';
        }
        return array(
            'status'   => $c_login,
            'error'    => $msg

        );

    }
}
