<?php
include('dewdb.inc');
$cxn = mysql_connect($dewhost,$dewname,$dewpswd) or die(mysql_error());
mysql_select_db('ShopLog',$cxn) or die("error opening db: ".mysql_error());
//print_r($_GET);
if(isSet($_GET['ncid'])){$ncid=$_GET['ncid'];}else{$ncid="";}
if(isSet($_GET['sdate'])){$sdate=$_GET['sdate'];}else{$sdate="";}
if(isSet($_GET['edate'])){$edate=$_GET['edate'];}else{$edate="";}

if($ncid!='')
{
	$ncid="AND NC_Type=".$ncid;
}

if($sdate!='')
{
	$sdate="AND Start_Date_Time>='$sdate'";
}

if($edate!='')
{
	$edate="AND Start_Date_Time<='$edate'";
}

$query="SELECT actl.Activity_Log_ID,actl.Activity_ID,
		DATE_FORMAT(Start_Date_Time,'%d/%m/%Y ') as sdt,
		actl.Operator_ID,Remarks,Operator_Name,Activity_Name,Prob_Desc,Root_Cause,Corr_Action,
		ncs.Status,NC_Percentage,Batch_ID,NC_Desc,Component_Name,Drawing_NO FROM ActivityLog as actl  
		INNER JOIN Activity as act ON act.Activity_ID=actl.Activity_ID 
		INNER JOIN Operator as ope ON ope.Operator_ID=actl.Operator_ID
		INNER JOIN NonConformance as nc ON nc.Activity_Log_ID=actl.Activity_Log_ID
		INNER JOIN NCType as nct ON nct.NC_ID=nc.NC_Type
		INNER JOIN NC_Status as ncs ON ncs.Status_ID=nc.Status
		INNER JOIN Component AS comp ON comp.Drawing_ID=nc.Drawing_ID
		WHERE actl.Activity_ID IN(15) $ncid $sdate $edate;";
	
//print("$query<br>");


print("<br><h1>Non Conformance Entries</h1><br>");
$resa = mysql_query($query, $cxn) or die(mysql_error($cxn));
$noofrecords=mysql_affected_rows();
if($noofrecords!=0)
{
	$c="q";
print("<table cellspacing=\"1\" cellborder=\"1\" >");
print("<tr class=\"t\" ><th>ID</th><th>NC Type</th><th>Date</th><th>Drg No and Name</th><th>Name</th><th>Problem Description</th>
	<th>Root Cause</th><th>Corrective Action</th><th>Status</th>
		<th>NC Percentage</th><th>Batch NO</th><th>Remarks</th></tr>");
while ($row = mysql_fetch_assoc($resa))
{
		
print("<tr class=\"$c\"><td>$row[Activity_Log_ID]</td><td>$row[NC_Desc]</td><td>$row[sdt]</td>
		<td>$row[Drawing_NO] - $row[Component_Name]</td><td>$row[Operator_Name]</td><td>$row[Prob_Desc]</td><td>$row[Root_Cause]</td>
		<td>$row[Corr_Action]</td><td align=\"center\">$row[Status]</td>
		<td>$row[NC_Percentage]</td><td>$row[Batch_ID]</td><<td>$row[Remarks]</td></tr>");
if($c=="q"){$c="s";}else{$c="q";}
}
print("</table>");
}else{print("No NCs Detected For This Peroid/Type");}



?>