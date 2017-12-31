<div class="modal-content">
    <div class="panel panel-primary"><div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="modal_plansedit">
                لیست نشانیها :  {{ Jdate::fn(count($urls))}} مورد

            </h4>
        </div>
        <span id="searchResult">
<div style="width:100%; height:300px; overflow:auto;background:#FFFFFF;">
<table align="center"  dir="rtl" class="table  table-striped table-condensed  table-hover">
<tr align="center">
<td>ردیف</td>
<td>نام</td>
<td>URL</td>
<td>توضیحات</td>
<td>تاریخ ثبت</td>
</tr>
    <?php $i=0;?>
    @foreach ($urls as $url )
        <?php $i++;
        ?>
        <tr align="center">
<td >{{ Jdate::fn($i)}}</td>
<td >{{$url->name}}</td>
<td dir="ltr" >{{$url->url}}</td>
<td >{{$url->description}}</td>
<td >{{Jdate::fn(Verta::instance($url->created_at))}}</td>
</tr>
    @endforeach
</table>
</div>

</span>
    </div>

</div>