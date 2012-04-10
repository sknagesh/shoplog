<?php
include('dewdb.inc');
$cxn = mysql_connect($dewhost,$dewname,$dewpswd) or die(mysql_error());
mysql_select_db('ShopLog',$cxn) or die("error opening db: ".mysql_error());
//print_r($_POST);

$activityid=$_POST['Activity_ID'];
$machineid=$_POST['Machine_ID'];
$sdatetime=$_POST['sdatedb'];
$edatetime=$_POST['edatedb'];
$operatorid=$_POST['Operator_ID'];
$bddetails=$_POST['bddetail'];
$wodetails=$_POST['wodetail'];
if(isSet($_POST['mkengr'])){$mkengr=$_POST['mkengr'];}else{$mkengr="";}
if(isSet($_POST['spares'])){$spares=$_POST['spares'];}else{$spares="";}
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
				'$edatetime',
				'$operatorid',
				'$remark');";

//print("<br>$query");

$res=mysql_query($query) or die(mysql_error());
$lastid=mysql_insert_id();

$pquery="INSERT INTO Maintenance (Activity_Log_ID,
								MakinoEng,
								Problem_Desc,
								Maint_Desc,
								Spares_Used) ";
$pquery.="VALUES('$lastid',
				'$mkengr',
				'$bddetails',
				'$wodetails',
				'$spares');";

//print("<br>$pquery");
$result=mysql_query($pquery) or die(mysql_error());
$ok=mysql_affected_rows();
if($ok!=0)
{
	print("Added one Row in to Maintenance Log and Log ID is $lastid");
}else{
	print("Error adding into Maintenance Log");
}


?>