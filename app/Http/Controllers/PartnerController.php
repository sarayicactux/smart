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
                //$partner = new partner;
                $partner = partner::create($request->all());
            session ( [
                'partner' => $partner
            ] );

        }
}
