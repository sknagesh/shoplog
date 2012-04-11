<?php
include('dewdb.inc');
$cxn = mysql_connect($dewhost,$dewname,$dewpswd) or die(mysql_error());
mysql_select_db('ShopLog',$cxn) or die("error opening db: ".mysql_error());
//print_r($_GET);
if(isSet($_GET['sdate'])){$sdate=$_GET['sdate'];}else{$sdate="";}
if(isSet($_GET['edate'])){$edate=$_GET['edate'];}else{$edate="";}

if($sdate!=""&&$edate!="")
{
$query="SELECT Remarks,DATE_FORMAT(Start_Date_Time,'%d/%m/%Y %h:%i %p') as sdt,
		DATE_FORMAT(End_Date_Time,'%d/%m/%Y %h:%i %p')as edt,
		TIMEDIFF(End_Date_Time,Start_Date_Time) as td 
 		FROM ActivityLog WHERE Activity_ID='7' AND Machine_ID=1 
		AND Start_Date_Time>='$sdate' AND Start_Date_Time<='$edate' ORDER BY End_Date_Time DESC;";

		$q2="SELECT SEC_TO_TIME(SUM(totaltime)) as td FROM 
		(SELECT TIME_TO_SEC(TIMEDIFF(End_Date_Time,Start_Date_Time)) as totaltime FROM ActivityLog as actl WHERE actl.Activity_ID='7' AND actl.Machine_ID=1 
		AND actl.Start_Date_Time>='$sdate' AND actl.Start_Date_Time<='$edate' ORDER BY actl.End_Date_Time DESC) as totaltime;";

}else
{
	$query="SELECT Remarks,DATE_FORMAT(Start_Date_Time,'%d/%m/%Y %h:%i %p') as sdt,
		DATE_FORMAT(End_Date_Time,'%d/%m/%Y %h:%i %p')as edt,
		TIMEDIFF(End_Date_Time,Start_Date_Time) as td 
		FROM ActivityLog WHERE Activity_ID='7' AND Machine_ID=1 ORDER BY End_Date_Time DESC LIMIT 10;";
	
	$q2="SELECT SEC_TO_TIME(SUM(totaltime)) as td FROM 
	(SELECT TIME_TO_SEC(TIMEDIFF(End_Date_Time,Start_Date_Time)) as totaltime FROM ActivityLog WHERE Activity_ID='7' AND Machine_ID=1 ORDER BY End_Date_Time DESC LIMIT 10) as totaltime;";
}
//print("$query<br>");
print("<br><h1>Power Failure Entries</h1>");
$r = mysql_query($q2, $cxn) or die(mysql_error($cxn));
$rrr=mysql_fetch_assoc($r);
$tt=$rrr['td'];
$resa = mysql_query($query, $cxn) or die(mysql_error($cxn));
$noofrecords=mysql_affected_rows();
if($noofrecords!=0)
{
	$c="q";
print("Total Power Failures for This period is $tt <br>");

print("<table cellspacing=\"1\" cellborder=\"1\" >");
print("<tr class=\"t\" ><th>Start Date Time</th><th>End Date Time</th>
		<th>Total Time</th><th>Remarks</th></tr>");
while ($row = mysql_fetch_assoc($resa))
{
print("<tr class=\"$c\"><td>$row[sdt]</td><td>$row[edt]</td><td>$row[td]</td><td>$row[Remarks]</td></tr>");
if($c=="q"){$c="s";}else{$c="q";}
}
print("</table>");
}else{print("No Power Failures Recorded between these Dates");}



?>