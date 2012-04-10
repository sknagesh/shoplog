<?php
$dewhost = 'localhost';
$dewname = 'nagesh';
$dewpswd = 'april6th';
date_default_timezone_set('Asia/Calcutta');


function change_date_format_for_db($date){

       list($day,$month,$year) = explode("/",$date);
       $newdate = $year."-".$month."-".$day;  
       return $newdate;
}

function change_date_format_for_dispaly($date){

       list($year,$month,$day) = explode("/",$date);
       $newdate = $month."-".$day."-".$year;
       return $newdate;
}

function time_convert($time){

       list($hour,$min,$ampm) = explode(":",$time);
	    if($ampm=="PM")
       {
			if($hour!=12)
			{       
       	$hour+=12;
       	}
       }
       $newtime = $hour.":".$min;
       return $newtime;
}

function secs2hms($secs) {
if ($secs<0) return false;
$m = (int)($secs / 60); $s = $secs % 60;
$h = (int)($m / 60); $m = $m % 60;
return array($h, $m, $s);
}


function hms2mins($secs) {
if ($secs<0) return false;
$t=explode(":", $secs);
$h=$t[0];
$m = $t[1];
$s = $t[2];
$mins=$h*60+$m+$s/60;
return $mins;
}

?>