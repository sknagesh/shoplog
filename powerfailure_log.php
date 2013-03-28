<?php
include('dewdb.inc');
$cxn = mysql_connect($dewhost,$dewname,$dewpswd) or die(mysql_error());
mysql_select_db('ShopLog',$cxn) or die("error opening db: ".mysql_error());
//print_r($_POST);

$activityid=$_POST['Activity_ID'];
$sdatetime=$_POST['sdatedb'];
$edatetime=$_POST['edatedb'];
$operatorid=$_POST['Operator_ID'];
if(isSet($_POST['remark'])){$remark=$_POST['remark'];}else{$remarks="";}

$getmachine="SELECT * FROM Machine;";
$r=mysql_query($getmachine) or die(mysql_error());
while($rr=mysql_fetch_assoc($r))
{
$query="INSERT INTO ActivityLog (Activity_ID,
								Machine_ID,
								Start_Date_Time,
								End_Date_Time,
								Operator_ID,
								Remarks) ";
$query.="VALUES('$activityid',
				'$rr[Machine_ID]',
				'$sdatetime',
				'$edatetime',
				'$operatorid',
				'$remark');";

//print("<br>$query");

$res=mysql_query($query) or die(mysql_error());
}
$ok=mysql_affected_rows();
if($ok!=0)
{
	print("Updated Power Failure Log");
}else{
	print("Error adding into Log");
}


?>