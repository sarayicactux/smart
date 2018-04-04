// JavaScript Document
function isNumberKey(evt){

var charCode = (evt.which) ? evt.which : event.keyCode
if (charCode > 31 && (charCode < 47 || charCode > 57))
return false;

return true;}
function NotNumberKey(evt){

var charCode = (evt.which) ? evt.which : event.keyCode
if (charCode > 31 && (charCode < 47 || charCode > 57))
return true;
if ( charCode == 8 ){
	return true;
}
return false;}
function validate(address) {
 
   var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
  
   if(reg.test(address) == false) {
 
      return false;
   }
   else {
	   return true;  
   }}
function checkMelliCode(meli_code) {


    if (meli_code.length == 10) {
        if (meli_code == '1111111111' ||
            meli_code == '0000000000' ||
            meli_code == '2222222222' ||
            meli_code == '3333333333' ||
            meli_code == '4444444444' ||
            meli_code == '5555555555' ||
            meli_code == '6666666666' ||
            meli_code == '7777777777' ||
            meli_code == '8888888888' ||
            meli_code == '9999999999') {
            
           
            return false;
        }
        c = parseInt(meli_code.charAt(9));
        n = parseInt(meli_code.charAt(0)) * 10 +
            parseInt(meli_code.charAt(1)) * 9 +
            parseInt(meli_code.charAt(2)) * 8 +
            parseInt(meli_code.charAt(3)) * 7 +
            parseInt(meli_code.charAt(4)) * 6 +
            parseInt(meli_code.charAt(5)) * 5 +
            parseInt(meli_code.charAt(6)) * 4 +
            parseInt(meli_code.charAt(7)) * 3 +
            parseInt(meli_code.charAt(8)) * 2;
        r = n - parseInt(n / 11) * 11;
        if ((r == 0 && r == c) || (r == 1 && c == 1) || (r > 1 && c == 11 - r)) {
			
            return true;
        } else {
            
            
            return false;
        }
    } else {
		 
        return false;
    }}
function ajaxFileUpload(source , file_el_id ,msg_id , check_id ){
		
		
		
				var file_data = $('#'+file_el_id).prop('files')[0];   
				var form_data = new FormData();                  
				form_data.append('file', file_data);
				$.ajax({
							url: source, // point to server-side PHP script 
							dataType: 'text',  // what to expect back from the PHP script, if anything
							cache: false,
							contentType: false,
							processData: false,
							data: form_data,                         
							type: 'post',
							success: function(data){
								data = JSON.parse(data);
										if(data.err != '1')
										{
											document.getElementById(msg_id).innerHTML = data.err ;
											$('#'+check_id).val('1');
											$('#fileName').val(data.fileName);
										}else
										{
											
											document.getElementById(msg_id).innerHTML = 'حجم فایل بیشتر از حد مجاز است' ;
											$('#'+check_id).val('0');
											
										}
									
				
							}
				 });
	
	}
function postMenus(url){
	$('html, body').animate({ scrollTop: 0 }, 1000);
	$('#bg').fadeIn(100);
	$('#wait').fadeIn(100);
	$.post('index.php/'+url, {
		   _token           : $('#_token').val(),
			   },
		 function(data){ 
		
		 if ( data ){
			 $('#AdminDiv').html(data);
			 $('#bg').fadeOut(100);
	  		 $('#wait').fadeOut(100);
			 }//  2pm
		 });	
}
function changeAdPass(){
	 		var msg = '';
			if ( $('#user_pass_old').val() == '' ){
				$('#user_pass_old').focus();
				msg = 'رمز عبور قبلی وارد نشده';
			}
			else if ( $('#user_pass').val() == '' ){
				$('#user_pass').focus();
				msg = 'رمز عبور جدید وارد نشده';
			}
			else if ( $('#user_pass1').val() == '' ){
				$('#user_pass1').focus();
				msg = 'تکرار رمز عبور وارد نشده';
			}
			else if ( $('#user_pass1').val() != $('#user_pass').val() ){
				msg = 'رمز عبور و تکرار رمز عبور یکسان نیست';
			}
			if ( msg != '' ){
					$('#err_msg').html(msg);
					$('#bg').fadeIn(100,function(){
												$('#alerts').fadeIn(200); 
												 });
					
			}
			else { 
					
					

		
			
		$.post("index.php/admin/changeAdPass", { 
			  		username    : $('#username').val(),
					old_pass    : $('#user_pass_old').val(),
					password    : $('#user_pass').val()
			   },
		 function(data){ 
		 if ( data.status ){
			$('#changeMemP').html('<div class="rt_msg"><label class="required"><div align="center" >با تشکر<br />رمز عبور شما در پایگاه داده ها به روز رسانی شد.</label></div>');
			 
		 }//  2pm
		 else {
			 msg = data.error;
			  $('#err_msg').html(msg);
					$('#bg').fadeIn(100,function(){
												$('#alerts').fadeIn(200); 
												 });
			 }
		 }, "json");
											
									
	  
		}	
}



