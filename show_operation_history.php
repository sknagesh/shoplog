<?php
include('dewdb.inc');
$cxn = mysql_connect($dewhost,$dewname,$dewpswd) or die(mysql_error());
mysql_select_db('ShopLog',$cxn) or die("error opening db: ".mysql_error());
$operationid=$_GET['operationid'];
$query="SELECT Machine_Name,Operation_ID,prod.Drawing_ID,Start_Date_Time,End_Date_Time,Component_Name,Drawing_NO
		 FROM Production AS prod
		 INNER JOIN ActivityLog as actl ON actl.Activity_log_ID=prod.Activity_Log_ID
		 INNER JOIN Component AS comp ON comp.Drawing_ID=prod.Drawing_ID
		 INNER JOIN Machine as mach ON mach.Machine_ID=actl.Machine_ID
		  WHERE prod.Operation_ID='$operationid' ORDER BY End_Date_Time DESC LIMIT 10;";

//print($query);

$res=mysql_query($query) or die(mysql_error());
$r=mysql_num_rows($res);
if($r!=0)
{
	$c="q";
print("<table cellspacing=\"1\">");
print("<tr class=\"t\"><th>Machine</th><th>Drawing No and Name</th><th>Start Date and Time</th><th>End Date and Time</th></tr>");
while($row=mysql_fetch_assoc($res))
{

print("<tr class=\"$c\"><td>$row[Machine_Name]</td><td>$row[Drawing_NO]  $row[Component_Name]</td><td>$row[Start_Date_Time]</td><td>$row[End_Date_Time]</td></tr>");
	if($c=="q"){$c="s";}else{$c="q";}
}
print("</table>");
}
else {
	print("No Operations Added For this Drawing Yet");
}
?>