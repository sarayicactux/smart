<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\partner;
use App\Models\url;
use App\Models\visit;
use App\Helpers\Jdate;
use Verta;
class visitController extends Controller
{
    public function index(Request $request){
            $v = verta();
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
            }

    }
}
