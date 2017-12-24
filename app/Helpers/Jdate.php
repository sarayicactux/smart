<?php

namespace App\Helpers;

class Jdate
{
    //
	public static  function fn($m)
{
	$p = "";
	$startpos = 0;
	$endpos = -1;
	
	while (true)
	{
		if ($endpos == -1)
			$startpos = strpos($m, "<");
		else
			$startpos = strpos($m, "<", $endpos);
		if ($startpos === false)
		{
			$startpos = strlen($m);
			$p .= self::str2fn(substr($m, $endpos + 1, $startpos - $endpos - 1));
			break;
		}
		$p .= self::str2fn(substr($m, $endpos+1, $startpos - $endpos -1));
		$endpos = strpos($m, ">", $startpos);
		$p .= substr($m, $startpos , $endpos - $startpos + 1);
	}
	return $p;
}

public static  function str2fn($m)
{
	$m=str_replace("1","۱",$m);
	$m=str_replace("2","۲",$m);
	$m=str_replace("3","۳",$m);
	$m=str_replace("4","۴",$m);
	$m=str_replace("5","۵",$m);
	$m=str_replace("6","۶",$m);
	$m=str_replace("7","۷",$m);
	$m=str_replace("8","۸",$m);
	$m=str_replace("9","۹",$m);
	$m=str_replace("0","۰",$m);
	return $m;
}
	
public static  function reverseFN($m)
{
	$m=str_replace("۱","1",$m);
	$m=str_replace("۲","2",$m);
	$m=str_replace("۳","3",$m);
	$m=str_replace("۴","4",$m);
	$m=str_replace("۵","5",$m);
	$m=str_replace("۶","6",$m);
	$m=str_replace("۷","7",$m);
	$m=str_replace("۸","8",$m);
	$m=str_replace("۹","9",$m);
	$m=str_replace("۰","0",$m);
	return $m;

}
 
