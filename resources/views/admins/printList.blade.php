<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="fa" dir="rtl">
<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="language" content="en" />
    <meta name="csrf-token" content="<?php echo csrf_token() ?>"/>
    <title>سیستم همکاری در فروش</title>
    <link rel="icon" type="image/png" href="favicon.png"  />


    <!-- END PAGE LEVEL JAVASCRIPT -->





    <link href="{{asset('css/print.css')}}" rel="stylesheet">


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
<body style="background-color: #ffffff">
<table width="80%" dir="rtl" align="center" >
@foreach($printeds as $printed)
    <tr>
        <?php $order = \App\Models\order::find($printed->order_id);
        $pro = \App\Models\pro_city::find($order->pro_id);
        $city = \App\Models\pro_city::find($order->city_id);
        $customer = \App\Models\customer::find($order->customer_id);
        ?>
        <td dir="rtl"><br><br>
            نشانی گیرنده :
            استان
            {{$pro->name}}, شهرستان {{$city->name}}<br/> {{\App\Helpers\Jdate::fn($order->addr)}}<br>
             {{$customer->name.'  '.$customer->family}}
            , شماره تماس :{{\App\Helpers\Jdate::fn($order->tel)}}
            <br>

            کد پستی :{{\App\Helpers\Jdate::fn($order->p_code)}}
            <br><br>

        </td>

    </tr>
    @endforeach
</table>
</body>
</html>





