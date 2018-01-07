
   
       
      


           
<div class="portlet box blue">
  <div class="portlet-title">
	   <div class="caption">
		تعداد سفارشهای شما : {{ Jdate::fn(count($sales))}} مورد
		</div>
	</div>

<div style="width:100%; height:300px; overflow:auto;background:#FFFFFF;">
<table align="center" style="color: #000000"  dir="rtl" class="table  table-striped table-condensed  table-hover">
<tr align="center">
<td>ردیف</td>
<td>تعداد</td>
<td>تاریخ ثبت سفارش</td>
<td>شماره تماس </td>
<td>وضعیت</td>
<td>مشاهده </td>
</tr>
    <?php $i=0;?>
    @foreach ($sales as $sale )
        <?php $i++;
        ?>
        <tr align="center">
<td >{{ Jdate::fn($i)}}</td>
<td >{{Jdate::fn($sale->count)}}</td>
 <td >{{Jdate::fn(Verta::instance($sale->created_at))}}</td>
<td >{{Jdate::fn($sale->tel)}}</td>
<td >@if($sale->last_status == '0') معلق @else فروش کامل شده @endif</td>

<td style="cursor:pointer"   data-toggle="modal" data-target="#modalLayer" onclick="ctrlAct('{{ $sale->id}}','customerOrder')">
<img src="{{ asset('images/eye.png')}}" height="18" width="18" />
</td>
</tr>
    @endforeach
</table>
</div>
</div>
</span>
       


<div class="modal fade" id="modalLayer" tabindex="-1" role="dialog" aria-labelledby="modalLayer">

    <div class="modal-dialog modal-sm" role="document" style="width:700px">
        <div class="modal-content" id="LayerDiv">

        </div>
    </div>
</div>