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
use App\Models\authority;
use App\Helpers\Jdate;
use Verta;
use App\Models\pro_city;
require_once('nusoap.php');
use nusoap_client;


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
               $sales = customer::find(Session('customer')->id)->orders()->with('transact')->with('cardp')->get();
               return view('customers.orders',array('order'=>$order,'sales'=>$sales));
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
        $cardP = cardp::where('order_id',$order->id)->first();
        $transAct = transact::where('order_id',$order->id)->first();
        return view('customers.order',array('order'=>$order,'pro'=>$pro->name,'city'=>$city->name,'cardP'=>$cardP,'transAct'=>$transAct));
    }
    public function onlinePay(){
        $order = customer::find(Session('customer')->id)->orders()->where('last_status',0)->get();

        $MerchantID = '8c286b76-facb-11e7-9502-005056a205be';  //Required
        $Amount = ($order[0]->count)*20000; //Amount will be based on Toman  - Required
        //$Amount = 100;
        $Description = 'خرید هوشیار سازه';  // Required
        $Email = 'sarayi.cactux@gmail.Com'; // Optional
        $Mobile = Session('customer')->mobile; // Optional
        $CallbackURL = 'http://smartstick.ir/payVerify';  // Required

        $client = new nusoap_client('https://www.zarinpal.com/pg/services/WebGate/wsdl', 'wsdl');
        $client->soap_defencoding = 'UTF-8';
        $result = $client->call('PaymentRequest', [
            [
                'MerchantID'     => $MerchantID,
                'Amount'         => $Amount,
                'Description'    => $Description,
                'Email'          => $Email,
                'Mobile'         => $Mobile,
                'CallbackURL'    => $CallbackURL,
            ],
        ]);
        $status = false;
        $Authority = '';
        if ($result['Status'] == '100') {
        //if ( '100' == '100') {
            $status = true;
            $Authority = $result['Authority'];
           // $Authority = '654654sd@D@DH@^DDDDKD5456s55SDF';
            $authority = new authority();
            $authority->amount      = $Amount;
            $authority->authority   = $Authority;
            $authority->customer_id = Session('customer')->id;
            $authority->order_id    = $order[0]->id;
            $authority->save();

        }
        return ['status'=>$status,'Authority'=>$Authority];
    }
    public function payVerify(Request $request){
        $authorityInf = authority::where('authority',$request->Authority)->get();
        $v = new Verta();
        $MerchantID = '8c286b76-facb-11e7-9502-005056a205be';
        $Amount = $authorityInf[0]->amount; //Amount will be based on Toman
        $Authority = $request->Authority;
        if ($request->Status == 'OK') {
            $client = new nusoap_client('https://www.zarinpal.com/pg/services/WebGate/wsdl', 'wsdl');
            $client->soap_defencoding = 'UTF-8';
            $result = $client->call('PaymentVerification', [
                [
                    'MerchantID'     => $MerchantID,
                    'Authority'      => $Authority,
                    'Amount'         => $Amount,
                ],
            ]);

            if ($result['Status'] == 100) {
            //if ( 100 == 100 ) {
                $status = '100';
                 $order = order::find($authorityInf[0]->order_id);

                 $transAct = new transact();
                 $transAct->amount = $Amount;
                 $transAct->tran_id = $result['RefID'];
                 //$transAct->tran_id = '04242424277207';
                 $transAct->pay_time = $v->formatTime();
                 $transAct->pay_date = $v->formatJalaliDate();
                 $transAct->pay_type = 1;
                 $transAct->url_id = $order->url_id;
                 $transAct->customer_id = $order->customer_id;
                 $transAct->order_id = $order->id;
                 $transAct->save();

                 $order->last_status = 1;
                 $order->save();

            } else {
                $status = '2';
            }
        }
        else {
            $status = '3';
        }
        $date = Jdate::medate();
        $pros = pro_city::where('pro_id',0)->orderBy('id','ASC')->get();
        $cities = pro_city::where('pro_id',Session('customer')->pro_id)->orderBy('id','ASC')->get();
        $sales = customer::find(Session('customer')->id)->orders()->with('transact')->with('cardp')->get();
        return view('customers.payVerified', array('date'=>Jdate::fn($date['date4']),'pros'=>$pros,'cities'=>$cities,'status'=>$status,'sales'=>$sales));
    }

}
