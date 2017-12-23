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
}
