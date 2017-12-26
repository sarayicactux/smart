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

}
