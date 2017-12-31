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
class visitController extends Controller
{
    public function index(Request $request){
       // Session::forget('customer');

        if ( Session::has('customer') ){
            $date = Jdate::medate();
            $pros = pro_city::where('pro_id',0)->orderBy('id','ASC')->get();
            $cities = pro_city::where('pro_id',Session('customer')->pro_id)->orderBy('id','ASC')->get();
            $order = customer::find(Session('customer')->id)->orders()->where('last_status',0)->get();
            return view('layouts.customer', array('date'=>Jdate::fn($date['date4']),'pros'=>$pros,'cities'=>$cities,'order'=>$order));
        }
        else {
            $v = verta();
            session([
                'url_id'=>'1',
                'url_ref'=>'anySite'
            ]);
            if (isset($_SERVER['HTTP_REFERER'])){

                $url = url::where('url','like',$_SERVER['HTTP_REFERER'])->get();
                // var_dump($url);
                if (count($url) > 0){
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
            $pros = pro_city::where('pro_id',0)->orderBy('id','ASC')->get();
            $cities = pro_city::where('pro_id',1)->orderBy('id','ASC')->get();
            $date = Jdate::medate();
            return view('layouts.index',array('date'=>Jdate::fn($date['date4']),'pros'=>$pros,'cities'=>$cities));

        }

    }
}
