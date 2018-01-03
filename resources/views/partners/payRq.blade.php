<div class="container">
    <div class="panel panel-primary"><?php
        $sumPay = 0;
        foreach ($pays as $pay ){
            $sumPay += $pay->amount;
        }

        ?>
        <div class="panel-heading">درخواست های واریز
            @if((  $sum*3/10 - $sumPay) > 0 )
            <button onclick="
$('#amount').val('{{$sum*3/10 - $sumPay}}');
$('#description').val('');
" type="button" data-toggle="modal" data-target="#newFLayer" class="btn btn-sm btn-success pull-left"><span class="glyphicon glyphicon-plus"></span>ثبت درخواست جدید</button>
        @endif
        </div>
        <div class="panel-body" id="compLs">


            <span id="searchResult">
<div class="portlet box blue">
  <div class="portlet-title">
	   <div class="caption">
		لیست درخواست ها :
		</div>
	</div>

<div style="width:100%; height:150px; overflow:auto;background:#FFFFFF;">
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
<td  style="cursor:pointer"  data-toggle="modal" data-target="#modalLayer" onclick="ctrlAct('{{ $payRq->id }}','partners/payRqInf')" >
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

    <div class="modal-dialog modal-sm" role="document" style="width:600px">
        <div class="modal-content" id="LayerDiv">

        </div>
    </div>
</div>
<div class="modal fade" id="newFLayer" tabindex="-1" role="dialog" aria-labelledby="newFLayer">
    <div class="modal-dialog modal-sm" role="document" style="width:400px">
        <div class="modal-content">
            <div class="panel panel-primary"><div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="modal_plansedit">فرم ثبت درخواست واریز</h4>
                </div>
                <div class="panel-body" id="replyDiv">


                    <fieldset>
                        <legend><span>مبلغ</span></legend>
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                                <div class="form-group" style="width:130px;">
                                    <input class="form-control input-sm" maxlength="8" readonly  name="amount" onkeypress="return isNumberKey(event)"   id="amount" type="text" />

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






                    <div align="left" style="padding-left:10px"><button type="button"     class="btn btn-primary" onclick="payRq($('#amount').val(),$('#description').val())">ثبت اطلاعات</button></div>
                </div>
            </div>

        </div>
    </div>
</div>

