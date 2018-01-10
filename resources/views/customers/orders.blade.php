<div class="row" style="padding: 15px;" id="btns"><div class="row">


    <div style="padding: 12px;">{{Session('customer')->name}}&nbsp;{{Session('customer')->family.'  عزیز'}} <br>با تشکر از شما، لطفا نحوه پرداخت را انتخاب کنید
    </div>


</div>



    <div class="col-md-3">
        <br/>
        <button onclick="$('#btns').slideUp(300);$('#cardPDiv').slideDown(300)" class="btn btn-primary">کارت به کارت</button>

    </div>
    <div class="col-md-3">
        <br/>
        <button onclick="onlinePay()" class="btn btn-primary">پرداخت آنلاین</button>
        </div>

<div class="col-md-3">
    <br/>
    <button onclick="$('#btns').slideUp(300);$('#loginFrm').slideDown(300)" class="btn btn-primary">پیگیری سفارش</button>
</div>
</div>

</div>
<div id="cardPDiv" class="Frms" style="display: none">
    <div class="row" style="padding: 12px;"  >
        پرداخت به کارت به شماره 5241-4525-5241-8574
        <br>بانک ملت
        <br>
        به نام محمد سرایی
    </div>
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
                    <input class="form-control input-sm" maxlength="60" readonly value="{{$order[0]->count*200000}}" onkeypress="return isNumberKey(event)" dir="ltr"  name="amount" id="amount" type="text" />
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
            <button onclick="$('#cardPDiv').slideUp(300);$('#btns').slideDown(300)" class="btn btn-primary">انصراف</button>
        </div>
        <div class="col-md-6">
            <br/>
            <button onclick="registerCardP()" class="btn btn-primary">ثبت اطلاعات</button>
        </div>

    </div>
    <div class="row">
        <div class="col-md-6">
            <br/>

            <div class="form-section caption-subject font-red-sunglo" id="m_ch" style="color:#ff1522"><br/></div>
        </div>

    </div>

</div>
<div id="loginFrm" class="Frms" align="center" style="display: none">
    @if(count($sales)>0)
        @include('customers.sales')
    @else
        شما سفارشی ثبت نکرده اید
    @endif

        <button onclick="$('#loginFrm').slideUp(300);$('#btns').slideDown(300)" class="btn btn-primary">بازگشت</button>
</div>
<script language="javascript">
    $('#pay_date, #pay_date').MdPersianDateTimePicker({TargetSelector: '#pay_date'});
</script>