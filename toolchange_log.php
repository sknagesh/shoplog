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
$tdesc=$_POST['tdesc'];
$operatorid=$_POST['Operator_ID'];
$tdia=$_POST['tdia'];
$newtool=$_POST['newt'];
$reason=$_POST['reason'];
$ttypeid=$_POST['Tool_Type_ID'];
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

$pquery="INSERT INTO ToolChange (Activity_Log_ID,
								Drawing_ID,
								Operation_ID,
								Tool_Desc,
								Tool_Dia,
								New_Tool,
								Tool_Type_ID,
								Change_reason) ";
$pquery.="VALUES('$lastid',
				'$drawingid',
				'$operationid',
				'$tdesc',
				'$tdia',
				'$newtool',
				'$ttypeid',
				'$reason');";

//print("<br>$pquery");
$result=mysql_query($pquery) or die(mysql_error());
$ok=mysql_affected_rows();
if($ok!=0)
{
	print("Added one Row in to Tool Change Log and Log ID is $lastid");
}else{
	print("Error adding into Tool Change Log");
}


?>