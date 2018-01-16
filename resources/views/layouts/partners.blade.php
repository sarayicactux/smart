<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="fa" dir="rtl">
<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="language" content="en" />
    <meta name="csrf-token" content="<?php echo csrf_token() ?>"/>
    <title>سیستم همکاری در فروش</title>
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
<br/>
        <div class="text-left today" style="color: #ffffff">امروز :{{  $date }} </div>
        <div  align="left">


            <ul class="nav" style="left:35px; position:absolute;">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span style="color:#ffffff"> {{ session ('partner')->name.' '.session ('partner')->family }} خوش آمدید<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li ><a href="#"  data-toggle="modal" data-target="#modalChangePass" >تغییر رمز</a></li>
                        <li ></li>

                    </ul>
                </li>
            </ul>
        </div>
        <br /><br />
        <br />


    </div>

</div>
<input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
<nav class="navbar navbar-primary">
    <div class="container-fluid">

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">


                <li class="dropdown">
                    <a href="#" onclick="postMenus('/urls');" >نشانی وب</a>
                </li>

                <li class="dropdown">
                    <a href="#" onclick="postMenus('/bills');" > صورتحساب ها</a>
                </li>
                <li class="dropdown">
                    <a href="#" onclick="postMenus('/payRq');" >درخواستهای واریز</a>
                </li>
                <li class="dropdown">

                    <a href="/logOut" >خروج</a>

                </li>






            </ul>

        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>

<div class="container"  id="AdminDiv"></div>

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
<div class="modal fade" id="modalChangePass" tabindex="-1" role="dialog" aria-labelledby="modalChangePass">

    <div class="modal-dialog modal-sm" role="document" style="width:400px">
        <div class="modal-content" >
            <div class="panel panel-primary"><div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="modal_plansedit">تغییر رمز ورود</h4>
                </div>
                <div class="panel-body" id="changePassDiv">


                    <fieldset>
                        <legend><span>رمز عبور فعلی </span></legend>
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                                <div class="form-group" style="width:130px;">
                                    <input class="form-control input-sm"  maxlength="100" dir="ltr" size="40" name="oldPass"  id="oldPass" type="password" />

                                </div>
                            </div>

                        </div>
                    </fieldset>

                    <fieldset>
                        <legend><span>رمز عبور جدید</span></legend>
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                                <div class="form-group" style="width:130px;" >
                                    <input class="form-control input-sm" maxlength="120" size="40" dir="ltr" name="newPass"  id="newPass" type="password" />

                                </div>
                            </div>

                        </div>
                    </fieldset>
                    <fieldset>
                        <legend><span>تکرار رمز عبور جدید</span></legend>
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                                <div class="form-group" style="width:130px;" >
                                    <input class="form-control input-sm" maxlength="120" size="40"  dir="ltr" name="cNewPass"  id="cNewPass" type="password" />

                                </div>
                            </div>

                        </div>
                    </fieldset>








                    <div align="left" style="padding-left:10px"><button type="button"     class="btn btn-primary" onclick="changePass($('#oldPass').val(),$('#newPass').val(),$('#cNewPass').val())">ثبت اطلاعات</button></div>
                </div>
            </div>

        </div>
    </div>
</div>
</body>
</html>





