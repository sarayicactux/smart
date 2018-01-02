<div class="container">
    <div class="panel panel-primary">
        <div class="panel-heading">درخواست واریز وجه </div>
        <div class="panel-body" id="compLs">


            <span id="searchResult">
<div class="portlet box blue">
  <div class="portlet-title">
	   <div class="caption">
		 فرم درخواست :
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
</span>
        </div></div></div>

