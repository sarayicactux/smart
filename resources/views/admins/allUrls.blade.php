<div class="container">
    <div class="panel panel-primary">
        <div class="panel-heading">لیست نشانیهای وب </div>
        <div class="panel-body" id="compLs">


            <span id="searchResult">
<div class="portlet box blue">
  <div class="portlet-title">
	   <div class="caption">
		تعداد لیست : {{ Jdate::fn(count($urls))}} مورد
		</div>
	</div>

<div style="width:100%; height:300px; overflow:auto;background:#FFFFFF;">
<table align="center"  dir="rtl" class="table  table-striped table-condensed  table-hover">
<tr align="center">
<td>ردیف</td>
<td>نام</td>
<td>URL</td>
<td>نام نماینده فروش</td>
<td>شماره کارت بانکی</td>
<td>شماره تلفن همراه</td>
<td>تاریخ ثبت </td>
<td>بازدیدها</td>
<td>مشتریان</td>
<td>سفارش ها</td>
<td>تراکنش ها</td>
</tr>
    <?php $i=0;?>
    @foreach ($urls as $url )
        <?php $i++;
        ?>
        <tr align="center">
<td >{{ Jdate::fn($i)}}</td>
<td >{{$url->name}}</td>
<td dir="ltr" >{{$url->url}}</td>
<td >{{$url->partner->name.' '.$url->partner->family}}</td>
<td >{{Jdate::fn($url->partner->card_num)}}</td>
<td >{{Jdate::fn($url->partner->mobile)}}</td>
<td >{{Jdate::fn(Verta::instance($url->created_at))}}</td>
<td style="cursor:pointer"   data-toggle="modal" data-target="#modalLayer" onclick="ctrlAct('{{ $url->id}}','admin/visitsLowUrl')">
<img src="{{ asset('images/eye.png')}}" height="18" width="18" />
</td>
<td style="cursor:pointer"   data-toggle="modal" data-target="#modalLayer" onclick="ctrlAct('{{ $url->id}}','admin/customersLowUrl')">
<img src="{{ asset('images/customer.png')}}" height="18" width="18" />
</td>
<td style="cursor:pointer"   data-toggle="modal" data-target="#modalLayer" onclick="ctrlAct('{{ $url->id}}','admin/ordersLowUrl')">
<img src="{{ asset('images/order.png')}}" height="18" width="18" />
</td>
<td  style="cursor:pointer"  data-toggle="modal" data-target="#modalLayer" onclick="ctrlAct('{{ $url->id}}','admin/transActsLowUrl')" >
<img src="{{ asset('images/cash_back-2-512.png')}}" height="18" width="18" />

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