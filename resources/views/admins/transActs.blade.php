<div class="container">
    <div class="panel panel-primary">
        <div class="panel-heading">لیست تراکنش ها</div>
        <div class="panel-body" id="compLs">


            <span id="searchResult">
<div class="portlet box blue">
  <div class="portlet-title">
	   <div class="caption">
		تعداد لیست : {{ Jdate::fn(count($transActs))}} مورد
		</div>
	</div>

<div style="width:100%; height:300px; overflow:auto;background:#FFFFFF;">
<table align="center"  dir="rtl" class="table  table-striped table-condensed  table-hover">
<tr align="center">
<td>ردیف</td>
<td>مبلغ</td>
<td>شماره ارجاع</td>
<td>زمان پرداخت</td>
<td>تاریخ سفارش</td>
<td>نام و نام خانوادگی</td>
<td>شماره تماس</td>
<td>url</td>
<td>نوع پرداخت</td>
    <td>سفارش</td>
</tr>
    <?php $i=0;?>
    @foreach ($transActs as $transAct )
        <?php $i++;
        ?>
        <tr align="center">
<td >{{ Jdate::fn($i)}}</td>
<td  >{{Jdate::echoNum($transAct->amount)}}</td>
<td  >{{Jdate::echoNum($transAct->tran_id)}}</td>
<td dir="ltr" >{{Jdate::echo_date($transAct->pay_date).' '.Jdate::echoNum($transAct->pay_time)}}</td>
<td dir="ltr" >{{Jdate::fn(Verta::instance($transAct->order->created_at))}}</td>
<td >{{$transAct->customer->name.' '.$transAct->customer->family}}</td>
<td dir="ltr" >{{$transAct->order->tel}}</td>
<td >{{$transAct->url->name.' '.$transAct->url->name}}</td>
<td >@if($transAct->pay_type == 1)آنلاین
@else کارت به کارت
@endif
</td>
            <td style="cursor:pointer"   data-toggle="modal" data-target="#modalLayer" onclick="ctrlAct('{{ $transAct->order->id}}','admin/orderInf')">
<img src="{{ asset('images/order.png')}}" height="18" width="18" />
</td>
</tr>
    @endforeach
</table>
</div>
</div>
</span>
        </div></div></div>


<div class="modal fade" id="modalLayer" tabindex="-1" role="dialog" aria-labelledby="modalLayer">

    <div class="modal-dialog modal-sm" role="document" style="width:700px">
        <div class="modal-content" id="LayerDiv">

        </div>
    </div>
</div>