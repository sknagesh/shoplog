<?php
include('dewdb.inc');
$cxn = mysql_connect($dewhost,$dewname,$dewpswd) or die(mysql_error());
mysql_select_db('ShopLog',$cxn) or die("error opening db: ".mysql_error());
if(isSet($_GET['drawingid'])){$drawingid=$_GET['drawingid'];}else{$drawingid="";}

if($drawingid!="")
{

$query="SELECT Machine_Name,Tool_Desc,Tool_Dia,Change_Reason,Remarks, New_Tool,Start_Date_Time,Component_Name,Drawing_NO
		 FROM ToolChange AS tc
		 INNER JOIN ActivityLog as actl ON actl.Activity_log_ID=tc.Activity_Log_ID
		 INNER JOIN Component AS comp ON comp.Drawing_ID=tc.Drawing_ID
		 INNER JOIN Operation AS ope ON ope.Operation_ID=tc.Operation_ID 
		 INNER JOIN Machine as mach ON mach.Machine_ID=actl.Machine_ID
		  WHERE tc.Drawing_ID='$drawingid' ORDER BY Start_Date_Time DESC;";
}else{
$query="SELECT Machine_Name,Tool_Desc,Tool_Dia,Change_Reason,Remarks, New_Tool,Start_Date_Time,Component_Name,Drawing_NO
		 FROM ToolChange AS tc
		 INNER JOIN ActivityLog as actl ON actl.Activity_log_ID=tc.Activity_Log_ID
		 INNER JOIN Component AS comp ON comp.Drawing_ID=tc.Drawing_ID
		 INNER JOIN Operation AS ope ON ope.Operation_ID=tc.Operation_ID 
		 INNER JOIN Machine as mach ON mach.Machine_ID=actl.Machine_ID
		  ORDER BY Start_Date_Time DESC LIMIT 20;";
		
	}
//print($query);

$res=mysql_query($query) or die(mysql_error());
$r=mysql_num_rows($res);
if($r!=0)
{
	$c="q";
print("<table cellspacing=\"1\">");
print("<tr class=\"t\"><th>Machine</th><th>Drawing No and Name</th><th>Change Date and Time</th>
			<th>Tool Description</th><th>Tool Dia</th><th>Tool Condition</th><th>Reason For Change</th><th>Remarks</th></tr>");
while($row=mysql_fetch_assoc($res))
{

print("<tr class=\"$c\">
			<td>$row[Machine_Name]</td><td>$row[Drawing_NO] $row[Component_Name]</td><td>$row[Start_Date_Time]</td>
			<td>$row[Tool_Desc]</td><td>$row[Tool_Dia]</td><td>$row[New_Tool]</td><td>$row[Change_Reason]</td>
			<td>$row[Remarks]</td></tr>");
	if($c=="q"){$c="s";}else{$c="q";}
}
print("</table>");
}
else {
	print("No tools Changed For This Component");
}
?>