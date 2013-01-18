<?php
include('dewdb.inc');
$cxn1 = mysql_connect($dewhost,$dewname,$dewpswd) or die(mysql_error());
mysql_select_db('ShopLog',$cxn1) or die("error opening db: ".mysql_error());

$production="SELECT * FROM tempmaint;";
$res=mysql_query($production,$cxn1) or die(mysql_error());
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
	$query.="VALUES('$row[Activity_ID]',
				'$row[Machine_ID]',
				'$row[Start_Date_Time]',
				'$row[End_Date_Time]',
				'$row[Operator_ID]',
				'$row[Remarks]');";

	print("<br>$query");

	$resul=mysql_query($query,$cxn1) or die(mysql_error());
	$lastid=mysql_insert_id($cxn1);

	$pquery="INSERT INTO Maintenance (Activity_Log_ID,
								MakinoEng,
								Problem_Desc,
								Maint_Desc,
								Spares_Used) ";
	$pquery.="VALUES('$lastid',
				'$row[MakinoEngr]',
				'$row[Problem_Desc]',
				'$row[Maint_Desc]',
				'$row[Spares_Used]');";

	print("<br>$pquery");

	$result=mysql_query($pquery,$cxn1) or die(mysql_error());
	$ook=mysql_affected_rows();
	if($ook!=0)
	{ 
		$ok+=1;
	}else{
		print("Error adding into tempmaint Log");
	}


}
print("total $ok Breakdown maintenance record added");
?>