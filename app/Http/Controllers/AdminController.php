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
}
