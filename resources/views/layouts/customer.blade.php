<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="fa" dir="rtl">
<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="language" content="en" />
    <meta name="csrf-token" content="<?php echo csrf_token() ?>"/>
    <title>هوشیار سازه</title>
    <link rel="icon" type="image/png" href="favicon.png"  />
    <link rel="stylesheet" type="text/css" href="{{asset('engine1/style.css')}}" />
    <script type="text/javascript" src="{{asset('engine1/jquery.js')}}"></script>
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
<body style="overflow: hidden;">
<div class="">
    <div class="container">
        <br /><br /><br />


    </div>

</div>
<input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">

<div class="container"  id="AdminDiv">
    <table align="center">

        <tr dir="rtl">
            <td style="padding: 10px; background-color:rgba(67,85,66,0.37);width: 460px; color: #ffffff; vertical-align: top"> <div id="orderRep">
                @if(count($order)>0)
                    @include('customers.orders')
                    @else


                متن<br/>
                <div id="btns" class="btns">
                    <button onclick="$('#btns').slideUp(300);$('#orderFrm').slideDown(300)" class="btn btn-primary">ثبت سفارش</button>
                    <button onclick="$('#btns').slideUp(300);$('#loginFrm').slideDown(300)" class="btn btn-primary">پیگیری سفارش</button>
                </div>
                <div id="orderFrm" class="Frms" style="display: none">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-8"  style="padding:2px">تعداد </label>
                                        <div class="col-md-10">

                                            <select class="form-control input-sm" id="count" name="count">
                                                @for($i=1;$i<23;$i++)
                                                    <option value="{{$i}}">{{Jdate::fn($i)}}</option>
                                                    @endfor
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-8"  style="padding:2px">شماره تماس</label>
                                        <div class="col-md-10">
                                            <input class="form-control input-sm" maxlength="11"  name="tel" value="{{session('customer')->tel}}" onkeypress="return isNumberKey(event)"   id="tel" type="text" />
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
                                                    <option
                                                            @if($pro->id == Session('customer')->pro_id)
                                                                    selected="selected"
                                                                    @endif
                                                            value="{{ $pro->id  }}">{{$pro->name}}</option>
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
                                                    <option
                                                            @if($city->id == Session('customer')->city_id)
                                                            selected="selected"
                                                            @endif
                                                            value="{{$city->id}}">{{$city->name}}</option>
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
                                            <input class="form-control input-sm" maxlength="200" name="addr" value="{{Session('customer')->addr}}"   id="addr" type="text" />
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="row">


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-8"  style="padding:2px">کدپستی</label>
                                        <div class="col-md-10">
                                            <input class="form-control input-sm" onkeypress="return isNumberKey(event)" value="{{Session('customer')->p_code}}" maxlength="10" dir="ltr"  name="p_code"   id="p_code" type="text" />
                                        </div>
                                    </div>
                                </div>

                            </div>


                            <div class="row">
                                <div class="col-md-6">
                                    <br/>
                                    <button onclick="$('#orderFrm').slideUp(300);$('#btns').slideDown(300)" class="btn btn-primary">انصراف</button>
                                </div>
                                <div class="col-md-6">
                                    <br/>
                                    <button onclick="regOrder()" class="btn btn-primary">ثبت سفارش</button>
                                    <div class="form-section caption-subject font-red-sunglo" id="m_ch" style="color:#ff1522"><br/></div>
                                </div>

                            </div>





                    </div>


                <div id="loginFrm" class="Frms" style="display: none">
                    @if(count($sales)>0)
                        @include('customers.sales')
                    @else
                    شما سفارشی ثبت نکرده اید
                    @endif
                </div>

</div>
                @endif
            </td>
            <td style="text-align: left;width: 640px;" dir="ltr">@include('master.slider')</td>
        </tr>
    </table>


</div>

</div>

<script>
    $(function () {
        $('[data-toggle="popover"]').popover()
    })
</script>
<script type="text/javascript" src="{{asset('engine1/wowslider.js')}}"></script>
<script type="text/javascript" src="{{asset('engine1/script.js')}}"></script>
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





