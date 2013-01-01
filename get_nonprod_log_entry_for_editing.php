<?php
include('dewdb.inc');
$cxn = mysql_connect($dewhost,$dewname,$dewpswd) or die(mysql_error());
mysql_select_db('ShopLog',$cxn) or die("error opening db: ".mysql_error());
//print_r($_GET);
$lid=$_GET['lid'];


$q="SELECT nprod.Activity_Log_ID, nprod.Drawing_NO,Activity_ID,Machine_ID, nprod.Operation_Desc,nprod.Program_NO,nprod.Quantity,nprod.Customer_ID,Start_Date_Time,End_Date_Time,
	Operator_ID,nprod.Batch_ID, DATE_FORMAT(Start_Date_Time,'%d-%m-%Y %h:%i:%s %p') as sdt, DATE_FORMAT(End_Date_time,'%d-%m-%Y %h:%i:%s %p') as edt,Quantity,Remarks,Program_NO FROM NonProduction as nprod
	INNER JOIN ActivityLog as actl ON actl.Activity_Log_ID=nprod.Activity_Log_ID 
	INNER JOIN Customer as cust on cust.Customer_ID=nprod.Customer_ID 
	WHERE nprod.Activity_Log_ID='$lid' AND Activity_ID NOT IN(1,2,3);";

print($q);
$resa = mysql_query($q, $cxn) or die(mysql_error($cxn));

$noofrecords=mysql_affected_rows();
if($noofrecords!=0)
{
	$row=mysql_fetch_assoc($resa);
	$mid=$row['Machine_ID'];
	$cid=$row['Customer_ID'];
	$did=$row['Drawing_NO'];
	$oid=$row['Operation_Desc'];
	$opeid=$row['Operator_ID'];
	$sdt=$row['sdt'];
	$edt=$row['edt'];
	$qty=$row['Quantity'];
	$remark=$row['Remarks'];
	$pno=$row['Program_NO'];
	$sdtdb=$row['Start_Date_Time'];
	$edtdb=$row['End_Date_Time'];
	$actid=$row['Activity_ID'];
	$bid=$row['Batch_ID'];
	$data=$mid."<|>".$cid."<|>".$did."<|>".$oid."<|>".$opeid."<|>".$sdt."<|>".$edt."<|>".$qty."<|>".$remark."<|>".$pno."<|>".$sdtdb."<|>".$edtdb."<|>".$actid."<|>".$bid;
	
}else	
{
$data="";
}

print($data);

?>
