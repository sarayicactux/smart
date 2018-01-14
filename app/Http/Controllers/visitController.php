<?php

namespace App\Http\Controllers;

use App\Models\customer;
use Illuminate\Http\Request;
use App\Models\partner;
use App\Models\url;
use App\Models\order;
use App\Models\visit;
use App\Helpers\Jdate;
use App\Models\pro_city;
use Session;
use Verta;
use Cookie;
require_once('nusoap.php');
use nusoap_client;

class visitController extends Controller
{
    public function index(Request $request){
       // Session::forget('customer');
        $v = verta();
       // setcookie('referer', $_SERVER['HTTP_REFERER'], time() + (86400 * 30), "/");
      //  unset($_COOKIE['referer']);
      // echo $_COOKIE['referer'];
        if ( Session::has('customer') ){
            $date = Jdate::medate();
            $pros = pro_city::where('pro_id',0)->orderBy('id','ASC')->get();
            $cities = pro_city::where('pro_id',Session('customer')->pro_id)->orderBy('id','ASC')->get();
            $order = customer::find(Session('customer')->id)->orders()->where('last_status',0)->get();
            $sales = customer::find(Session('customer')->id)->orders()->with('transact')->with('cardp')->get();
            return view('layouts.customer', array('date'=>Jdate::fn($date['date4']),'pros'=>$pros,'cities'=>$cities,'order'=>$order,'sales'=>$sales));
        }
        else {


            session([
                'url_id'=>'1',
                'url_ref'=>'anySite'
            ]);
            if (isset($_COOKIE['referer'])){

                $url = url::where('url','like',$_COOKIE['referer'])->get();
                // var_dump($url);
                if (count($url) > 0){
                    setcookie('referer', $_COOKIE['referer'], time() + (86400 * 30), "/");
                    $url = url::find($url[0]->id);
                    $url->visits()->create([
                        'url_ref'   =>$_COOKIE['referer'],
                        'visit_time'=>$v->hour.':'.$v->minute.':'.$v->second,
                        'visit_date'=>$v->year.'/'.$v->month.'/'.$v->day
                    ]);

                }
            }
            else {
                if (isset($_SERVER['HTTP_REFERER'])){

                    $url = url::where('url','like',$_SERVER['HTTP_REFERER'])->get();
                    // var_dump($url);
                    if (count($url) > 0){

                        setcookie('referer', $_SERVER['HTTP_REFERER'], time() + (86400 * 30), "/");
                        $url = url::find($url[0]->id);
                        $url->visits()->create([
                            'url_ref'   =>$_SERVER['HTTP_REFERER'],
                            'visit_time'=>$v->hour.':'.$v->minute.':'.$v->second,
                            'visit_date'=>$v->year.'/'.$v->month.'/'.$v->day
                        ]);

                    }
                    else {
                        $url = url::find(1);
                        $url->visits()->create([
                            'url_ref'   =>$_SERVER['HTTP_REFERER'],
                            'visit_time'=>$v->hour.':'.$v->minute.':'.$v->second,
                            'visit_date'=>$v->year.'/'.$v->month.'/'.$v->day
                        ]);
                        session([
                            'url_id'=>$url->id,
                            'url_ref'=>$_SERVER['HTTP_REFERER']
                        ]);

                    }
                }
                else {
                    $url = url::find(1);
                    $url->visits()->create([
                        'url_ref'   =>'anySite',
                        'visit_time'=>$v->hour.':'.$v->minute.':'.$v->second,
                        'visit_date'=>$v->year.'/'.$v->month.'/'.$v->day,
                    ]);


                }
            }

            $pros = pro_city::where('pro_id',0)->orderBy('id','ASC')->get();
            $cities = pro_city::where('pro_id',1)->orderBy('id','ASC')->get();
            $date = Jdate::medate();
            return view('layouts.index',array('date'=>Jdate::fn($date['date4']),'pros'=>$pros,'cities'=>$cities));

        }

    }
    public function myUrl(){

        if (isset($_SERVER['HTTP_REFERER'])) echo "You Referer URL Is : ".$_SERVER['HTTP_REFERER'];
    }
}
