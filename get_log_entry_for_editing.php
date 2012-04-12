<?php
include('dewdb.inc');
$cxn = mysql_connect($dewhost,$dewname,$dewpswd) or die(mysql_error());
mysql_select_db('ShopLog',$cxn) or die("error opening db: ".mysql_error());
//print_r($_GET);
$lid=$_GET['lid'];


$q="SELECT prod.Activity_Log_ID, Activity_ID,Machine_ID, comp.Customer_ID, prod.Drawing_ID,Operation_ID,Start_Date_Time,End_Date_Time,
	Operator_ID, DATE_FORMAT(Start_Date_Time,'%d-%m-%Y %h:%i:%s %p') as sdt, DATE_FORMAT(End_Date_time,'%d-%m-%Y %h:%i:%s %p') as edt,Quantity,Remarks,Program_NO FROM Production as prod
	INNER JOIN ActivityLog as actl ON actl.Activity_Log_ID=prod.Activity_Log_ID 
	INNER JOIN Component as comp ON comp.Drawing_ID=prod.Drawing_ID 
	INNER JOIN Customer as cust on cust.Customer_ID=comp.Customer_ID 
	WHERE prod.Activity_Log_ID='$lid' AND Activity_ID IN(1,2,3);";

//print($q);
$resa = mysql_query($q, $cxn) or die(mysql_error($cxn));

$noofrecords=mysql_affected_rows();
if($noofrecords!=0)
{
	$row=mysql_fetch_assoc($resa);
	$mid=$row['Machine_ID'];
	$cid=$row['Customer_ID'];
	$did=$row['Drawing_ID'];
	$oid=$row['Operation_ID'];
	$opeid=$row['Operator_ID'];
	$sdt=$row['sdt'];
	$edt=$row['edt'];
	$qty=$row['Quantity'];
	$remark=$row['Remarks'];
	$pno=$row['Program_NO'];
	$sdtdb=$row['Start_Date_Time'];
	$edtdb=$row['End_Date_Time'];
	$actid=$row['Activity_ID'];
	$data=$mid."<|>".$cid."<|>".$did."<|>".$oid."<|>".$opeid."<|>".$sdt."<|>".$edt."<|>".$qty."<|>".$remark."<|>".$pno."<|>".$sdtdb."<|>".$edtdb."<|>".$actid;
	
}else	
{
$data="";
}

print($data);

?>
