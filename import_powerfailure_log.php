<?php
include('dewdb.inc');
$cxn1 = mysql_connect($dewhost,$dewname,$dewpswd) or die(mysql_error());
$cxn2 = mysql_connect($dewhost,$dewname,$dewpswd,true) or die(mysql_error());
mysql_select_db('ShopLog',$cxn1) or die("error opening db: ".mysql_error());
mysql_select_db('activityLog',$cxn2) or die("error opening db: ".mysql_error());



$production="SELECT * FROM PowerFailure;";
$res=mysql_query($production,$cxn2) or die(mysql_error());
$ok=0;
//$lastid=0;
while($row=mysql_fetch_assoc($res))
{

	$pf="SELECT * FROM Machine;";
	$r=mysql_query($pf,$cxn1) or die(mysql_error());
	while($rr=mysql_fetch_assoc($r))
	{


	$query="INSERT INTO ActivityLog (Activity_ID,
								Machine_ID,
								Start_Date_Time,
								End_Date_Time,
								Operator_ID,
								Remarks) ";
	$query.="VALUES('7',
				'$rr[Machine_ID]',
				'$row[Start_Date_Time]',
				'$row[End_Date_Time]',
				'$row[Operator_ID]',
				'$row[Remarks]');";

//	print("<br>$query");
	$result=mysql_query($query,$cxn1) or die(mysql_error());
	$ook=mysql_affected_rows();
	if($ook!=0)
	{ 
		$ok+=1;
	}else{
		print("Error adding into Production Log");
	}
	}

}
print("total $ok Power Failure record added");
?>