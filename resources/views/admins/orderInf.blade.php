<div class="modal-content">
    <div class="panel panel-primary"><div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="modal_plansedit">
مشاهده اطلاعات سفارش
            </h4>
        </div>

        <table align="center"  dir="rtl" class="table  table-striped table-condensed  table-hover">
            <tr align="center">
                <td>نام و نام خانوادگی</td>
                <td>شماره تماس</td>
                <td>تعداد</td>
                <td>تاریخ سفارش</td>
                <td> نشانی </td>

            </tr>
            <?php $i=0;?>

                <?php $i++;?>
                <tr align="center">
                    <td >{{ $order->customer->name.' '.$order->customer->family}}</td>
                    <td >{{ Jdate::fn($order->tel)}}</td>
                    <td >{{ Jdate::fn($order->count)}}</td>
                    <td dir="ltr" >{{Jdate::fn(Verta::instance($order->created_at))}}</td>
                    <td dir="rtl" >{{' استان '.$pro.' شهر '.$city.' '.$order->addr.' کد پستی '.$order->p_code}}</td>

                </tr>

        </table>

    </div>

</div>