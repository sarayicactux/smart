<div class="modal-content">
    <div class="panel panel-primary"><div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="modal_plansedit">
جزئیات درخواست واریز وجه

            </h4>
        </div>
        <div style="height: 400px; overflow: auto;" >
        <table align="center"  dir="rtl" class="table  table-striped table-condensed  table-hover">
            <tr align="right">
                <td>مبلغ</td>
                <td>{{Jdate::echoNum($payrq->amount)}}</td>

                <td>توضیحات</td>
                <td>{{$payrq->description}}</td>
            </tr>
            <tr align="right">
                <td>پاسخ درخواست</td>
                <td>@if($payrq->last_status == '0'){{$payrq->m_resp}}@else دردست بررسی @endif</td>

                <td>تاریخ ثبت پاسخ</td>
                <td>@if($payrq->last_status == '0'){{Jdate::fn(Verta::instance($payrq->updated_at))}}@else دردست بررسی @endif</td>
            </tr>
        </table>
        @if($payrq->last_status == '0')


            <div class="panel-body" id="replyDiv">


                <fieldset>
                    <legend><span>وضعیت</span></legend>
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                            <div class="form-group" style="width:130px;">
                                <select class="form-control input-sm" id="last_status" onchange="if(this.value == 1)$('#payInf').slideUp(300);
                                else $('#payInf').slideDown(300); " >
                                    <option value="1">رد درخواست</option>
                                    <option value="2">تایید درخواست</option>
                                </select>

                            </div>
                        </div>

                    </div>
                </fieldset>
                <fieldset>
                    <legend><span>توضیحات</span></legend>
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                            <div class="form-group" style="width:270px;">
                                <textarea cols="200"  class="form-control input-sm" id="m_resp" name="m_resp"></textarea>

                            </div>
                        </div>

                    </div>
                </fieldset>
                <fieldset id="payInf" style="display: none">
                    <legend><span>اطلاعات پرداخت</span></legend>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-8"  style="padding:2px">تاریخ پرداخت</label>
                                <div class="col-md-10">
                                    <input class="form-control input-sm" maxlength="60" dir="ltr"  name="pay_date" id="pay_date" type="text" readonly />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-8"  style="padding:2px">شماره ارجاع</label>
                                <div class="col-md-10">
                                    <input class="form-control input-sm" maxlength="60" dir="ltr"  name="tran_id" id="tran_id" type="text"  />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-8"  style="padding:2px">مبلغ - ريال</label>
                                <div class="col-md-10">
                                    <input class="form-control input-sm" readonly maxlength="60" value="{{$payrq->amount}}" onkeypress="return isNumberKey(event)" dir="ltr"  name="amount" id="amount" type="text" />
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-8"  style="padding:2px">ساعت </label>
                                <div class="col-md-10">
                                    <select class="form-control input-sm" id="payH">
                                        @for($i=0;$i<25;$i++)
                                            <option value="{{$i}}">{{Jdate::fn($i)}}</option>
                                        @endfor
                                    </select>


                                </div>
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-8"  style="padding:2px">دقیقه</label>
                                <div class="col-md-10">

                                    <select class="form-control input-sm" id="payM">
                                        @for($i=0;$i<60;$i++)
                                            <option value="{{$i}}">{{Jdate::fn($i)}}</option>
                                        @endfor
                                    </select>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <br/>

                            <div class="form-section caption-subject font-red-sunglo" id="m_ch" style="color:#ff1522"><br/></div>
                        </div>

                    </div>
                </fieldset>






                <div align="left" style="padding-left:10px"> <button onclick="regPayRqRes('{{$payrq->id}}')" class="btn btn-primary">ثبت اطلاعات</button></div>
            </div>
            @endif
        </div>
    </div>

</div>
<script language="javascript">
    $('#pay_date, #pay_date').MdPersianDateTimePicker({TargetSelector: '#pay_date'});
</script>