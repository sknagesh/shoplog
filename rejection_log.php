<?php
include('dewdb.inc');
$cxn = mysql_connect($dewhost,$dewname,$dewpswd) or die(mysql_error());
mysql_select_db('ShopLog',$cxn) or die("error opening db: ".mysql_error());
//print_r($_POST);

$drawingid=$_POST['Drawing_ID'];
$activityid=$_POST['Activity_ID'];
$machineid=$_POST['Machine_ID'];
$operationid=$_POST['Operation_ID'];
$sdatetime=$_POST['sdatedb'];
$progno=$_POST['pno'];
$operatorid=$_POST['Operator_ID'];
$qty=$_POST['qty'];
if(isSet($_POST['remark'])){$remark=$_POST['remark'];}else{$remarks="";}


$query="INSERT INTO ActivityLog (Activity_ID,
								Machine_ID,
								Start_Date_Time,
								End_Date_Time,
								Operator_ID,
								Remarks) ";
$query.="VALUES('$activityid',
				'$machineid',
				'$sdatetime',
				'$sdatetime',
				'$operatorid',
				'$remark');";

//print("<br>$query");

$res=mysql_query($query) or die(mysql_error());
$lastid=mysql_insert_id();

$pquery="INSERT INTO Rejection (Activity_Log_ID,
								Drawing_ID,
								Operation_ID,
								Rejection_Qty) ";
$pquery.="VALUES('$lastid',
				'$drawingid',
				'$operationid',
				'$qty');";

//print("<br>$pquery");
$result=mysql_query($pquery) or die(mysql_error());
$ok=mysql_affected_rows();
if($ok!=0)
{
	print("Added one Row in to Rejection Log and Log ID is $lastid");
}else{
	print("Error adding into Rejection Log");
}


?>