<div class="modal-content">
    <div class="panel panel-primary"><div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="modal_plansedit">
               لیست سفارشها :  {{ Jdate::fn(count($orders))}} مورد

            </h4>
        </div>
        <div style="height: 400px; overflow: auto;" >
        <table align="center"  dir="rtl" class="table  table-striped table-condensed  table-hover">
            <tr align="center">
                <td width="10px">ردیف</td>
                <td>نام و نام خانوادگی</td>
                <td>شماره تماس</td>
                <td>تاریخ سفارش</td>
                <td>نام نشانی </td>
                <td> URL </td>
            </tr>
            <?php $i=0;?>
            @foreach ($orders as $order )
                <?php $i++;?>
                <tr align="center">
                    <td >{{ Jdate::fn($i)}}</td>
                    <td >{{ $order->customer->name.' '.$order->customer->family}}</td>
                    <td >{{ Jdate::fn($order->tel)}}</td>
                    <td dir="ltr" >{{Jdate::fn(Verta::instance($order->created_at))}}</td>
                    <td dir="ltr" >{{$order->url->name}}</td>
                    <td dir="ltr" >{{$order->url->url}}</td>
                </tr>
            @endforeach
        </table>
        </div>
    </div>

</div>