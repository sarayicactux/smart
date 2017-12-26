<div class="container">
    <div class="panel panel-primary">
        <div class="panel-heading">لیست نشانی های وب <button onclick="
$('#url_id').val('0');
$('#url').val('');
$('#name').val('');
$('#description').val('');
" type="button" data-toggle="modal" data-target="#newFLayer" class="btn btn-sm btn-success pull-left"><span class="glyphicon glyphicon-plus"></span>ثبت مورد جدید</button></div>
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
<td>توضیحات</td>
<td>تاریخ ثبت</td>
<td>بازدیدها</td>
<td>سفارش ها</td>
<td>تراکنش ها</td>
<td>ویرایش</td>
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
<td style="cursor:pointer"   data-toggle="modal" data-target="#modalLayer" onclick="ctrlAct('{{ $url->id}}','partners/visits')">
<img src="{{ asset('images/eye.png')}}" height="18" width="18" />
</td>
<td style="cursor:pointer"   data-toggle="modal" data-target="#modalLayer" onclick="ctrlAct('{{ $url->id}}','partners/orders')">
<img src="{{ asset('images/order.png')}}" height="18" width="18" />
</td>
<td  style="cursor:pointer"  data-toggle="modal" data-target="#modalLayer" onclick="ctrlAct('{{ $url->id}}','partners/transActs')" >
<img src="{{ asset('images/cash_back-2-512.png')}}" height="18" width="18" />

</td>
<td  style="cursor:pointer"  data-toggle="modal" data-target="#editFLayer" onclick="
$('#url_id').val('{{ $url->id}}');
$('#url1').val('{{ $url->url}}');
$('#name1').val('{{ $url->name}}');
$('#description1').val('{{ $url->description}}');
" >
<img src="{{ asset('images/1edit.png')}}" height="18" width="18" />
</td>
</tr>
    @endforeach
</table>
</div>
</div>
</span>
        </div></div></div>


<div class="modal fade" id="modalLayer" tabindex="-1" role="dialog" aria-labelledby="modalLayer">

    <div class="modal-dialog modal-sm" role="document" style="width:400px">
        <div class="modal-content" id="LayerDiv">

        </div>
    </div>
</div>
<div class="modal fade" id="newFLayer" tabindex="-1" role="dialog" aria-labelledby="newFLayer">
    <div class="modal-dialog modal-sm" role="document" style="width:400px">
        <div class="modal-content">
            <div class="panel panel-primary"><div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="modal_plansedit">فرم ثبت نشانی جدید</h4>
                </div>
                <div class="panel-body" id="replyDiv">


                    <fieldset>
                        <legend><span>نام(کانال،سایت یا صفحه )</span></legend>
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                                <div class="form-group" style="width:130px;">
                                    <input class="form-control input-sm"  maxlength="100" size="40" name="name"  id="name" type="text" />

                                </div>
                            </div>

                        </div>
                    </fieldset>

                    <fieldset>
                        <legend><span>آدرس URL</span></legend>
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                                <div class="form-group" style="width:130px;" >
                                    <input class="form-control input-sm" maxlength="120" size="40"  style="font-family:Tahoma; text-align:left" name="url"  id="url" type="text" />

                                </div>
                            </div>

                        </div>
                    </fieldset>

                    <fieldset>
                        <legend><span>توضیحات</span></legend>
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                                <div class="form-group" style="width:270px;">
                                   <textarea cols="200"  class="form-control input-sm" id="description" name="description"></textarea>

                                </div>
                            </div>

                        </div>
                    </fieldset>






                    <div align="left" style="padding-left:10px"><button type="button"     class="btn btn-primary" onclick="urls($('#url_id').val(),$('#name').val(),$('#description').val(),$('#url').val())">ثبت اطلاعات</button></div>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="editFLayer" tabindex="-1" role="dialog" aria-labelledby="editFLayer">
    <div class="modal-dialog modal-sm" role="document" style="width:400px">
        <div class="modal-content">
            <div class="panel panel-primary"><div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="modal_plansedit">فرم ویرایش نشانی </h4>
                </div>
                <div class="panel-body" id="replyDiv">


                    <fieldset>
                        <legend><span>نام(کانال،سایت یا صفحه )</span></legend>
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                                <div class="form-group" style="width:130px;">
                                    <input class="form-control input-sm"  maxlength="100" size="40" name="name1"  id="name1" type="text" />

                                </div>
                            </div>

                        </div>
                    </fieldset>

                    <fieldset>
                        <legend><span>آدرس URL</span></legend>
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                                <div class="form-group" style="width:130px;">
                                    <input class="form-control input-sm" maxlength="120" size="40" style="font-family:Tahoma; text-align:left" name="url1"  id="url1" type="text" />

                                </div>
                            </div>

                        </div>
                    </fieldset>

                    <fieldset>
                        <legend><span>توضیحات</span></legend>
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                                <div class="form-group" style="width:270px;">
                                    <textarea cols="200" class="form-control input-sm" id="description1" name="description1"></textarea>

                                </div>
                            </div>

                        </div>
                    </fieldset>






                    <div align="left" style="padding-left:10px"><button type="button"     class="btn btn-primary" onclick="urls($('#url_id').val(),$('#name1').val(),$('#description1').val(),$('#url1').val())">ویرایش اطلاعات</button></div>
                </div>
            </div>

        </div>
    </div>
</div>

<input type="hidden" id="url_id" value="0" />
