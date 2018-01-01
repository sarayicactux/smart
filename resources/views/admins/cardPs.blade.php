<div class="container">
    <div class="panel panel-primary">
        <div class="panel-heading">لیست واریزها ها</div>
        <div class="panel-body" id="compLs">


            <span id="searchResult">
                <div class="portlet box blue">
  <div class="portlet-title">
	   <div class="caption">
		لیست موارد جدید : {{ Jdate::fn(count($cardP0s))}} مورد
		</div>
	</div>

<div style="width:100%; height:300px; overflow:auto;background:#FFFFFF;">
<table align="center"  dir="rtl" class="table  table-striped table-condensed  table-hover">
<tr align="center">
<td>ردیف</td>
<td>مبلغ</td>
<td>شماره ارجاع</td>
<td>زمان پرداخت</td>
<td>نام و نام خانوادگی</td>
<td>زمان سفارش</td>
<td>شماره تماس</td>
<td>سفارش </td>
<td>عملیات</td>
</tr>
    <?php $i=0;?>
    @foreach ($cardP0s as $cardP )
        <?php $i++;
        ?>
        <tr align="center">
<td >{{ Jdate::fn($i)}}</td>
<td  >{{Jdate::echoNum($cardP->amount)}}</td>
<td  >{{Jdate::fn($cardP->tran_id)}}</td>
<td dir="ltr" >{{Jdate::fn($cardP->pay_date).' '.Jdate::fn($cardP->pay_time)}}</td>
<td >{{$cardP->customer->name.' '.$cardP->customer->name}}</td>
<td dir="ltr" >{{Jdate::fn(Verta::instance($cardP->order->created_at))}}</td>
<td dir="ltr" >{{$cardP->order->tel}}</td>
<td style="cursor:pointer"   data-toggle="modal" data-target="#modalLayer" onclick="ctrlAct('{{ $cardP->order->id}}','admin/orderInf')">
<img src="{{ asset('images/order.png')}}" height="18" width="18" />
</td>
 <td >
<select class="form-control input-sm" onchange="changeCardp('{{ $cardP->id}}',this.value)">
    <option value="0"></option>
    <option value="1">تایید تراکنش</option>
    <option value="2">رد تراکنش</option>
</select>
</td>
</tr>
    @endforeach
</table>
</div>
</div>
                <div class="portlet box blue">
  <div class="portlet-title">
	   <div class="caption">
		لیست موارد تایید شده: {{ Jdate::fn(count($cardP1s))}} مورد
		</div>
	</div>

<div style="width:100%; height:300px; overflow:auto;background:#FFFFFF;">
<table align="center"  dir="rtl" class="table  table-striped table-condensed  table-hover">
<tr align="center">
<td>ردیف</td>
<td>مبلغ</td>
<td>شماره ارجاع</td>
<td>زمان پرداخت</td>
<td>نام و نام خانوادگی</td>
<td>زمان سفارش</td>
<td>شماره تماس</td>
    <td>سفارش</td>
<td>عملیات</td>
</tr>
    <?php $i=0;?>
    @foreach ($cardP1s as $cardP )
        <?php $i++;
        ?>
        <tr align="center">
<td >{{ Jdate::fn($i)}}</td>
<td  >{{Jdate::echoNum($cardP->amount)}}</td>
<td  >{{Jdate::fn($cardP->tran_id)}}</td>
<td dir="ltr" >{{Jdate::fn($cardP->pay_date).' '.Jdate::fn($cardP->pay_time)}}</td>
<td >{{$cardP->customer->name.' '.$cardP->customer->name}}</td>
<td dir="ltr" >{{Jdate::fn(Verta::instance($cardP->order->created_at))}}</td>
<td dir="ltr" >{{$cardP->order->tel}}</td>
            <td style="cursor:pointer"   data-toggle="modal" data-target="#modalLayer" onclick="ctrlAct('{{ $cardP->order->id}}','admin/orderInf')">
<img src="{{ asset('images/order.png')}}" height="18" width="18" />
</td>
 <td >
<select class="form-control input-sm" onchange="changeCardp('{{ $cardP->id}}',this.value)">
    <option value="0"></option>
    <option value="2">رد تراکنش</option>
</select>
</td>
</tr>
    @endforeach
</table>
</div>
</div>
                <div class="portlet box blue">
  <div class="portlet-title">
	   <div class="caption">
		لیست موارد رد شده: {{ Jdate::fn(count($cardP2s))}} مورد
		</div>
	</div>

<div style="width:100%; height:300px; overflow:auto;background:#FFFFFF;">
<table align="center"  dir="rtl" class="table  table-striped table-condensed  table-hover">
<tr align="center">
<td>ردیف</td>
<td>مبلغ</td>
<td>شماره ارجاع</td>
<td>زمان پرداخت</td>
<td>نام و نام خانوادگی</td>
<td>زمان سفارش</td>
<td>شماره تماس</td>
    <td>سفارش</td>
<td>عملیات</td>
</tr>
    <?php $i=0;?>
    @foreach ($cardP2s as $cardP )
        <?php $i++;
        ?>
        <tr align="center">
<td >{{ Jdate::fn($i)}}</td>
<td  >{{Jdate::echoNum($cardP->amount)}}</td>
<td  >{{Jdate::fn($cardP->tran_id)}}</td>
<td dir="ltr" >{{Jdate::fn($cardP->pay_date).' '.Jdate::fn($cardP->pay_time)}}</td>
<td >{{$cardP->customer->name.' '.$cardP->customer->name}}</td>
<td dir="ltr" >{{Jdate::fn(Verta::instance($cardP->order->created_at))}}</td>
<td dir="ltr" >{{$cardP->order->tel}}</td>
            <td style="cursor:pointer"   data-toggle="modal" data-target="#modalLayer" onclick="ctrlAct('{{ $cardP->order->id}}','admin/orderInf')">
<img src="{{ asset('images/order.png')}}" height="18" width="18" />
</td>
 <td >
<select class="form-control input-sm" onchange="changeCardp('{{ $cardP->id}}',this.value)">

    <option value="0"></option>
    <option value="1">تایید تراکنش</option>
</select>
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