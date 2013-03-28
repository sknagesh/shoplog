<?php
include('dewdb.inc');
$cxn = mysql_connect($dewhost,$dewname,$dewpswd) or die(mysql_error());
mysql_select_db('ShopLog',$cxn) or die("error opening db: ".mysql_error());
//print_r($_GET);
if(isSet($_GET['sdate'])){$sdate=$_GET['sdate'];}else{$sdate="";}
if(isSet($_GET['edate'])){$edate=$_GET['edate'];}else{$edate="";}

if($sdate!=""&&$edate!="")
{

$query="SELECT Rejection_Qty,Remarks, DATE_FORMAT(Start_Date_Time,'%d/%m/%Y %h:%i %p') as sdt,Component_Name,Drawing_NO,Operator_Name 
		 FROM Rejection AS rej
		 INNER JOIN ActivityLog as actl ON actl.Activity_log_ID=rej.Activity_Log_ID
		 INNER JOIN Component AS comp ON comp.Drawing_ID=rej.Drawing_ID
		 INNER JOIN Operation AS ope ON ope.Operation_ID=rej.Operation_ID
		 INNER JOIN Operator AS op ON op.Operator_ID=actl.Operator_ID  
			WHERE Start_Date_Time>='$sdate' AND Start_Date_Time<='$edate' ORDER BY Start_Date_Time DESC;";


}else
{
$query="SELECT Rejection_Qty,Remarks, DATE_FORMAT(Start_Date_Time,'%d/%m/%Y %h:%i %p') as sdt,Component_Name,Drawing_NO,Operator_Name
		 FROM Rejection AS rej
		 INNER JOIN ActivityLog as actl ON actl.Activity_log_ID=rej.Activity_Log_ID
		 INNER JOIN Component AS comp ON comp.Drawing_ID=rej.Drawing_ID
		 INNER JOIN Operation AS ope ON ope.Operation_ID=rej.Operation_ID 
		 INNER JOIN Operator AS op ON op.Operator_ID=actl.Operator_ID 
		 ORDER BY Start_Date_Time DESC;";
	
}
//print("$query<br>");
print("<br><h1>Rejection Details</h1>");
$resa = mysql_query($query, $cxn) or die(mysql_error($cxn));
$noofrecords=mysql_affected_rows();
if($noofrecords!=0)
{
	$c="q";
print("<table cellspacing=\"1\" cellborder=\"1\" >");
print("<tr class=\"t\" ><th>Drawing No and Name</th><th>Date</th><th>Name</th>
		<th>Qty</th><th>Remarks</th></tr>");
while ($row = mysql_fetch_assoc($resa))
{
print("<tr class=\"$c\"><td>$row[Drawing_NO]  $row[Component_Name]</td><td>$row[sdt]</td><td>$row[Operator_Name]</td><td>$row[Rejection_Qty]</td><td>$row[Remarks]</td></tr>");
if($c=="q"){$c="s";}else{$c="q";}
}
print("</table>");
}else{print("No Rejection Recorded between these Dates");}



?>