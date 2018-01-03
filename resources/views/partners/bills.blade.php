<div class="container">
    <div class="panel panel-primary">
        <div class="panel-heading">صورتحساب </div>
        <div class="panel-body" id="compLs">


            <span id="searchResult">
<div class="portlet box blue">
  <div class="portlet-title">
	   <div class="caption">
		 مبالغ :
		</div>
	</div>

<div style="width:100%; height:150px; overflow:auto;background:#FFFFFF;">
<table align="center"  dir="rtl" class="table  table-striped table-condensed  table-hover">
<tr align="center">
<td>ردیف</td>
<td>URL</td>
<td>مبلغ فروش</td>
<td>مبلغ پورسانت</td>
<td>تراکنش ها</td>
</tr>
    <?php $i=0;?>
    @foreach ($urls as $url )
        <?php $i++;
        ?>
        <tr align="center">
<td >{{ Jdate::fn($i)}}</td>
<td dir="ltr" >{{$url['url']}}</td>
<td >{{Jdate::echoNum($url['sum'])}}</td>
<td >{{Jdate::echoNum($url['sum']*3/10)}}</td>
<td  style="cursor:pointer"  data-toggle="modal" data-target="#modalLayer" onclick="ctrlAct('{{ $url['id']}}','partners/transActs')" >
<img src="{{ asset('images/cash_back-2-512.png')}}" height="18" width="18" />

</td>
</tr>
    @endforeach
</table>
</div>
</div>
<div class="portlet box blue">
  <div class="portlet-title">
	   <div class="caption">
		واریزها :
		</div>
	</div>

<div style="width:100%; height:150px; overflow:auto;background:#FFFFFF;">
<table align="center"  dir="rtl" class="table  table-striped table-condensed  table-hover">
<tr align="center">
<td>ردیف</td>
<td>مبلغ </td>
<td>تاریخ پرداخت </td>
<td>شماره ارجاع تراکنش</td>
<td>تاریخ ثبت</td>
</tr>
    <?php $i=0;
    $sumPay = 0;
    ?>
    @foreach ($pays as $pay )
        <?php $i++;
        $sumPay += $pay->amount;
        ?>
        <tr align="center">
<td >{{ Jdate::fn($i)}}</td>
<td >{{Jdate::echoNum($pay->amount)}}</td>
<td dir="ltr" >{{Jdate::fn($pay->pay_date.' '.$pay->pay_time)}}</td>
<td >{{Jdate::fn($pay->tran_id)}}</td>
<td >{{Jdate::fn(Verta::instance($pay->created_at))}}</td>
</tr>
    @endforeach
</table>
</div>
</div>
<div class="portlet box blue">
  <div class="portlet-title">
	   <div class="caption">
		صورت حساب :
		</div>
	</div>

<div style="width:100%; height:150px; overflow:auto;background:#FFFFFF;">
<table align="center"  dir="rtl" class="table  table-striped table-condensed  table-hover">
<tr align="center">
<td>جمع پورسانت </td>
<td>جمع پرداختی </td>
<td>مانده حساب</td>
</tr>

        <tr align="center">
<td >{{Jdate::echoNum($sum*3/10)}}</td>
<td >{{Jdate::echoNum($sumPay)}}</td>
<td >{{Jdate::echoNum(  $sum*3/10 - $sumPay)}}</td>
</tr>

</table>
</div>
</div>
</span>
        </div></div></div>
<div class="modal fade" id="modalLayer" tabindex="-1" role="dialog" aria-labelledby="modalLayer">

	<div class="modal-dialog modal-sm" role="document" style="width:600px">
		<div class="modal-content" id="LayerDiv">

		</div>
	</div>
</div>

