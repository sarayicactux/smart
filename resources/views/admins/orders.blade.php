<div class="container">
    <div class="panel panel-primary">
        <div class="panel-heading">لیست سفارشها  </div>
        <div class="panel-body" id="compLs">


            <span id="searchResult">
<div class="portlet box blue">
  <div class="portlet-title">
	   <div class="caption">
		تعداد لیست : {{ Jdate::fn(count($orders))}} مورد
		</div>
	</div>

<div style="width:100%; height:300px; overflow:auto;background:#FFFFFF;">
<table align="center"  dir="rtl" class="table  table-striped table-condensed  table-hover">
<tr align="center">
<td>ردیف</td>
<td>تعداد</td>
<td>نام و نام خانوادگی</td>
<td>شماره تماس</td>
<td>تاریخ سفارش</td>
<td>url</td>
<td>وضعیت</td>
</tr>
    <?php $i=0;?>
    @foreach ($orders as $order )
        <?php $i++;
        ?>
        <tr align="center">
<td >{{ Jdate::fn($i)}}</td>
<td dir="ltr" >{{$order->count}}</td>
<td >{{$order->customer->name.' '.$order->customer->name}}</td>
<td dir="ltr" >{{$order->tel}}</td>
<td dir="ltr" >{{Jdate::fn(Verta::instance($order->created_at))}}</td>
<td >{{$order->url->name.' '.$order->url->name}}</td>
<td >@if($order->last_status == 0) ثبت سفارش
@else پرداخت شده
@endif
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