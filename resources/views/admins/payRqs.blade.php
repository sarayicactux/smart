<div class="container">
    <div class="panel panel-primary">
        <div class="panel-heading">لیست درخواستهای واریز وجه </div>
        <div class="panel-body" id="compLs">


            <span id="searchResult">
<div class="portlet box blue">
  <div class="portlet-title">
	   <div class="caption">
		تعداد لیست : {{ Jdate::fn(count($payRqs))}} مورد
		</div>
	</div>

<div style="width:100%; height:300px; overflow:auto;background:#FFFFFF;">
<table align="center"  dir="rtl" class="table  table-striped table-condensed  table-hover">
<tr align="center">
<td>ردیف</td>
<td>مبلغ</td>
<td>توضیحات</td>
<td>تاریخ درخواست</td>
<td>وضعیت</td>
</tr>
    <?php $i=0;?>
    @foreach ($payRqs as $payRq )
        <?php $i++;
        ?>
        <tr align="center">
<td >{{ Jdate::fn($i)}}</td>
<td >{{Jdate::echoNum($payRq->amount)}}</td>
<td >{{$payRq->description}}</td>
<td dir="ltr" >{{Jdate::fn(Verta::instance($payRq->created_at))}}</td>
<td  style="cursor:pointer"  data-toggle="modal" data-target="#modalLayer" onclick="ctrlAct('{{ $payRq->id }}','admin/payRqInf')" >
@if($payRq->last_status == '0') در دست بررسی
    @elseif($payRq->last_status == '1') رد شده
    @else($payRq->last_status == '2') واریز انجام شده
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