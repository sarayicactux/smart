<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\partner;
use App\Models\url;
use App\Models\visit;
use App\Models\customer;
use App\Models\transact;
use App\Models\order;
use App\Helpers\Jdate;
use Verta;

class CustomerController extends Controller
{
    public function regCustomer(Request $request){

        $url = url::find(session('url_id'));

            $customer = $url->customers()->create($request->all());
        session ( [
            'customer' => $customer
        ] );


    }
    public function loginCustomer(Request $request){
        $buff = customer::where('mobile',$request->mobile)
            ->where('password',$request->password)
            ->get();
        $log = false;
        if (count($buff) == 1){
            session ( [
                'customer' => $buff[0]
            ] );
            $log = true;

        }

        return array('status'=>$log);
    }
    public function regOrder(Request $request){
        /*$order = new order([
            'count' => $request->count,
            'p_code' => $request->p_code,
            'tel' => $request->tel,
            'addr' => $request->addr,
            'pro_id' => $request->pro_id,
            'city_id' => $request->city_id,
            'customer_id' => session('customer')->id,
            'url_id' =>session('customer')->url_id,
            ]

        );*/
        $order = new order();
            $order->count       = $request->count;
            $order->p_code      = $request->p_code;
            $order->tel         = $request->tel;
            $order->addr        = $request->addr;
            $order->pro_id      = $request->pro_id;
            $order->city_id     = $request->city_id;
            $order->customer_id = session('customer')->id;
            $order->url_id      = session('customer')->url_id;
        $order->save();
       /* $customer = customer::find(session('customer')->id);

        //var_dump($url);
        $customer->orders()->save($order,array('url_id'=>session('customer')->url_id));*/

    }

}
