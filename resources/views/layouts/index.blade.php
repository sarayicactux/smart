<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="fa" dir="rtl">
<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="language" content="en" />
    <meta name="csrf-token" content="<?php echo csrf_token() ?>"/>
    <title>هوشیار سازه</title>
    <link rel="icon" type="image/png" href="favicon.png"  />

    <script src="{{asset('js/jquery-1.7.2.min.js')}}"></script>
    <script src="{{asset('js/func.js')}}"></script>
    <script src="{{asset('js/admin.js')}}"></script>
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/jalaali.js')}}"></script>
    <script src="{{asset('js/jquery.Bootstrap-PersianDateTimePicker.js')}}"></script>


    <!-- END PAGE LEVEL JAVASCRIPT -->





    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/bootstrap-rtl.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/style.css')}}" rel="stylesheet">


    <!-- END PAGE LEVEL SCRIPTS -->
    <!-- Fonts Link -->




    <!--<script>
          $(document).ready(function(){
              var x = 2;
               $('#bgImage').click( function(){
                   try{
                        var src ="res/images/health-bg-"+x+".jpg";
                        $("#bgImage").attr("src", src);
                        if(x<19)
                            x++;
                        else
                            x=1;
                   }catch(e){
                       alert(e);
                   }
                });
          });
     </script>-->





    <!-- END PAGE LEVEL SCRIPTS -->

</head>
<body>
<div class="">
    <div class="container">
        <br /><br />
        <br /><br />


    </div>

</div>
<input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">

<div class="container"  id="AdminDiv">
    <table align="center" width="100%">

        <tr dir="rtl">
            <td width="50%" style="padding: 10px;">متن<br/>
                <div id="btns" class="btns">
                    <button onclick="$('#btns').slideUp(300);$('#regFrm').slideDown(300)" class="btn btn-primary">ثبت سفارش</button>
                    <button onclick="$('#btns').slideUp(300);$('#loginFrm').slideDown(300)" class="btn btn-primary">ورود</button>
                    <button onclick="$('#btns').slideUp(300);$('#loginFrm').slideDown(300)" class="btn btn-primary">ثبت اطلاعات پرداخت</button>
                </div>
                <div id="regFrm" class="Frms" style="display: none">

<div id="orderFrm">
                    قبل از ثبت سفارش، وارد شوید و یا ثبت نام کنید
                    <br/>
                    <button onclick="$('#orderFrm').slideUp(300);$('#registerFrm').slideDown(300)" class="btn btn-primary">ثبت نام</button>
                    <button onclick="$('#regFrm').slideUp(300);$('#loginFrm').slideDown(300)"    class="btn btn-primary">ورود</button>
</div>
                        <div id="registerFrm" class="form-body" style="display: none;">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-8"  style="padding:2px">نام </label>
                                        <div class="col-md-10">
                                            <input class="form-control input-sm" maxlength="60"  name="name"   id="name" type="text" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-8"  style="padding:2px">نام خانوادگی</label>
                                        <div class="col-md-10">
                                            <input class="form-control input-sm" maxlength="60"  name="family"   id="family" type="text" />
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-8"  style="padding:2px"> تلفن ثابت </label>
                                        <div class="col-md-10">
                                            <input class="form-control input-sm" maxlength="11"  name="tel" onkeypress="return isNumberKey(event)"   id="tel" type="text" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-8"  style="padding:2px"> تلفن همراه</label>
                                        <div class="col-md-10">
                                            <input class="form-control input-sm" onkeypress="return isNumberKey(event)" maxlength="11"  name="mobile"   id="mobile"  onblur="
checkMobile(this.value)"   id="email" type="text" />
                                            <input type="hidden" value="0" id="mobileC"/>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-8"  style="padding:2px">استان </label>
                                        <div class="col-md-10">
                                            <select class="form-control input-sm" id="pro_id" onchange="cities(this.value);">

                                                @foreach($pros as $pro)
                                                    <option value="{{ $pro->id  }}">{{$pro->name}}</option>
                                                    @endforeach

                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-8"  style="padding:2px">شهرستان</label>
                                        <div class="col-md-10" id="cities">
                                            <select class="form-control input-sm" id="city_id">
                                                @foreach($cities as $city)
                                                    <option value="{{$city->id}}">{{$city->name}}</option>
                                                    @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="row">

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label col-md-8"  style="padding:2px">نشانی</label>
                                        <div class="col-md-10">
                                            <input class="form-control input-sm" maxlength="200" name="addr"   id="addr" type="text" />
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-8"  style="padding:2px">رمز عبور</label>
                                        <div class="col-md-10">
                                            <input class="form-control input-sm" maxlength="60" dir="ltr"  name="password"   id="password" type="password" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-8"  style="padding:2px">کدپستی</label>
                                        <div class="col-md-10">
                                            <input class="form-control input-sm" maxlength="60" dir="ltr"  name="p_code"   id="p_code" type="text" />
                                        </div>
                                    </div>
                                </div>

                            </div>


                            <div class="row">
                                <div class="col-md-6">
                                    <br/>
                                    <button onclick="$('#regFrm').slideUp(300);$('#btns').slideDown(300)" class="btn btn-primary">انصراف</button>
                                </div>
                                <div class="col-md-6">
                                    <br/>
                                    <button onclick="regCustomer()" class="btn btn-primary">ثبت نام</button>
                                    <div class="form-section caption-subject font-red-sunglo" id="m_ch" style="color:#ff1522"><br/></div>
                                </div>

                            </div>




                        </div>
                    </div>


                <div id="loginFrm" class="Frms" style="display: none">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-8"  style="padding:2px">شماره تلفن همراه</label>
                                <div class="col-md-10">
                                    <input class="form-control input-sm" maxlength="60" dir="ltr"  name="mobileLogin" id="mobileLogin" type="text" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-8"  style="padding:2px">رمز عبور</label>
                                <div class="col-md-10">
                                    <input class="form-control input-sm" maxlength="60" dir="ltr"  name="passwordLogin"   id="passwordLogin" type="password" />
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <br/>
                            <button onclick="$('#loginFrm').slideUp(300);$('#btns').slideDown(300)" class="btn btn-primary">انصراف</button>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <button onclick="loginCustomer()" class="btn btn-primary">ورود</button>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <br/>

                            <div class="form-section caption-subject font-red-sunglo" id="m_ch1" style="color:#ff1522"><br/></div>
                        </div>

                    </div>
                </div>


            </td>
            <td width="50%">slider</td>
        </tr>
    </table>


</div>

</div>

<script>
    $(function () {
        $('[data-toggle="popover"]').popover()
    })
</script>
<div id="bg"></div>
<div id="wait" align="center" >
    <span style="background:#FFFF99; padding:3px">لطفا کمی صبر کنید</span>
</div>
<div id="alerts" align="center">
    <br />
    <span class="alerts" id="err_msg" ></span><br />
    <div class="modal-footer" >
        <button type="button" class="btn btn-primary" onclick="
					$('#alerts').fadeOut(100,function(){
												$('#bg').fadeOut(200,function(){
												$('#err_msg').html('');
												$('#wait').fadeOut(100);
												});

												 });"  >&nbsp;&nbsp;&nbsp;&nbsp;< بسـتن > &nbsp;&nbsp;&nbsp;&nbsp;   </button><br />
    </div>
</div>
<div id="LayerDiv">

</div>
</body>
</html>




