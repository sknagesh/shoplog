<?php
include('dewdb.inc');
$cxn = mysql_connect($dewhost,$dewname,$dewpswd) or die(mysql_error());
mysql_select_db('ShopLog',$cxn) or die("error opening db: ".mysql_error());
$mid=$_GET['mid'];
//print($mid);


$query="SELECT Activity_Log_ID,actl.Activity_ID, Machine_ID,
		DATE_FORMAT(Start_Date_Time,'%d/%m/%y %h:%i %p') as sdt,DATE_FORMAT(End_Date_Time,'%d/%m/%y %h:%i %p')as edt,actl.Operator_ID,Remarks,
		Operator_Name,Activity_Name FROM ActivityLog as actl  
		INNER JOIN Activity as act ON act.Activity_ID=actl.Activity_ID 
		INNER JOIN Operator as ope ON ope.Operator_ID=actl.Operator_ID
		WHERE Machine_ID='$mid' AND actl.Activity_ID NOT IN(9,10) ORDER BY End_Date_Time DESC LIMIT 3;";
//print("$query<br>");
print("<br><h1>Last Three Log Entries for this Machine</h1><br>");
$resa = mysql_query($query, $cxn) or die(mysql_error($cxn));
$noofrecords=mysql_affected_rows();
if($noofrecords!=0)
{
print("<table cellspacing=\"5\" cellborder=\"2\" border=\"1\">");
print("<tr><th>Activity</th><th>Drawing No</th><th>Desc</th><th>Start Date Time</th><th>End Date Time</th><th>Operator Name</th></tr>");
while ($row = mysql_fetch_assoc($resa))
{
		
	if($row['Activity_ID']==1)
	{
		$sq="SELECT Drawing_NO,Component_Name, Operation_Desc FROM Production as pro 
		INNER JOIN Component as comp ON comp.Drawing_ID=pro.Drawing_ID
		INNER JOIN Operation as ope ON ope.Operation_ID=pro.Operation_ID 
		 WHERE pro.Activity_Log_ID=$row[Activity_Log_ID];";
		$res = mysql_query($sq, $cxn) or die(mysql_error($cxn));
		$rr=mysql_fetch_assoc($res);
		$dno=$rr['Drawing_NO'];
		$compname=$rr['Component_Name'];
		$operationdesc=$rr['Operation_Desc'];
		
	}else
		if($row['Activity_ID']==2)
	{
		$sq="SELECT Drawing_NO,Component_Name, Operation_Desc FROM Production as pro 
		INNER JOIN Component as comp ON comp.Drawing_ID=pro.Drawing_ID
		INNER JOIN Operation as ope ON ope.Operation_ID=pro.Operation_ID 
		 WHERE pro.Activity_Log_ID=$row[Activity_Log_ID];";
		$res = mysql_query($sq, $cxn) or die(mysql_error($cxn));
		$rr=mysql_fetch_assoc($res);
		$dno=$rr['Drawing_NO'];
		$compname=$rr['Component_Name'];
		$operationdesc=$rr['Operation_Desc'];
		 
	}else
		if($row['Activity_ID']==3)
	{
		$sq="SELECT Drawing_NO,Component_Name, Operation_Desc FROM Production as pro 
		INNER JOIN Component as comp ON comp.Drawing_ID=pro.Drawing_ID
		INNER JOIN Operation as ope ON ope.Operation_ID=pro.Operation_ID 
		 WHERE pro.Activity_Log_ID=$row[Activity_Log_ID];";
		$res = mysql_query($sq, $cxn) or die(mysql_error($cxn));
		$rr=mysql_fetch_assoc($res);
		$dno=$rr['Drawing_NO'];
		$compname=$rr['Component_Name'];
		$operationdesc=$rr['Operation_Desc'];

		 
	}else
		if($row['Activity_ID']==4)
	{
		$sq="SELECT Drawing_NO FROM NonProduction WHERE Activity_Log_ID=$row[Activity_Log_ID];";
		
		$res = mysql_query($sq, $cxn) or die(mysql_error($cxn));
		$rr=mysql_fetch_assoc($res);
		$dno=$rr['Drawing_NO'];
		$compname="";
		$operationdesc="";		
	}else
		if($row['Activity_ID']==5)
	{
		$sq="SELECT Problem_Desc FROM Maintenance WHERE Activity_Log_ID=$row[Activity_Log_ID];";
		$res = mysql_query($sq, $cxn) or die(mysql_error($cxn));
		$rr=mysql_fetch_assoc($res);
		$operationdesc=$rr['Problem_Desc'];
		$compname="";
		$dno='';
	}else
		if($row['Activity_ID']==6)
	{
		$sq="SELECT Problem_Desc FROM Maintenance WHERE Activity_Log_ID=$row[Activity_Log_ID];";
		$res = mysql_query($sq, $cxn) or die(mysql_error($cxn));
		$rr=mysql_fetch_assoc($res);
		$operationdesc=$rr['Problem_Desc'];
		$dno='';
		$compname="";

	}else
		if($row['Activity_ID']==11)
	{
		$sq="SELECT Drawing_NO FROM NonProduction WHERE Activity_Log_ID=$row[Activity_Log_ID];";
		
		$res = mysql_query($sq, $cxn) or die(mysql_error($cxn));
		$rr=mysql_fetch_assoc($res);
		$dno=$rr['Drawing_NO'];
		$compname="";
		$operationdesc="";		

	}else
		if($row['Activity_ID']==12)
	{
		$sq="SELECT Drawing_NO FROM NonProduction WHERE Activity_Log_ID=$row[Activity_Log_ID];";
		
		$res = mysql_query($sq, $cxn) or die(mysql_error($cxn));
		$rr=mysql_fetch_assoc($res);
		$dno=$rr['Drawing_NO'];
		$compname="";
		$operationdesc="";		

	}
		
		
		$sdt=$row['sdt'];
		$edt=$row['edt'];
		$opename=$row['Operator_Name'];
		$activity=$row['Activity_Name'];

print("<tr><td>$activity</td><td>$dno - $compname</td><td>$operationdesc</td><td>$sdt</td><td>$edt</td><td>$opename</td></tr>");

}
print("</table>");
}else{print("No Activity Detected For This Machine");}



?>