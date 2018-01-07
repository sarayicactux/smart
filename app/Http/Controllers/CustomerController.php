<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\partner;
use App\Models\url;
use App\Models\visit;
use App\Models\cardp;
use App\Models\customer;
use App\Models\transact;
use App\Models\order;
use App\Helpers\Jdate;
use Verta;
use App\Models\pro_city;

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

        $order = new order();
            $order->count       = $request->count;
            $order->p_code      = $request->p_code;
            $order->tel         = $request->tel;
            $order->addr        = $request->addr;
            $order->pro_id      = $request->pro_id;
            $order->city_id     = $request->city_id;
            $order->customer_id = session('customer')->id;
            $order->url_id      = session('customer')->url_id;
           if( $order->save()) {
               $order = order::where('id',$order->id)->get();
               return view('customers.orders',array('order'=>$order));
           }



    }
    public function regCardP(Request $request){
        $order = customer::find(Session('customer')->id)->orders()->where('last_status',0)->get();
        $cardp = new cardp();
        $cardp->pay_time    = $request->pay_time;
        $cardp->pay_date    = $request->pay_date;
        $cardp->tran_id     = $request->tran_id;
        $cardp->amount      = $request->amount;
        $cardp->customer_id = session('customer')->id;
        $cardp->url_id      = session('customer')->url_id;

        $order = order::find($order[0]->id);

        if( $order->cardp()->save($cardp)) {

            return view('customers.regCardP');
        }



    }
    public function customerOrder(Request $request){
        $order = order::find($request->tId);
        $pro   = pro_city::find($order->pro_id);
        $city  = pro_city::find($order->city_id);
        $cardP = $order->cardp();
        $transAct = $order->transact();
        return view('customers.order',array('order'=>$order,'pro'=>$pro->name,'city'=>$city->name,'cardP'=>$cardP,'transAct'=>$transAct));
    }

}
