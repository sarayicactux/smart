<div class="container">
    <div class="panel panel-primary">
        <div class="panel-heading">ارسال شده ها <button onclick="newPrintLs()" type="button"  class="btn btn-sm btn-success pull-left"><span class="glyphicon glyphicon-plus"></span>ثبت مورد جدید</button></div>
        <div class="panel-body" id="compLs">


            <span id="searchResult">
<div class="portlet box blue">
  <div class="portlet-title">
	   <div class="caption">
		تعداد لیست : {{ Jdate::fn(count($printacts))}} مورد
		</div>
	</div>

<div style="width:100%; height:300px; overflow:auto;background:#FFFFFF;">
<table align="center"  dir="rtl" class="table  table-striped table-condensed  table-hover">
<tr align="center">
<td>ردیف</td>
<td>تاریخ ثبت</td>
<td>چاپ</td>
</tr>
    <?php $i=0;?>
    @foreach ($printacts as $printact )
        <?php $i++;
        ?>
        <tr align="center">
<td >{{ Jdate::fn($i)}}</td>
<td >{{Jdate::fn(Verta::instance($printact->created_at))}}</td>

<td   >
    <a target="_blank" href="index.php/admin/printList/{{ $printact->id}}"><img src="{{ asset('images/printer.png')}}" height="18" width="18" /></a>


</tr>
    @endforeach
</table>
</div>
</div>
</span>
        </div></div></div>
