<?php
include('dewdb.inc');
$cxn = mysql_connect($dewhost,$dewname,$dewpswd) or die(mysql_error());
mysql_select_db('ShopLog',$cxn) or die("error opening db: ".mysql_error());
//print_r($_GET);
if(isSet($_GET['mid'])){$mid=$_GET['mid'];}else{$mid="";}
if(isSet($_GET['sdate'])){$sdate=$_GET['sdate'];}else{$sdate="";}
if(isSet($_GET['edate'])){$edate=$_GET['edate'];}else{$edate="";}
if(isSet($_GET['stext'])){$stext=$_GET['stext'];}else{$stext="";}
if(isSet($_GET['mtype'])){$mtype=$_GET['mtype'];}else{$mtype="";}

if($stext!="")
{
	
	$setext="AND (Remarks LIKE '%$stext%' OR 
		Problem_Desc LIKE '%$stext%' OR 
		Maint_Desc LIKE '%$stext%')";
}


if($mid!='')
{
	
	$mid="AND actl.Machine_ID='$mid'";
}

if($sdate!='')
{
	
	$sdate="AND Start_Date_Time>='$sdate'";
}

if($edate!='')
{
	
	$edate="AND Start_Date_Time<='$edate'";
}


if($mtype!='')
{
	
	$mtype="AND actl.Activity_ID='$mtype'";
}


	
$query="SELECT actl.Activity_Log_ID,actl.Activity_ID, actl.Machine_ID,Machine_Name,
		DATE_FORMAT(Start_Date_Time,'%d/%m/%Y %h:%i %p') as sdt,
		DATE_FORMAT(End_Date_Time,'%d/%m/%Y %h:%i %p')as edt,
		TIMEDIFF(End_Date_Time,Start_Date_Time) as td,
		actl.Operator_ID,Remarks,Operator_Name,Activity_Name,Problem_Desc,Maint_Desc,Spares_Used,MakinoEng FROM ActivityLog as actl  
		INNER JOIN Activity as act ON act.Activity_ID=actl.Activity_ID 
		INNER JOIN Operator as ope ON ope.Operator_ID=actl.Operator_ID
		INNER JOIN Maintenance as maint ON maint.Activity_Log_ID=actl.Activity_Log_ID
		INNER JOIN Machine AS ma ON ma.Machine_ID=actl.Machine_ID 
		WHERE actl.Activity_ID IN(5,6) $mid $sdate $edate $mtype $setext 
		  ORDER BY End_Date_Time DESC;";
	
//print("$query<br>");

print("<br><h1>Maintenance Entries for this Machine</h1><br>");
$resa = mysql_query($query, $cxn) or die(mysql_error($cxn));
$noofrecords=mysql_affected_rows();
if($noofrecords!=0)
{
	$c="q";
print("<table cellspacing=\"1\" cellborder=\"1\" >");
print("<tr class=\"t\" ><th>ID</th><th>Machine</th><th>Activity</th><th>Problem Description</th><th>Maintenance Desc</th><th>Start Date Time</th><th>End Date Time</th>
		<th>Total Time</th><th>Spares Used</th><th>Operator Name</th><th>Makino Enginner</th><th>Remarks</th></tr>");
while ($row = mysql_fetch_assoc($resa))
{
		
		$id=$row['Activity_Log_ID'];
		$sdt=$row['sdt'];
		$edt=$row['edt'];
		$opename=$row['Operator_Name'];
		$activity=$row['Activity_Name'];
		$td=$row['td'];
		$remarks=$row['Remarks'];
		$prob=$row['Problem_Desc'];
		$wd=$row['Maint_Desc'];
		$spare=$row['Spares_Used'];
		$me=$row['MakinoEng'];
		$mname=$row['Machine_Name'];
print("<tr class=\"$c\"><td>$id</td><td>$mname</td><td>$activity</td><td>$prob</td><td>$wd</td><td>$sdt</td><td>$edt</td><td align=\"center\">$td</td>
		<td>$spare</td><td>$opename</td><td>$me</td><td>$remarks</td></tr>");
if($c=="q"){$c="s";}else{$c="q";}
}
print("</table>");
}else{print("No Activity Detected For This Machine");}



?>