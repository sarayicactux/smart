<?php

namespace App\Http\Controllers;

use App\Models\pro_city;
use Illuminate\Http\Request;
use App\Models\partner;
use App\Models\url;
use App\Models\visit;
use App\Models\customer;
use App\Models\transact;
use App\Models\order;
use App\Models\paypart;
use App\Models\payrq;
use App\Models\cardp;
use App\Models\printact;
use App\Models\printed;
use App\Helpers\Jdate;
use Verta;
class AdminController extends Controller
{
    public function partnersLs(){
        $partners = partner::all();


        return view('admins.partnersLs',array('partners'=>$partners));

    }
    public function urlsLs(Request $request){
        $partner = partner::find($request->tId);
        $urls = $partner->urls()->get();

        return view('admins.urlsLs',array('urls'=>$urls));

    }
    public function visitsLow(Request $request){
        $partner = partner::find($request->tId);
        $visits = $partner->visits()->orderBy('id','DESC')->limit(400)->with('url')->get();
        return view('admins.visitsLow',array('visits'=>$visits));


    }
    public function customersLow(Request $request){
        $partner = partner::find($request->tId);
        $customers = $partner->customers()->orderBy('id','DESC')->limit(1000)->with('url')->get();
        return view('admins.customersLow',array('customers'=>$customers));


    }
    public function ordersLow(Request $request){
        $partner = partner::find($request->tId);
        $orders = $partner->orders()->orderBy('id','DESC')->limit(400)->with('customer')->with('url')->get();
        return view('admins.ordersLow',array('orders'=>$orders));


    }
    public function transActsLow(Request $request){
        $partner = partner::find($request->tId);
        $transacts = $partner->transacts()->orderBy('id','DESC')->limit(400)->with('customer')->with('url')->get();
        return view('admins.transActsLow',array('transacts'=>$transacts));


    }
    public function allUrls(){
        $urls = url::orderBy('id','DESC')->limit(400)->with('partner')->get();

        return view('admins.allUrls',array('urls'=>$urls));

    }
    public function visitsLowUrl(Request $request){
        $url = url::find($request->tId);
        $visits = $url->visits()->orderBy('id','DESC')->limit(400)->with('url')->get();
        return view('admins.visitsLow',array('visits'=>$visits));


    }
    public function customersLowUrl(Request $request){
        $url = url::find($request->tId);
        $customers = $url->customers()->orderBy('id','DESC')->limit(1000)->with('url')->get();
        return view('admins.customersLow',array('customers'=>$customers));


    }
    public function ordersLowUrl(Request $request){
        $url = url::find($request->tId);
        $orders = $url->orders()->orderBy('id','DESC')->limit(400)->with('customer')->with('url')->get();
        return view('admins.ordersLow',array('orders'=>$orders));


    }
    public function transActsLowUrl(Request $request){
        $url = url::find($request->tId);
        $transacts = $url->transacts()->orderBy('id','DESC')->limit(400)->with('customer')->with('url')->get();
        return view('admins.transActsLow',array('transacts'=>$transacts));


    }
    public function visits(){
        $visits = visit::orderBy('id','DESC')->limit(1000)->with('url')->get();

        return view('admins.visitsAll',array('visits'=>$visits));

    }
    public function orders(Request $request){

        $orders = order::orderBy('id','DESC')->limit(400)->with('customer')->with('url')->get();
        return view('admins.orders',array('orders'=>$orders));


    }
    public function transActs(Request $request){

        $transActs = transact::orderBy('id','DESC')->limit(400)->with('order')->with('customer')->with('url')->get();
        return view('admins.transActs',array('transActs'=>$transActs));


    }
    public function cardPs(){

        $cardP0 = cardp::where('last_status',0)->orderBy('id','DESC')->limit(400)->with('customer')->with('order')->get();
        $cardP1 = cardp::where('last_status',1)->orderBy('id','DESC')->limit(400)->with('customer')->with('order')->get();
        $cardP2 = cardp::where('last_status',2)->orderBy('id','DESC')->limit(400)->with('customer')->with('order')->get();
        return view('admins.cardPs',array('cardP0s'=>$cardP0,'cardP1s'=>$cardP1,'cardP2s'=>$cardP2));


    }
    public function changeCardp(Request $request){
            $cardP = cardp::find($request->id);
            $cardP->last_status = $request->status;
            $cardP->save();

            if($request->status == '1'){

                $transAct = new transact();
                $transAct->amount = $cardP->amount;
                $transAct->tran_id = $cardP->tran_id;
                $transAct->pay_time = $cardP->pay_time;
                $transAct->pay_date = $cardP->pay_date;
                $transAct->pay_type = 2;
                $transAct->url_id = $cardP->url_id;
                $transAct->customer_id = $cardP->customer_id;
                $transAct->order_id = $cardP->order_id;
                $transAct->save();

                $order = order::find($cardP->order_id);
                $order->last_status = 1;
                $order->save();

            }
            if($request->status == '2'){
                transact::where('tran_id', $cardP->tran_id)->delete();
                $order = order::find($cardP->order_id);
                $order->last_status = 0;
                $order->save();
            }

           return $this->cardPs();
    }
    public function orderInf(Request $request){
            $order = order::find($request->tId);
            $pro   = pro_city::find($order->pro_id);
            $city  = pro_city::find($order->city_id);
            return view('admins.orderInf',array('order'=>$order,'pro'=>$pro->name,'city'=>$city->name));
    }
    public function customers(){
        $customers = customer::orderBy('id','DESC')->limit(1000)->get();

        return view('admins.customers',array('customers'=>$customers));
    }
    public function costomerOrders(Request $request){
        $orders = order::where('customer_id',$request->tId)->with('customer')->with('url')->get();
        return view('admins.ordersLow',array('orders'=>$orders));
    }
    public function costomerTransActs(Request $request){
        $transacts = transact::where('customer_id',$request->tId)->with('customer')->with('url')->get();
        return view('admins.transActsLow',array('transacts'=>$transacts));


    }
    public function payRq(){
        $payRqs = payrq::orderBy('id','DESC')->limit(1000)->get();

        return view('admins.payRqs',array('payRqs'=>$payRqs));
    }
    public function payRqInf(Request $request){
        $payrq = payrq::find($request->tId);
        return view('admins.payRqInf',array('payrq'=>$payrq));


    }
    public function regPayRqRes(Request $request){
            $payrq = payrq::find($request->id);
            $payrq->last_status = $request->last_status;
            $payrq->m_resp      =  $request->m_resp;
            $payrq->save();
            if ($request->last_status == '2'){
                    $payPart = new paypart();
                    $payPart->amount = $payrq->amount;
                    $payPart->description    = $payrq->m_resp;
                    $payPart->pay_time       = $request->pay_time;
                    $payPart->pay_date       = $request->pay_date;
                    $payPart->tran_id        = $request->tran_id;
                    $payPart->pay_date       = $request->pay_date;
                    $payPart->partner_id     = $payrq->partner_id;
                    $payPart->payrq_id       = $request->id;
                    $payPart->save();
            }
            return $this->payRq();
    }
    public function sendList(){
        $printacts = printact::orderBy('id','DESC')->limit(1000)->get();

        return view('admins.printacts',array('printacts'=>$printacts));
    }
    public function newPrintLs(){
        $orders = order::all()->where('send',0)->where('last_status',1 );
        $printact = new printact();
        $printact->save();

        foreach ($orders as $order){
                $order->send = 1;
                $order->save();
                $printed = new printed();
                $printed->order_id = $order->id;
                $printact->printeds()->save($printed);
        }

        return self::sendList();
    }
    public function printList($id){
        $printeds = printed::all()->where('printact_id',$id);
        return view('admins.printList',array('printeds'=>$printeds));

    }
}
