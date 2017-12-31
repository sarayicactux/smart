<div class="container">
    <div class="panel panel-primary">
        <div class="panel-heading">لیست بازدیدها </div>
        <div class="panel-body" id="compLs">


            <span id="searchResult">
<div class="portlet box blue">
  <div class="portlet-title">
	   <div class="caption">
		تعداد لیست : {{ Jdate::fn(count($visits))}} مورد
		</div>
	</div>

<div style="width:100%; height:300px; overflow:auto;background:#FFFFFF;">
<table align="center"  dir="rtl" class="table  table-striped table-condensed  table-hover">
<tr align="center">
<td>ردیف</td>
<td>زمان</td>
<td>URL</td>
</tr>
    <?php $i=0;?>
    @foreach ($visits as $visit )
        <?php $i++;
        ?>
        <tr align="center">
<td >{{ Jdate::fn($i)}}</td>
<td dir="ltr" >{{Jdate::fn(Verta::instance($visit->created_at))}}</td>
<td dir="ltr" >{{$visit->url->url}}</td>
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