function ctrlAct(id,ctrlAct){
			$('#wait').fadeIn(100);
			$('#LayerDiv').html('');
			$.post("index.php/"+ctrlAct, { 
				   tId     : id,
				   _token  : $('#_token').val(),
			   },
					 function(data){ 
					
					 if ( data ){
						 $('#LayerDiv').html(data);
				  		 $('#wait').fadeOut(100);
						 }//  2pm
					 });
			}
function urls(id,name,description,url){
    var msg = '';

    if ( name == '' ){

        msg = ' نام وارد نشده';
    }
    else if ( url == '' ){

        msg = ' شناسه وارد نشده';
    }
    else if ( $('#urlC').val() == '0' ){

        msg = ' شناسه وارد شده قبلا انتخاب شده و نامعتبر است';
    }
    else if ( description == '' ){

        msg = ' توضیحات وارد نشده';
    }

    if ( msg != '' ){
        $('#err_msg').html(msg);
        $('#bg').fadeIn(100,function(){
            $('#alerts').fadeIn(200);
        });

    }
    else {

        $('#bg').fadeIn(100);
        $('#wait').fadeIn(100);
        $.post("index.php/urlsAddEdit", {
                name		:	name,
                url			:	url,
                description	:	description,
                id			:	id,
                _token  : $('#_token').val(),
            },
            function(data){
                $('#AdminDiv').html(data);
                $("body").removeClass("modal-open");
                $('.modal-backdrop').fadeOut(100);
                $('#bg').fadeOut(100);
                $('#wait').fadeOut(100);
            });
    }
}
function newPrintLs(){



        $('#bg').fadeIn(100);
        $('#wait').fadeIn(100);
        $.post("index.php/admin/newPrintLs", {

                _token  : $('#_token').val(),
            },
            function(data){
                $('#AdminDiv').html(data);
                $("body").removeClass("modal-open");
                $('.modal-backdrop').fadeOut(100);
                $('#bg').fadeOut(100);
                $('#wait').fadeOut(100);
            });
}
function changePass(oldPass,newPass,cNewPass){
    var msg = '';
    if ( oldPass == '' ){

        msg = ' رمز عبور فعلی وارد نشده';
    }
    else if ( newPass == '' ){

        msg = ' رمز عبور جدید وارد نشده';
    }
    else if ( cNewPass == '' ){

        msg = ' تکرار رمز عبور جدید وارد نشده';
    }
    else if ( cNewPass != newPass ){

        msg = ' رمز عبور جدید و تکرار رمز عبور جدید یکسان نیست';
    }


    if ( msg != '' ){
        $('#err_msg').html(msg);
        $('#bg').fadeIn(100,function(){
            $('#alerts').fadeIn(200);
        });

    }
    else {

        $('#bg').fadeIn(100);
        $('#wait').fadeIn(100);
        $.post("index.php/changePass", {
                newPass		:	newPass,
                oldPass		:	oldPass,
                _token      : $('#_token').val(),
            },
            function(data){

                $('#changePassDiv').html('رمز عبور با موفقیت به روز رسانی شد');
                $('#bg').fadeOut(100);
                $('#wait').fadeOut(100);

            });
    }
}
function cardNum(card_num){
    var msg = '';
    if ( card_num == '' ){

        msg = ' لطفا شماره کارت بانکی را وارد کنید';
    }
    else if ( card_num.length  < 16 ){

        msg = ' شماره کارت وارد شده نا معتبر است';
    }


    if ( msg != '' ){
        $('#err_msg').html(msg);
        $('#bg').fadeIn(100,function(){
            $('#alerts').fadeIn(200);
        });

    }
    else {

        $('#bg').fadeIn(100);
        $('#wait').fadeIn(100);
        $.post("index.php/cardNum", {
                card_num	:	card_num,
                _token      : $('#_token').val(),
            },
            function(data){

                $('#cardNumDiv').html('شماره کارت بانکی با موفقیت به روز رسانی شد');
                $('#bg').fadeOut(100);
                $('#wait').fadeOut(100);

            });
    }
}
function payRq(amount,description){
    var msg = '';
    if ( amount == '' ){

        msg = ' مبلغ وارد نشده';
    }

    if ( msg != '' ){
        $('#err_msg').html(msg);
        $('#bg').fadeIn(100,function(){
            $('#alerts').fadeIn(200);
        });

    }
    else {

        $('#bg').fadeIn(100);
        $('#wait').fadeIn(100);
        $.post("index.php/regPayRq", {
                amount		:	amount,
                description	:	description,
                _token  : $('#_token').val(),
            },
            function(data){
                $('#AdminDiv').html(data);
                $("body").removeClass("modal-open");
                $('.modal-backdrop').fadeOut(100);
                $('#bg').fadeOut(100);
                $('#wait').fadeOut(100);
            });
    }
}
function cities(id){
    //$('#wait').fadeIn(100);
    $.post("index.php/cities", {
            id     : id,
            _token  : $('#_token').val(),
        },
        function(data){

            if ( data ){

                $('#cities').html(data);
               // $('#wait').fadeOut(100);
            }//  2pm
        });
}
function rankChecker(i){
    $.get("index.php/google?start="+i);
    i++;
    randT = Math.floor((Math.random() * 10) + 1) + 23;
    setTimeout(function(){ rankChecker(i); }, randT*1000);
}
function checkEmail(email){

    $('#wait').fadeIn(100);
    $.post("index.php/checkEmail", {
            email     : email,
            _token : $('#_token').val(),
        },
        function(data){



                $('#emailC').val(data);
                // $('#wait').fadeOut(100);
            //  2pm
        },"json");
}
function checkUrl(url){
    //$('#wait').fadeIn(100);
    $.post("index.php/checkUrl", {
            url     : url,
            _token : $('#_token').val(),
        },
        function(data){



            $('#urlC').val(data);
            // $('#wait').fadeOut(100);
            //  2pm
        },"json");
}
function checkMobile(mobile){
    //$('#wait').fadeIn(100);
    $.post("index.php/checkMobile", {
            mobile     : mobile,
            _token : $('#_token').val(),
        },
        function(data){



            $('#mobileC').val(data);
            // $('#wait').fadeOut(100);
            //  2pm
        },"json");
}
function regPartner() {
			var msg = '';
			var emC = validate($('#email').val());
			if ( $('#name').val() == '' ){
				$('#name').focus();
				msg = 'نام وارد نشده';
			}
			else if ( $('#family').val() == '' ){
				$('#family').focus();
				msg = 'نام خانوادگی وارد نشده';
			}
            else if ( $('#tel').val() == '' ){
                $('#tel').focus();
                msg = 'شماره تلفن ثابت وارد نشده';
            }
            else if ( $('#mobile').val() == '' ){
                $('#mobile').focus();
                msg = 'شماره تلفن همراه وارد نشده';
            }
			else if ( $('#email').val() == '' ){
				$('#email').focus();
				msg = 'نشانی ایمیل وارد نشده';
			}
            else if ( emC == false ){
                $('#email').focus();
                msg = 'نشانی ایمیل وارد شده، نامعتبر است';
            }
            else if ( $('#emailC').val() == '0' ){
                msg = 'نشانی ایمیل وارد شده، صحیح نبوده یا تکراری است';
            }
			else if ( $('#password').val() == '' ){
				$('#password').focus();
				msg = 'رمز عبور وارد نشده';
			}			

			else if ( $('#n_code').val() == '' ){
				$('#n_code').focus();
				msg = 'شماره ملی وارد نشده';
			}
			else if ( $('#frmCheck').val() == '0' ){
						msg = 'شماره ملی وارد شده، صحیح نبوده یا تکراری است';
			}

			else if ( $('#card_num').val() == '' ){
				$('#card_num').focus();
				msg = 'شماره کارت شتاب وارد نشده';
			}
            else if ( $('#card_num').val().length < '16' ){
                $('#card_num').focus();
                msg = 'شماره کارت شتاب وارد شده، صحیح نیست';
            }



			
			if ( msg != '' ){
					$('#m_ch').html(msg);

					
			}
			else {
				 
				$('#bg').fadeIn(100);
			$('#wait').fadeIn(100);
		      $.post("index.php/regPartner", {
					name         : $('#name').val(),
			  		family       : $('#family').val(),
					pro_id       : $('#pro_id').val(),
					city_id      : $('#city_id').val(),
					email        : $('#email').val(),
					n_code       : $('#n_code').val(),
					password     : $('#password').val(),
					tel			 : $('#tel').val(),
					mobile		 : $('#mobile').val(),
					card_num     : $('#card_num').val(),
					_token       : $('#_token').val(),
					
									
					
			   },
		 function(data){
             document.location = "/partners";
		
		
		 });
											
									
	  
		
			}
}
function regCustomer() {
    var msg = '';

    if ( $('#name').val() == '' ){
        $('#name').focus();
        msg = 'نام وارد نشده';
    }
    else if ( $('#family').val() == '' ){
        $('#family').focus();
        msg = 'نام خانوادگی وارد نشده';
    }
    else if ( $('#tel').val() == '' ){
        $('#tel').focus();
        msg = 'شماره تلفن ثابت وارد نشده';
    }
    else if ( $('#mobile').val() == '' ){
        $('#mobile').focus();
        msg = 'شماره تلفن همراه وارد نشده';
    }
    else if ( $('#mobileC').val() == '0' ){
        msg = 'شماره تلفن همراه وارد شده، صحیح نبوده یا تکراری است';
    }
    else if ( $('#password').val() == '' ){
        $('#password').focus();
        msg = 'رمز عبور وارد نشده';
    }
    else if ( $('#addr').val() == '' ){
        $('#addr').focus();
        msg = 'نشانی وارد نشده';
    }
    else if ( $('#p_code').val() == '' ){
        $('#p_code').focus();
        msg = 'کدپستی وارد نشده';
    }
	if ( msg != '' ){
        $('#m_ch').html(msg);


    }
    else {

        $('#bg').fadeIn(100);
        $('#wait').fadeIn(100);
        $.post("index.php/regCustomer", {
                name         : $('#name').val(),
                family       : $('#family').val(),
                pro_id       : $('#pro_id').val(),
                city_id      : $('#city_id').val(),
              	password     : $('#password').val(),
                tel			 : $('#tel').val(),
                addr		 : $('#addr').val(),
                mobile		 : $('#mobile').val(),
                p_code		 : $('#p_code').val(),
                _token       : $('#_token').val(),



            },
            function(data){
                document.location = "/";

            });




    }
}
function regOrder() {
    var msg = '';
    if ( $('#tel').val() == '' ){
        $('#tel').focus();
        msg = 'شماره تلفن ثابت وارد نشده';
    }

    else if ( $('#addr').val() == '' ){
        $('#addr').focus();
        msg = 'نشانی وارد نشده';
    }
    else if ( $('#p_code').val() == '' ){
        $('#p_code').focus();
        msg = 'کدپستی وارد نشده';
    }
    if ( msg != '' ){
        $('#m_ch').html(msg);


    }
    else {

        $('#bg').fadeIn(100);
        $('#wait').fadeIn(100);
        $.post("index.php/regOrder", {
                pro_id       : $('#pro_id').val(),
                city_id      : $('#city_id').val(),
                tel			 : $('#tel').val(),
                addr		 : $('#addr').val(),
                count		 : $('#count').val(),
                p_code		 : $('#p_code').val(),
                _token       : $('#_token').val(),



            },
            function(data){
                $('#orderRep').html(data);
                $('#bg').fadeOut(100);
                $('#wait').fadeOut(100);

            });




    }
}
function registerCardP() {
    var msg = '';
    if ( $('#pay_date').val() == '' ){
        $('#pay_date').focus();
        msg = 'تاریخ پرداخت وارد نشده';
    }

    else if ( $('#tran_id').val() == '' ){
        $('#tran_id').focus();
        msg = 'شماره ارجاع وارد نشده';
    }

    if ( msg != '' ){
        $('#m_ch').html(msg);


    }
    else {

        $('#bg').fadeIn(100);
        $('#wait').fadeIn(100);
        $.post("index.php/regCardP", {
                pay_time     : $('#payH').val()+':'+$('#payM').val(),
                pay_date     : $('#pay_date').val(),
                tran_id		 : $('#tran_id').val(),
                amount		 : $('#amount').val(),
                _token       : $('#_token').val(),



            },
            function(data){
                $('#cardPDiv').html(data);
                $('#bg').fadeOut(100);
                $('#wait').fadeOut(100);

            });




    }
}
function onlinePay() {


        $('#bg').fadeIn(100);
        $('#wait').fadeIn(100);
        $.post("index.php/onlinePay", {
                _token       : $('#_token').val(),



            },
            function(data){
                if (data.status){
                    document.location = "https://www.zarinpal.com/pg/StartPay/"+data.Authority;
                }

            },'json');





}
function regPayRqRes(id) {
    var msg = '';
    if ( $('#m_resp').val() == '' ){
        $('#m_resp').focus();
        msg = 'توضیحات وارد نشده';
    }
    else if ( $('#pay_date').val() == '' ){
        $('#pay_date').focus();
        msg = 'تاریخ پرداخت وارد نشده';
    }
    else if ( $('#tran_id').val() == '' ){
        $('#tran_id').focus();
        msg = 'شماره ارجاع وارد نشده';
    }

    if ( msg != '' ){
        $('#m_ch').html(msg);


    }
    else {

        $('#bg').fadeIn(100);
        $('#wait').fadeIn(100);
        $.post("index.php/admin/regPayRqRes", {
                last_status  : $('#last_status').val(),
                m_resp       : $('#m_resp').val(),
                pay_time     : $('#payH').val()+':'+$('#payM').val(),
                pay_date     : $('#pay_date').val(),
                tran_id		 : $('#tran_id').val(),
                amount		 : $('#amount').val(),
                id		     : id,
                _token       : $('#_token').val(),



            },
            function(data){
                $('#AdminDiv').html(data);
                $("body").removeClass("modal-open");
                $('.modal-backdrop').fadeOut(100);
                $('#bg').fadeOut(100);
                $('#wait').fadeOut(100);

            });




    }
}
function loginPartner() {
    var msg = '';
    var emC = validate($('#emailLogin').val());
    if ( $('#emailLogin').val() == '' ){
        $('#emailLogin').focus();
        msg = 'نشانی ایمیل وارد نشده';
    }
    else if ( emC == false ){
        $('#emailLogin').focus();
        msg = 'نشانی ایمیل وارد شده، نامعتبر است';
    }
    else if ( $('#passwordLogin').val() == '' ){
        $('#passwordLogin').focus();
        msg = 'رمز عبور وارد نشده';
    }
    if ( msg != '' ){
        $('#m_ch1').html(msg);


    }
    else {

        $('#bg').fadeIn(100);
        $('#wait').fadeIn(100);
        $.post("index.php/loginPartner", {

                email        : $('#emailLogin').val(),
                password     : $('#passwordLogin').val(),
                _token       : $('#_token').val(),



            },
            function(data){
                if ( data.status ){
                    document.location = "/partners";
                }
                else {
                    $('#m_ch1').html('ورود ناموفق، نام کاربری و رمز عبور صحیح نیست');
                    $('#bg').fadeOut(100);
                    $('#wait').fadeOut(100);

                }

            }, 'json');




    }
}
function loginCustomer() {
    var msg = '';
    if ( $('#mobileLogin').val() == '' ){
        $('#mobileLogin').focus();
        msg = 'شماره تلفن همراه  وارد نشده';
    }

    else if ( $('#passwordLogin').val() == '' ){
        $('#passwordLogin').focus();
        msg = 'رمز عبور وارد نشده';
    }
    if ( msg != '' ){
        $('#m_ch1').html(msg);


    }
    else {

        $('#bg').fadeIn(100);
        $('#wait').fadeIn(100);
        $.post("index.php/loginCustomer", {

                mobile       : $('#mobileLogin').val(),
                password     : $('#passwordLogin').val(),
                _token       : $('#_token').val(),



            },
            function(data){
                if ( data.status ){
                    document.location = "/";
                }
                else {
                    $('#m_ch1').html('ورود ناموفق، نام کاربری و رمز عبور صحیح نیست');
                    $('#bg').fadeOut(100);
                    $('#wait').fadeOut(100);

                }

            }, 'json');




    }
}
function regPcard() {
    var msg = '';
    if ( $('#mobileLogin1').val() == '' ){
        $('#mobileLogin1').focus();
        msg = ' شماره تلفن همراه وارد نشده';
    }

    else if ( $('#passwordLogin').val() == '' ){
        $('#passwordLogin').focus();
        msg = 'رمز عبور وارد نشده';
    }
    else if ( $('#tran_id').val() == '' ){
        $('#tran_id').focus();
        msg = 'کدرهگیری - شماره ارجاع وارد نشده';
    }
    if ( msg != '' ){
        $('#m_ch2').html(msg);


    }
    else {

        $('#bg').fadeIn(100);
        $('#wait').fadeIn(100);
        $.post("index.php/loginCustomer", {

                mobile       : $('#mobileLogin').val(),
                password     : $('#passwordLogin').val(),
                _token       : $('#_token').val(),



            },
            function(data){
                if ( data.status ){
                    document.location = "/regPcard";
                }
                else {
                    $('#m_ch2').html('ورود ناموفق، نام کاربری و رمز عبور صحیح نیست');
                    $('#bg').fadeOut(100);
                    $('#wait').fadeOut(100);

                }

            }, 'json');




    }
}
function changeCardp(id,status){
    if (status != '0'){
        $('html, body').animate({ scrollTop: 0 }, 1000);
        $('#bg').fadeIn(100);
        $('#wait').fadeIn(100);
        $.post('index.php/admin/changeCardp', {
                _token           : $('#_token').val(),
                id               : id,
                status           : status
            },
            function(data){

                if ( data ){
                    $('#AdminDiv').html(data);
                    $('#bg').fadeOut(100);
                    $('#wait').fadeOut(100);
                }//  2pm
            });

    }

}
function searchDec(){
  			$('#bg').fadeIn(100);
			$('#wait').fadeIn(100);
			$.post("decedent/searchDec", { 
					  		gender   :  $('#gender').val(),
							wcolumn  :  $('#wcolumn').val(),
							orderBy  :  $('#orderBy').val(),
							verb     :  $('#verb').val(),
							decStart :  $('#decStart').val(),
							decEnd   :  $('#decEnd').val(),
							_token       : $('#_token').val(),
					   },
				 function(data){
					 $('#searchResult').html(data);
					 $('#bg').fadeOut(100);
			  		 $('#wait').fadeOut(100);});	
}


