<div class="container">
    <div class="panel panel-primary">
        <div class="panel-heading">لیست مشتریان </div>
        <div class="panel-body" id="compLs">


            <span id="searchResult">
<div class="portlet box blue">
  <div class="portlet-title">
	   <div class="caption">
		تعداد لیست : {{ Jdate::fn(count($customers))}} مورد
		</div>
	</div>

<div style="width:100%; height:300px; overflow:auto;background:#FFFFFF;">
<table align="center"  dir="rtl" class="table  table-striped table-condensed  table-hover">
<tr align="center">
<td>ردیف</td>
<td>نام و نام خانوادگی</td>
<td>شماره تماس</td>
<td> تلفن همراه</td>
<td>استان</td>
<td>شهرستان</td>
<td>تاریخ ثبت نام</td>
<td>سفارشها</td>
<td>تراکنشها</td>
</tr>
    <?php $i=0;?>
    @foreach ($customers as $customer )
        <?php $i++;
        ?>
        <tr align="center">
<td >{{ Jdate::fn($i)}}</td>
<td dir="ltr" >{{$customer->name.' '.$customer->family}}</td>
<td dir="ltr" >{{Jdate::fn($customer->tel)}}</td>
<td dir="ltr" >{{Jdate::fn($customer->mobile)}}</td>
<td dir="ltr" >{{App\Models\pro_city::find($customer->pro_id)->name}}</td>
<td dir="ltr" >{{App\Models\pro_city::find($customer->city_id)->name}}</td>
<td dir="ltr" >{{Jdate::fn(Verta::instance($customer->created_at))}}</td>
<td style="cursor:pointer"   data-toggle="modal" data-target="#modalLayer" onclick="ctrlAct('{{ $customer->id}}','admin/costomerOrders')">
<img src="{{ asset('images/order.png')}}" height="18" width="18" />
</td>
<td  style="cursor:pointer"  data-toggle="modal" data-target="#modalLayer" onclick="ctrlAct('{{ $customer->id}}','admin/costomerTransActs')" >
<img src="{{ asset('images/cash_back-2-512.png')}}" height="18" width="18" />

</td>
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