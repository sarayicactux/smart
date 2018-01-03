<?php

namespace App\Http\Controllers;

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
use App\Helpers\Jdate;
use Verta;

class PartnerController extends Controller
{
        public function regPartner(Request $request){
                $partner = partner::create($request->all());
            session ( [
                'partner' => $partner
            ] );

        }
    public function loginPartner(Request $request){
        $buff = partner::where('email',$request->email)
            ->where('password',$request->password)
            ->get();
        $log = false;
        if (count($buff) == 1){
            session ( [
                'partner' => $buff[0]
            ] );
            $log = true;

        }

        return array('status'=>$log);
    }
    public function urlsLs(){
        $partner = partner::find(session('partner')->id);
        $urls = $partner->urls()->get();

        return view('partners.urlsLs',array('urls'=>$urls));

    }
    public function urlsAddEdit(Request $request){
        $partner = partner::find(session('partner')->id);
        if ($request->id == 0 ){

            $url = $partner->urls()->create($request->all());
        }
        else{
            $url = url::find($request->id);
            $url->name = $request->name;
            $url->url  = $request->url;
            $url->description = $request->description;
            $url->save();
        }

        $urls = $partner->urls()->get();

        return view('partners.urlsLs',array('urls'=>$urls));
    }
    public function visitsLow(Request $request){
            $url = url::find($request->tId);
            $visits = $url->visits()->orderBy('id','DESC')->limit(2000)->get();
            return view('partners.visitsLow',array('visits'=>$visits));


    }
    public function transActsLow(Request $request){
        $url = url::find($request->tId);
        $transacts = $url->transacts()->orderBy('id','DESC')->limit(2000)->get();
        return view('partners.transActLow',array('transacts'=>$transacts));


    }
    public function ordersLow(Request $request){
        $url = url::find($request->tId);
        $orders = $url->orders()->orderBy('id','DESC')->limit(2000)->get();
        return view('partners.ordersLow',array('orders'=>$orders));


    }
    public function bills(){
        $partner = partner::find(session('partner')->id);
        $urls = $partner->urls()->with('transacts')->get();
        $sum = 0;
        $i = 0;
        foreach ($urls as $url){
            $sumUrl = 0;
            foreach ($url->transacts as $transact){
                $sumUrl += $transact->amount;
            }
            $urlInf[$i]['id'] = $url->id;
            $urlInf[$i]['url'] = $url->url;
            $urlInf[$i]['sum'] = $sumUrl;
            $sum += $sumUrl;
        }
        $pays = $partner->payparts()->get();
        return view('partners.bills',array('pays'=>$pays,'sum'=>$sum,'urls'=>$urlInf));
    }
    public function payRq(){
        $partner = partner::find(session('partner')->id);
        $urls = $partner->urls()->with('transacts')->get();
        $sum = 0;
        $i = 0;
        foreach ($urls as $url){
            $sumUrl = 0;
            foreach ($url->transacts as $transact){
                $sumUrl += $transact->amount;
            }
            $urlInf[$i]['id'] = $url->id;
            $urlInf[$i]['url'] = $url->url;
            $urlInf[$i]['sum'] = $sumUrl;
            $sum += $sumUrl;
        }
        $pays = $partner->payparts()->get();
        $payRqs = $partner->payrqs()->get();
        return view('partners.payRq',array('pays'=>$pays,'sum'=>$sum,'urls'=>$urlInf,'payRqs'=>$payRqs));
    }
    public function regPayRq(Request $request){

            $partner = partner::find(session('partner')->id);
            $PayRq = $partner->payrqs()->create($request->all());




        return $this->payRq();
    }
    public function payRqInf(Request $request){
        $payrq = payrq::find($request->tId);
        return view('partners.payRqInf',array('payrq'=>$payrq));


    }
}
