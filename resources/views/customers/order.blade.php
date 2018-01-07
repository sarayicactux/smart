<div class="modal-content" style="color: #000000">
    <div class="panel panel-primary"><div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="modal_plansedit">
پیگیری سفارش
            </h4>
        </div>
        <fieldset>
            <legend><span>اطلاعات سفارش</span></legend>
            <table align="center"  dir="rtl" class="table  table-striped table-condensed  table-hover">
                <tr align="center">
                    <td>شماره تماس</td>
                    <td>تعداد</td>
                    <td>تاریخ سفارش</td>
                    <td> نشانی </td>

                </tr>

                <tr align="center">
                    <td >{{ Jdate::fn($order->tel)}}</td>
                    <td >{{ Jdate::fn($order->count)}}</td>
                    <td dir="ltr" >{{Jdate::fn(Verta::instance($order->created_at))}}</td>
                    <td dir="rtl" >{{' استان '.$pro.' شهر '.$city.' '.$order->addr.' کد پستی '.$order->p_code}}</td>

                </tr>

            </table>
        </fieldset>
        <fieldset>
            <legend><span>اطلاعات پرداخت</span></legend>
            @if($order->last_status == 1)
                <table align="center"  dir="rtl" class="table  table-striped table-condensed  table-hover">
                    <tr align="center">
                        <td>مبلغ</td>
                        <td>شماره ارجاع</td>
                        <td>تاریخ پرداخت</td>
                        <td> نوع پرداخت </td>

                    </tr>

                    <tr align="center">
                        <td >{{ Jdate::echoNum($transAct->amount)}}</td>
                        <td >{{ Jdate::fn($transAct->tran_id)}}</td>
                        <td dir="ltr" >{{Jdate::fn($transAct->pay_date).' '.Jdate::fn($transAct->pay_time)}}</td>
                        <td dir="rtl" >@if($transAct->pay_type == 1) آنلاین @else کارت به کارت @endif</td>

                    </tr>

                </table>
            @elseif(isset($cardP->tran_id))
                <table align="center"  dir="rtl" class="table  table-striped table-condensed  table-hover">
                    <tr align="center">
                        <td>مبلغ</td>
                        <td>شماره ارجاع</td>
                        <td>تاریخ پرداخت</td>
                        <td> تاریخ ثبت </td>

                    </tr>

                    <tr align="center">
                        <td >{{ Jdate::echoNum($cardP->amount)}}</td>
                        <td >{{ Jdate::fn($cardP->tran_id)}}</td>
                        <td dir="ltr" >{{Jdate::fn($cardP->pay_date).' '.Jdate::fn($cardP->pay_time)}}</td>
                        <td dir="rtl" >{{Jdate::fn(Verta::instance($cardP->created_at))}}</td>

                    </tr>

                </table>
            @else پرداختی انجام نشده
            @endif
            <table align="center"  dir="rtl" class="table  table-striped table-condensed  table-hover">
                <tr align="center">
                    <td>شماره تماس</td>
                    <td>تعداد</td>
                    <td>تاریخ سفارش</td>
                    <td> نشانی </td>

                </tr>

                <tr align="center">
                    <td >{{ Jdate::fn($order->tel)}}</td>
                    <td >{{ Jdate::fn($order->count)}}</td>
                    <td dir="ltr" >{{Jdate::fn(Verta::instance($order->created_at))}}</td>
                    <td dir="rtl" >{{' استان '.$pro.' شهر '.$city.' '.$order->addr.' کد پستی '.$order->p_code}}</td>

                </tr>

            </table>
        </fieldset>

    </div>

</div>