function editDead() {
			var msg = '';
			d_date = $('#d_date').val();
			ddate = d_date.split('/'); 
			int_date = $('#int_date').val();
			intdate = int_date.split('/'); 
			if ( $('#name').val() == '' ){
				$('#name').focus();
				msg = 'نام وارد نشده';
			}
			else if ( $('#family').val() == '' ){
				$('#family').focus();
				msg = 'نام خانوادگی وارد نشده';
			}
			else if ( $('#f_name').val() == '' ){
				$('#f_name').focus();
				msg = 'نام پدر وارد نشده';
			}			
			/*else if ( $('#m_name').val() == '' ){
				$('#m_name').focus();
				msg = 'نام مادر وارد نشده';
			}*/
			else if ( $('#nationality').val() == '' ){
				$('#nationality').focus();
				msg = 'ملیت شغل وارد نشده';
			}
			else if ( $('#n_code').val() == '' ){
				$('#n_code').focus();
				msg = 'شماره ملی وارد نشده';
			}/*
			else if ( $('#frmCheck').val() == '0' ){
						msg = 'شماره ملی وارد شده، صحیح نبوده یا تکراری است';
			}
			else if ( $('#b_num').val() == '' ){
				$('#b_num').focus();
				msg = 'شماره شناسنامه وارد نشده';
			}
			else if ( $('#b_location').val() == '' ){
				$('#b_location').focus();
				msg = 'محل صدور وارد نشده';
			}*/
			else if ( $('#b_date').val() == '' ){
				$('#b_date').focus();
				msg = 'تاریخ تولد وارد نشده';
			}
			/*else if ( $('#age').val() == '' ){
				$('#age').focus();
				msg = 'سن وارد نشده';
			}
			else if ( $('#tel').val() == '' ){
				$('#tel').focus();
				msg = 'شماره تماس وارد نشده';
			}
			else if ( $('#tel').val() < 02199999999 ){
				$('#tel').focus();
				msg = 'شماره تماس وارد شده صحیح نیست';
			}
			/*else if ( $('#city').val() == '' ){
				$('#city').focus();
				msg = 'شهر محل سکونت وارد نشده';
			}
			else if ( $('#zipcode').val() == '' ){
				$('#zipcode').focus();
				msg = 'کدپستی وارد نشده';
			}*/
			else if ( $('#d_date').val() == '' ){
				$('#d_date').focus();
				msg = 'تاریخ فوت وارد نشده';
			}
			else if ( $('#int_date').val() == '' ){
				$('#int_date').focus();
				msg = 'تاریخ ثبت وارد نشده';
			}
			else if ( intdate < ddate ){
				$('#int_date').focus();
				msg = 'تاریخ ثبت و تاریخ فوت، صحیح نیست';
			}
			/*else if ( $('#d_reason').val() == '' ){
				$('#d_reason').focus();
				msg = 'علت فوت وارد نشده';
			}*/
			else if ( $('#fridge_num').val() == '' ){
				msg = 'شماره سردخانه وارد نشده';
			}
			else if ( $('#reg_num').val() == '' ){
				$('#reg_num').focus();
				msg = 'شماره ثبت دفتری وارد نشده';
			}
			else if ( $('#regOk').val() == '0' ){
				$('#reg_num').focus();
				msg = 'شماره ثبت دفتری وارد شده، تکراری و نامعتبر است';
			}
			/*else if ( $('#regCheck').val() == '0' ){
						msg = 'شماره سردخانه وارد شده تکراری و نامعتبر است';
			}*/
			
			if ( msg != '' ){
					$('#err_msg').html(msg);
					$('#bg').fadeIn(100,function(){
												$('#alerts').fadeIn(200); 
												 });
					
			}
			else {
				 
			$('#wait').fadeIn(100);
		      $.post("decedent/decEdit", { 
					gender       : $('#gender_edit').val(),
					name         : $('#name').val(),
			  		family       : $('#family').val(),
					f_name       : $('#f_name').val(),
					m_name       : $('#m_name').val(),
					nationality  : $('#nationality').val(),
					n_code       : $('#n_code').val(),
					b_num        : $('#b_num').val(),
					b_location   : $('#b_location').val(),
					sh_serial    : $('#sh_serial').val(),
					sh_series    : $('#sh_series').val(),
					b_date       : $('#b_date').val(),
					age          : $('#age').val(),
					job          : $('#job').val(),
					tel          : $('#tel').val(),
					mobile       : $('#mobile').val(),
					addr         : $('#addr').val(),
					zipcode      : $('#zipcode').val(),
					d_date       : $('#d_date').val(),
					d_date_status: $('#d_date_status').val(),
					int_date     : $('#int_date').val(),
					d_place      : $('#d_place').val(),
					d_reason     : $('#d_reason').val(),
					disease      : $('#disease').val(),
					hos_dc       : $('#hos_dc').val(),
					fridge_num   : $('#fridge_num').val(),
					burial       : $('#burial').val(),
					burial_p     : $('#burial_p').val(),
					driver       : $('#driver').val(),
					add_txt      : $('#add_txt').val(),
					reg_num      : $('#reg_num').val(),
					discription  : $('#discription').val(),
					id           : $('#deadIdEd').val(),
					_token       : $('#_token').val(),
					
									
					
			   },
		 function(data){  
		 
			
			$('#err_msg').html('اطلاعات متوفی با موفقیت به روز رسانی شد');
			
					$('#bg').fadeIn(100,function(){
												$('#alerts').fadeIn(200); 
												 });
						 
		 
			  $('#wait').fadeOut(100);
			   $("body").removeClass("modal-open");
			 $('.modal-backdrop').fadeOut(100);
			  postMenus('decedent/decList');
		
		
		 });
											
									
	  
		
			}
}
function deleteDec(id){
		
				 
			$('#wait').fadeIn(100);
		      $.post("decedent/deleteDec", { 
					id      : id,
					_token  : $('#_token').val(),
			   },
		 function(data){
			 postMenus('decedent/decList');
			 $("body").removeClass("modal-open");
			 $('.modal-backdrop').fadeOut(100);
			 	
			
	  		 $('#wait').fadeOut(100);
			 });
		
}