 public static  function medate(){
  function div11($a,$b) {
    return (int) ($a / $b);
}

 function persianDate ($g_y, $g_m, $g_d)
{
    $g_days_in_month = array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
    $j_days_in_month = array(31, 31, 31, 31, 31, 31, 30, 30, 30, 30, 30, 29);


   $gy = $g_y-1600;
   $gm = $g_m-1;
   $gd = $g_d-1;

   $g_day_no = 365*$gy+div11($gy+3,4)-div11($gy+99,100)+div11($gy+399,400);

   for ($i=0; $i < $gm; ++$i)
      $g_day_no += $g_days_in_month[$i];
   if ($gm>1 && (($gy%4==0 && $gy%100!=0) || ($gy%400==0)))
      /* leap and after Feb */
      $g_day_no++;
   $g_day_no += $gd;

   $j_day_no = $g_day_no-79;

   $j_np = div11($j_day_no, 12053); /* 12053 = 365*33 + 32/4 */
   $j_day_no = $j_day_no % 12053;

   $jy = 979+33*$j_np+4*div11($j_day_no,1461); /* 1461 = 365*4 + 4/4 */

   $j_day_no %= 1461;

   if ($j_day_no >= 366) {
      $jy += div11($j_day_no-1, 365);
      $j_day_no = ($j_day_no-1)%365;
   }

   for ($i = 0; $i < 11 && $j_day_no >= $j_days_in_month[$i]; ++$i)
      $j_day_no -= $j_days_in_month[$i];
   $jm = $i+1;
   $jd = $j_day_no+1;
   $arr = array();
   $arr["y"] = $jy;
   $arr["m"] = $jm;
   $arr["d"] = $jd;
   	return $arr;
}
date_default_timezone_set('Asia/Tehran');
//$script_tz = date_default_timezone_get();
$dategeo = getdate();
$date1 = persianDate($dategeo["year"], $dategeo["mon"], $dategeo["mday"]);
$georgmonth = $dategeo["mon"];
$gday = $dategeo["mday"];
$gyear = $dategeo["year"];
$gmonth = "";
switch($georgmonth)
{
	case "1" : $gmonth = " &#1688;&#1575;&#1606;&#1608;&#1740;&#1607; "; break;
	case "2" : $gmonth = " &#1601;&#1608;&#1585;&#1740;&#1607; "; break;
	case "3" : $gmonth = " &#1605;&#1575;&#1585;&#1587; "; break;
	case "4" : $gmonth = " &#1570;&#1662;&#1585;&#1740;&#1604; "; break;
	case "5" : $gmonth = " &#1605;&#1740; "; break;
	case "6" : $gmonth = " &#1688;&#1608;&#1617;&#1606; "; break;
	case "7" : $gmonth = " &#1580;&#1608;&#1604;&#1575;&#1740; "; break;
	case "8" : $gmonth = " &#1570;&#1711;&#1608;&#1587;&#1578; "; break;
	case "9" : $gmonth = "  &#1587;&#1662;&#1578;&#1575;&#1605;&#1576;&#1585;"; break;
	case "10" : $gmonth = " &#1575;&#1705;&#1578;&#1576;&#1585; "; break;
	case "11" : $gmonth = " &#1606;&#1608;&#1575;&#1605;&#1576;&#1585; "; break;
	case "12" : $gmonth = " &#1583;&#1587;&#1575;&#1605;&#1576;&#1585; "; break;
}

$shmonth1 = $date1["m"];
$shmonth = "";
$shday = $date1["d"];
$shyear = $date1["y"];
switch($shmonth1)
{
	case "1" : $shmonth = " &#1601;&#1585;&#1608;&#1585;&#1583;&#1740;&#1606; "; break;
	case "2" : $shmonth = " &#1575;&#1585;&#1583;&#1740;&#1576;&#1607;&#1588;&#1578; "; break;
	case "3" : $shmonth = " &#1582;&#1585;&#1583;&#1575;&#1583; "; break;
	case "4" : $shmonth = " &#1578;&#1740;&#1585; "; break;
	case "5" : $shmonth = " &#1605;&#1585;&#1583;&#1575;&#1583; "; break;
	case "6" : $shmonth = " &#1588;&#1607;&#1585;&#1740;&#1608;&#1585; "; break;
	case "7" : $shmonth = " &#1605;&#1607;&#1585; "; break;
	case "8" : $shmonth = " &#1570;&#1576;&#1575;&#1606; "; break;
	case "9" : $shmonth = " &#1570;&#1584;&#1585; "; break;
	case "10" : $shmonth = " &#1583;&#1740; "; break;
	case "11" : $shmonth = " &#1576;&#1607;&#1605;&#1606; "; break;
	case "12" : $shmonth = " &#1575;&#1587;&#1601;&#1606;&#1583; "; break;
}

// create array for persian months
$smonth = array();
$smonth[1] = "فروردين"; 
$smonth[2] = " ارديبهشت "; 
$smonth[3] = " خرداد "; 
$smonth[4] = " تير";
$smonth[5] = " مرداد "; 
$smonth[6] = " شهريور "; 
$smonth[7] = " مهر "; 
$smonth[8] = " آبان "; 
$smonth[9] = " آذر "; 
$smonth[10] = " دي "; 
$smonth[11] = " بهمن "; 
$smonth[12] = " اسفند "; 

// create array for persian days
$nameOfDay = array();
$nameOfDay['Sunday'] = "يك شنبه";
$nameOfDay['Monday'] = "دوشنبه";
$nameOfDay['Tuesday'] = "سه شنبه";
$nameOfDay['Wednesday'] = "چهار شنبه";
$nameOfDay['Thursday'] = "پنج شنبه";
$nameOfDay['Friday'] = "جمعه";
$nameOfDay['Saturday'] = "شنبه";

// create array for months days
$daysInPersianMonth = array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
$daysInGlobalMonth = array(31, 31, 31, 31, 31, 31, 30, 30, 30, 30, 30, 29);

$numOfDay = date('l');
//$numOfDay = date('F');
$nameOfToday = $nameOfDay[date('l')]; // persian name of to day
 
$today="  ";

$m = $smonth[$date1["m"]];

$d = $date1["d"];
$y = $date1["y"];
$p= $nameOfDay[$numOfDay];
$date2 = $p.$d.$m.$y;
$date=$y."/".$date1["m"]."/".$d;
$date4 = $today.$nameOfToday." ".$d.$m.$y;
 $rt['date2'] = $date2;
 $rt['date']  = $date;
 $rt['date4'] = $date4;
 $rt['ymd']   = $date1;
 return $rt;
 }
 function jdate($format,$timestamp='',$none='',$time_zone='Asia/Tehran',$tr_num='fa'){

 $T_sec=0;/* <= رفع خطاي زمان سرور ، با اعداد '+' و '-' بر حسب ثانيه */

 if($time_zone!='local')date_default_timezone_set(($time_zone=='')?'Asia/Tehran':$time_zone);
 $ts=($timestamp=='' or $timestamp=='now')?time()+$T_sec:tr_num($timestamp)+$T_sec;
 $date=explode('_',date('H_i_j_n_O_P_s_w_Y',$ts));
 list($j_y,$j_m,$j_d)=gregorian_to_jalali($date[8],$date[3],$date[2]);
 $doy=($j_m<7)?(($j_m-1)*31)+$j_d-1:(($j_m-7)*30)+$j_d+185;
 $kab=($j_y%33%4-1==(int)($j_y%33*.05))?1:0;
 $sl=strlen($format);
 $out='';
 for($i=0; $i<$sl; $i++){
  $sub=substr($format,$i,1);
  if($sub=='\\'){
	$out.=substr($format,++$i,1);
	continue;
  }
  switch($sub){

	case'C':case'E':case'R':case'x':case'X':
	$out.='نسخه ی جدید : http://jdf.scr.ir';
	break;

	case'B':case'e':case'g':
	case'G':case'h':case'I':
	case'T':case'u':case'Z':
	$out.=date($sub,$ts);
	break;

	case'a':
	$out.=($date[0]<12)?'ق.ظ':'ب.ظ';
	break;

	case'A':
	$out.=($date[0]<12)?'قبل از ظهر':'بعد از ظهر';
	break;

	case'b':
	$out.=(int)(1+($j_m/3));
	break;

	case'c':
	$out.=$j_y.'/'.$j_m.'/'.$j_d.' ،'.$date[0].':'.$date[1].':'.$date[6].' '.$date[5];
	break;

	case'd':
	$out.=($j_d<10)?'0'.$j_d:$j_d;
	break;

	case'D':
	$out.=jdate_words(array('kh'=>$date[7]),' ');
	break;

	case'f':
	$out.=jdate_words(array('ff'=>$j_m),' ');
	break;

	case'F':
	$out.=jdate_words(array('mm'=>$j_m),' ');
	break;

	case'H':
	$out.=$date[0];
	break;

	case'i':
	$out.=$date[1];
	break;

	case'j':
	$out.=$j_d;
	break;

	case'J':
	$out.=jdate_words(array('rr'=>$j_d),' ');
	break;

	case'k';
	$out.=tr_num(100-(int)($doy/($kab+365)*1000)/10,$tr_num);
	break;

	case'K':
	$out.=tr_num((int)($doy/($kab+365)*1000)/10,$tr_num);
	break;

	case'l':
	$out.=jdate_words(array('rh'=>$date[7]),' ');
	break;

	case'L':
	$out.=$kab;
	break;

	case'm':
	$out.=($j_m>9)?$j_m:'0'.$j_m;
	break;

	case'M':
	$out.=jdate_words(array('km'=>$j_m),' ');
	break;

	case'n':
	$out.=$j_m;
	break;

	case'N':
	$out.=$date[7]+1;
	break;

	case'o':
	$jdw=($date[7]==6)?0:$date[7]+1;
	$dny=364+$kab-$doy;
	$out.=($jdw>($doy+3) and $doy<3)?$j_y-1:(((3-$dny)>$jdw and $dny<3)?$j_y+1:$j_y);
	break;

	case'O':
	$out.=$date[4];
	break;

	case'p':
	$out.=jdate_words(array('mb'=>$j_m),' ');
	break;

	case'P':
	$out.=$date[5];
	break;

	case'q':
	$out.=jdate_words(array('sh'=>$j_y),' ');
	break;

	case'Q':
	$out.=$kab+364-$doy;
	break;

	case'r':
	$key=jdate_words(array('rh'=>$date[7],'mm'=>$j_m));
	$out.=$date[0].':'.$date[1].':'.$date[6].' '.$date[4]
	.' '.$key['rh'].'، '.$j_d.' '.$key['mm'].' '.$j_y;
	break;

	case's':
	$out.=$date[6];
	break;

	case'S':
	$out.='ام';
	break;

	case't':
	$out.=($j_m!=12)?(31-(int)($j_m/6.5)):($kab+29);
	break;

	case'U':
	$out.=$ts;
	break;

	case'v':
	 $out.=jdate_words(array('ss'=>substr($j_y,2,2)),' ');
	break;

	case'V':
	$out.=jdate_words(array('ss'=>$j_y),' ');
	break;

	case'w':
	$out.=($date[7]==6)?0:$date[7]+1;
	break;

	case'W':
	$avs=(($date[7]==6)?0:$date[7]+1)-($doy%7);
	if($avs<0)$avs+=7;
	$num=(int)(($doy+$avs)/7);
	if($avs<4){
	 $num++;
	}elseif($num<1){
	 $num=($avs==4 or $avs==(($j_y%33%4-2==(int)($j_y%33*.05))?5:4))?53:52;
	}
	$aks=$avs+$kab;
	if($aks==7)$aks=0;
	$out.=(($kab+363-$doy)<$aks and $aks<3)?'01':(($num<10)?'0'.$num:$num);
	break;

	case'y':
	$out.=substr($j_y,2,2);
	break;

	case'Y':
	$out.=$j_y;
	break;

	case'z':
	$out.=$doy;
	break;

	default:$out.=$sub;
  }
 }
 return($tr_num!='en')?tr_num($out,'fa','.'):$out;
}

/*	F	*/
function jstrftime($format,$timestamp='',$none='',$time_zone='Asia/Tehran',$tr_num='fa'){

 $T_sec=0;/* <= رفع خطاي زمان سرور ، با اعداد '+' و '-' بر حسب ثانيه */

 if($time_zone!='local')date_default_timezone_set(($time_zone=='')?'Asia/Tehran':$time_zone);
 $ts=($timestamp=='' or $timestamp=='now')?time()+$T_sec:tr_num($timestamp)+$T_sec;
 $date=explode('_',date('h_H_i_j_n_s_w_Y',$ts));
 list($j_y,$j_m,$j_d)=gregorian_to_jalali($date[7],$date[4],$date[3]);
 $doy=($j_m<7)?(($j_m-1)*31)+$j_d-1:(($j_m-7)*30)+$j_d+185;
 $kab=($j_y%33%4-1==(int)($j_y%33*.05))?1:0;
 $sl=strlen($format);
 $out='';
 for($i=0; $i<$sl; $i++){
  $sub=substr($format,$i,1);
  if($sub=='%'){
	$sub=substr($format,++$i,1);
  }else{
	$out.=$sub;
	continue;
  }
  switch($sub){

	/* Day */
	case'a':
	$out.=jdate_words(array('kh'=>$date[6]),' ');
	break;

	case'A':
	$out.=jdate_words(array('rh'=>$date[6]),' ');
	break;

	case'd':
	$out.=($j_d<10)?'0'.$j_d:$j_d;
	break;

	case'e':
	$out.=($j_d<10)?' '.$j_d:$j_d;
	break;

	case'j':
	$out.=str_pad($doy+1,3,0,STR_PAD_LEFT);
	break;

	case'u':
	$out.=$date[6]+1;
	break;

	case'w':
	$out.=($date[6]==6)?0:$date[6]+1;
	break;

	/* Week */
	case'U':
	$avs=(($date[6]<5)?$date[6]+2:$date[6]-5)-($doy%7);
	if($avs<0)$avs+=7;
	$num=(int)(($doy+$avs)/7)+1;
	if($avs>3 or $avs==1)$num--;
	$out.=($num<10)?'0'.$num:$num;
	break;

	case'V':
	$avs=(($date[6]==6)?0:$date[6]+1)-($doy%7);
	if($avs<0)$avs+=7;
	$num=(int)(($doy+$avs)/7);
	if($avs<4){
	 $num++;
	}elseif($num<1){
	 $num=($avs==4 or $avs==(($j_y%33%4-2==(int)($j_y%33*.05))?5:4))?53:52;
	}
	$aks=$avs+$kab;
	if($aks==7)$aks=0;
	$out.=(($kab+363-$doy)<$aks and $aks<3)?'01':(($num<10)?'0'.$num:$num);
	break;

	case'W':
	$avs=(($date[6]==6)?0:$date[6]+1)-($doy%7);
	if($avs<0)$avs+=7;
	$num=(int)(($doy+$avs)/7)+1;
	if($avs>3)$num--;
	$out.=($num<10)?'0'.$num:$num;
	break;

	/* Month */
	case'b':
	case'h':
	$out.=jdate_words(array('km'=>$j_m),' ');
	break;

	case'B':
	$out.=jdate_words(array('mm'=>$j_m),' ');
	break;

	case'm':
	$out.=($j_m>9)?$j_m:'0'.$j_m;
	break;

	/* Year */
	case'C':
	$out.=substr($j_y,0,2);
	break;

	case'g':
	$jdw=($date[6]==6)?0:$date[6]+1;
	$dny=364+$kab-$doy;
	$out.=substr(($jdw>($doy+3) and $doy<3)?$j_y-1:(((3-$dny)>$jdw and $dny<3)?$j_y+1:$j_y),2,2);
	break;	

	case'G':
	$jdw=($date[6]==6)?0:$date[6]+1;
	$dny=364+$kab-$doy;
	$out.=($jdw>($doy+3) and $doy<3)?$j_y-1:(((3-$dny)>$jdw and $dny<3)?$j_y+1:$j_y);
	break;

	case'y':
	$out.=substr($j_y,2,2);
	break;

	case'Y':
	$out.=$j_y;
	break;

	/* Time */
	case'H':
	$out.=$date[1];
	break;

	case'I':
	$out.=$date[0];
	break;

	case'l':
	$out.=($date[0]>9)?$date[0]:' '.(int)$date[0];
	break;

	case'M':
	$out.=$date[2];
	break;

	case'p':
	$out.=($date[1]<12)?'قبل از ظهر':'بعد از ظهر';
	break;

	case'P':
	$out.=($date[1]<12)?'ق.ظ':'ب.ظ';
	break;

	case'r':
	$out.=$date[0].':'.$date[2].':'.$date[5].' '.(($date[1]<12)?'قبل از ظهر':'بعد از ظهر');
	break;

	case'R':
	$out.=$date[1].':'.$date[2];
	break;

	case'S':
	$out.=$date[5];
	break;

	case'T':
	$out.=$date[1].':'.$date[2].':'.$date[5];
	break;

	case'X':
	$out.=$date[0].':'.$date[2].':'.$date[5];
	break;

	case'z':
	$out.=date('O',$ts);
	break;

	case'Z':
	$out.=date('T',$ts);
	break;

	/* Time and Date Stamps */
	case'c':
	$key=jdate_words(array('rh'=>$date[6],'mm'=>$j_m));
	$out.=$date[1].':'.$date[2].':'.$date[5].' '.date('P',$ts)
	.' '.$key['rh'].'، '.$j_d.' '.$key['mm'].' '.$j_y;
	break;

	case'D':
	$out.=substr($j_y,2,2).'/'.(($j_m>9)?$j_m:'0'.$j_m).'/'.(($j_d<10)?'0'.$j_d:$j_d);
	break;

	case'F':
	$out.=$j_y.'-'.(($j_m>9)?$j_m:'0'.$j_m).'-'.(($j_d<10)?'0'.$j_d:$j_d);
	break;

	case's':
	$out.=$ts;
	break;

	case'x':
	$out.=substr($j_y,2,2).'/'.(($j_m>9)?$j_m:'0'.$j_m).'/'.(($j_d<10)?'0'.$j_d:$j_d);
	break;

	/* Miscellaneous */
	case'n':
	$out.="\n";
	break;

	case't':
	$out.="\t";
	break;

	case'%':
	$out.='%';
	break;

	default:$out.=$sub;
  }
 }
 return($tr_num!='en')?tr_num($out,'fa','.'):$out;
}

/*	F	*/
function jmktime($h='',$m='',$s='',$jm='',$jd='',$jy='',$is_dst=-1){
 $h=tr_num($h); $m=tr_num($m); $s=tr_num($s);
 if($h=='' and $m=='' and $s=='' and $jm=='' and $jd=='' and $jy==''){
	return mktime();
 }else{
	list($year,$month,$day)=jalali_to_gregorian($jy,$jm,$jd);
	return mktime($h,$m,$s,$month,$day,$year,$is_dst);
 }
}

/*	F	*/
function jgetdate($timestamp='',$none='',$tz='Asia/Tehran',$tn='en'){
 $ts=($timestamp=='')?time():tr_num($timestamp);
 $jdate=explode('_',jdate('F_G_i_j_l_n_s_w_Y_z',$ts,'',$tz,$tn));
 return array(
	'seconds'=>tr_num((int)tr_num($jdate[6]),$tn),
	'minutes'=>tr_num((int)tr_num($jdate[2]),$tn),
	'hours'=>$jdate[1],
	'mday'=>$jdate[3],
	'wday'=>$jdate[7],
	'mon'=>$jdate[5],
	'year'=>$jdate[8],
	'yday'=>$jdate[9],
	'weekday'=>$jdate[4],
	'month'=>$jdate[0],
	0=>tr_num($ts,$tn)
 );
}

/*	F	*/
function jcheckdate($jm,$jd,$jy){
 $jm=tr_num($jm); $jd=tr_num($jd); $jy=tr_num($jy);
 $l_d=($jm==12)?(($jy%33%4-1==(int)($jy%33*.05))?30:29):31-(int)($jm/6.5);
 return($jm>0 and $jd>0 and $jy>0 and $jm<13 and $jd<=$l_d)?true:false;
}

/*	F	*/
function tr_num($str,$mod='en',$mf='٫'){
 $num_a=array('0','1','2','3','4','5','6','7','8','9','.');
 $key_a=array('۰','۱','۲','۳','۴','۵','۶','۷','۸','۹',$mf);
 return($mod=='fa')?str_replace($num_a,$key_a,$str):str_replace($key_a,$num_a,$str);
}

/*	F	*/
function jdate_words($array,$mod=''){
 foreach($array as $type=>$num){
  $num=(int)tr_num($num);
  switch($type){

	case'ss':
	$sl=strlen($num);
	$xy3=substr($num,2-$sl,1);
	$h3=$h34=$h4='';
	if($xy3==1){
	 $p34='';
	 $k34=array('ده','یازده','دوازده','سیزده','چهارده','پانزده','شانزده','هفده','هجده','نوزده');
	 $h34=$k34[substr($num,2-$sl,2)-10];
	}else{
	 $xy4=substr($num,3-$sl,1);
	 $p34=($xy3==0 or $xy4==0)?'':' و ';
	 $k3=array('','','بیست','سی','چهل','پنجاه','شصت','هفتاد','هشتاد','نود');
	 $h3=$k3[$xy3];
	 $k4=array('','یک','دو','سه','چهار','پنج','شش','هفت','هشت','نه');
	 $h4=$k4[$xy4];
	}
	$array[$type]=(($num>99)?str_ireplace(array('12','13','14','19','20')
	,array('هزار و دویست','هزار و سیصد','هزار و چهارصد','هزار و نهصد','دوهزار')
	,substr($num,0,2)).((substr($num,2,2)=='00')?'':' و '):'').$h3.$p34.$h34.$h4;
	break;

	case'mm':
	$key=array
	('فروردین','اردیبهشت','خرداد','تیر','مرداد','شهریور','مهر','آبان','آذر','دی','بهمن','اسفند');
	$array[$type]=$key[$num-1];
	break;

	case'rr':
	$key=array('یک','دو','سه','چهار','پنج','شش','هفت','هشت','نه','ده','یازده','دوازده','سیزده',
	'چهارده','پانزده','شانزده','هفده','هجده','نوزده','بیست','بیست و یک','بیست و دو','بیست و سه',
	'بیست و چهار','بیست و پنج','بیست و شش','بیست و هفت','بیست و هشت','بیست و نه','سی','سی و یک');
	$array[$type]=$key[$num-1];
	break;

	case'rh':
	$key=array('یکشنبه','دوشنبه','سه شنبه','چهارشنبه','پنجشنبه','جمعه','شنبه');
	$array[$type]=$key[$num];
	break;

	case'sh':
	$key=array('مار','اسب','گوسفند','میمون','مرغ','سگ','خوک','موش','گاو','پلنگ','خرگوش','نهنگ');
	$array[$type]=$key[$num%12];
	break;

	case'mb':
	$key=array('حمل','ثور','جوزا','سرطان','اسد','سنبله','میزان','عقرب','قوس','جدی','دلو','حوت');
	$array[$type]=$key[$num-1];
	break;

	case'ff':
	$key=array('بهار','تابستان','پاییز','زمستان');
	$array[$type]=$key[(int)(1+($num/3))-1];
	break;

	case'km':
	$key=array('فر','ار','خر','تی‍','مر','شه‍','مه‍','آب‍','آذ','دی','به‍','اس‍');
	$array[$type]=$key[$num-1];
	break;

	case'kh':
	$key=array('ی','د','س','چ','پ','ج','ش');
	$array[$type]=$key[$num];
	break;

	default:$array[$type]=$num;
  }
 }
 return($mod=='')?$array:implode($mod,$array);
}

/** Convertor from and to Gregorian and Jalali (Hijri_Shamsi,Solar) Functions
Copyright(C)2011, Reza Gholampanahi [ http://jdf.scr.ir/jdf ] version 2.50 */

/*	F	*/
function gregorian_to_jalali($g_y,$g_m,$g_d,$mod=''){
	$g_y=tr_num($g_y); $g_m=tr_num($g_m); $g_d=tr_num($g_d);/* <= :اين سطر ، جزء تابع اصلي نيست */
 $d_4=$g_y%4;
 $g_a=array(0,0,31,59,90,120,151,181,212,243,273,304,334);
 $doy_g=$g_a[(int)$g_m]+$g_d;
 if($d_4==0 and $g_m>2)$doy_g++;
 $d_33=(int)((($g_y-16)%132)*.0305);
 $a=($d_33==3 or $d_33<($d_4-1) or $d_4==0)?286:287;
 $b=(($d_33==1 or $d_33==2) and ($d_33==$d_4 or $d_4==1))?78:(($d_33==3 and $d_4==0)?80:79);
 if((int)(($g_y-10)/63)==30){$a--;$b++;}
 if($doy_g>$b){
  $jy=$g_y-621; $doy_j=$doy_g-$b;
 }else{
  $jy=$g_y-622; $doy_j=$doy_g+$a;
 }
 if($doy_j<187){
  $jm=(int)(($doy_j-1)/31); $jd=$doy_j-(31*$jm++);
 }else{
  $jm=(int)(($doy_j-187)/30); $jd=$doy_j-186-($jm*30); $jm+=7;
 }
 return($mod=='')?array($jy,$jm,$jd):$jy.$mod.$jm.$mod.$jd;
}

/*	F	*/
function jalali_to_gregorian($j_y,$j_m,$j_d,$mod=''){
	$g_y=tr_num($j_y); $j_m=tr_num($j_m); $j_d=tr_num($j_d);/* <= :اين سطر ، جزء تابع اصلي نيست */
 $d_4=($j_y+1)%4;
 $doy_j=($j_m<7)?(($j_m-1)*31)+$j_d:(($j_m-7)*30)+$j_d+186;
 $d_33=(int)((($j_y-55)%132)*.0305);
 $a=($d_33!=3 and $d_4<=$d_33)?287:286;
 $b=(($d_33==1 or $d_33==2) and ($d_33==$d_4 or $d_4==1))?78:(($d_33==3 and $d_4==0)?80:79);
 if((int)(($j_y-19)/63)==20){$a--;$b++;}
 if($doy_j<=$a){
  $gy=$j_y+621; $gd=$doy_j+$b;
 }else{
  $gy=$j_y+622; $gd=$doy_j-$a;
 }
 foreach(array(0,31,($gy%4==0)?29:28,31,30,31,30,31,31,30,31,30,31) as $gm=>$v){
  if($gd<=$v)break;
  $gd-=$v;
 }
 return($mod=='')?array($gy,$gm,$gd):$gy.$mod.$gm.$mod.$gd;
}

public static  function regDate(){
			$date = self::medate(); 
			
			$mont = $date['ymd']['m'];
			if ( $date['ymd']['m'] < 10 ){
			  	$mont = '0'.$mont;
			}
			$days = $date['ymd']['d'];
			if ( $date['ymd']['d'] < 10 ){
			  	$days = '0'.$days;
			}
			$regdate = $date['ymd']['y'].$mont.$days;
			$hregdate= $date['date4'];
			return array('1'=>$regdate,'2'=>$hregdate,'3'=>$date,'4'=>$date['ymd']['y']);
}
public static  function echo_date($intDate){
	if ( strlen($intDate) == 8 ){
  	$year  = substr($intDate,0,4);
	$month = substr($intDate,4,2);
	$day   = substr($intDate,6,2);
	return self::fn($year.'/'.$month.'/'.$day);
	}
	else if ( strlen($intDate) == 6 ){
  	$year  = substr($intDate,0,4);
	$month = substr($intDate,4,1);
	$day   = substr($intDate,5,1);
	return self::fn($year.'/0'.$month.'/0'.$day);
	}
	else if ( strlen($intDate) == 7 ){
  	$year  = substr($intDate,0,4);
	$month = substr($intDate,4,1);
	$day   = substr($intDate,5,2);
	
	return ($year.'/0'.$month.'/'.$day);
	}
}
public static  function echo_date2($intDate){
  	$year  = substr($intDate,0,4);
	$month = substr($intDate,4,2);
	$day   = substr($intDate,6,2);
	return ($year.'/'.$month.'/'.$day);
}
    public static  function echoNum($num){
        $arr = str_split($num);
        $snum = '';
        $j    = 1;
        for ( $i=count($arr)-1;$i>=0;$i-- ) {
            if ( $j != 4 ){
                $snum = $arr[$i].$snum;
                $j++;
            }
            else {
                $snum = $arr[$i].','.$snum;
                $j=2;
            }
        }
        return html::fn($snum);
    }
}

