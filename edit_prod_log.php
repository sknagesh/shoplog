<?php
include('dewdb.inc');
$cxn = mysql_connect($dewhost,$dewname,$dewpswd) or die(mysql_error());
mysql_select_db('ShopLog',$cxn) or die("error opening db: ".mysql_error());
print_r($_POST);

$drawingid=$_POST['Drawing_ID'];
$activityid=$_POST['Activity_ID'];
$machineid=$_POST['Machine_ID'];
$operationid=$_POST['Operation_ID'];
$sdatetime=$_POST['sdatedb'];
$edatetime=$_POST['edatedb'];
$progno=$_POST['pno'];
$operatorid=$_POST['Operator_ID'];
$qty=$_POST['qty'];
$actlid=$_POST['lid'];

if(isSet($_POST['remark'])){$remarks=$_POST['remark'];}else{$remarks="";}


$query="UPDATE ActivityLog SET Activity_ID=$activityid,
								Machine_ID=$machineid,
								Start_Date_Time='$sdatetime',
								End_Date_Time='$edatetime',
								Operator_ID=$operatorid,
								Remarks='$remarks' WHERE Activity_Log_ID=$actlid; ";

//print("<br>$query");

$res=mysql_query($query) or die(mysql_error());


$pquery="UPDATE Production SET Drawing_ID=$drawingid,
								Operation_ID=$operationid,
								Program_NO='$progno',
								Quantity=$qty WHERE Activity_Log_ID=$actlid; ";

//print("<br>$pquery");

$result=mysql_query($pquery) or die(mysql_error());

print("Updated Log ID $actlid");
?>