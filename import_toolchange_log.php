<?php
include('dewdb.inc');
$cxn1 = mysql_connect($dewhost,$dewname,$dewpswd) or die(mysql_error());
$cxn2 = mysql_connect($dewhost,$dewname,$dewpswd,true) or die(mysql_error());
mysql_select_db('ShopLog',$cxn1) or die("error opening db: ".mysql_error());
mysql_select_db('activityLog',$cxn2) or die("error opening db: ".mysql_error());

$production="SELECT * FROM ToolLog;";
$res=mysql_query($production,$cxn2) or die(mysql_error());
$ok=0;
$lastid=0;
while($row=mysql_fetch_assoc($res))
{
	$query="INSERT INTO ActivityLog (Activity_ID,
								Machine_ID,
								Start_Date_Time,
								End_Date_Time,
								Operator_ID,
								Remarks) ";
	$query.="VALUES('10',
				'$row[Machine_ID]',
				'$row[Change_Date_Time]',
				'$row[Change_Date_Time]',
				'$row[Operator_ID]',
				'$row[Remarks]');";

//	print("<br>$query");

	$resul=mysql_query($query,$cxn1) or die(mysql_error());
	$lastid=mysql_insert_id($cxn1);

	$pquery="INSERT INTO ToolChange (Activity_Log_ID,
								Drawing_ID,
								Operation_ID,
								Tool_Desc,
								Tool_Dia,
								New_Tool,
								Tool_Type_ID,
								Change_Reason) ";
	if($row['New_Tool']==0){$nt="Resharpened";}else{$nt="New";}
	$pquery.="VALUES('$lastid',
				'$row[Drawing_ID]',
				'$row[Operation_NO]',
				'$row[Tool_Name]',
				'$row[Tool_Dia]',
				'$nt',
				'$row[Tool_Type_ID]',
				'See Remarks');";

//	print("<br>$pquery");

	$result=mysql_query($pquery,$cxn1) or die(mysql_error());
	$ook=mysql_affected_rows();
	if($ook!=0)
	{ 
		$ok+=1;
	}else{
		print("Error adding into Production Log");
	}


}
print("total $ok Tool Change records added");
?>