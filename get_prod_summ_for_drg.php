<?php
include('dewdb.inc');
$cxn = mysql_connect($dewhost,$dewname,$dewpswd) or die(mysql_error());
mysql_select_db('ShopLog',$cxn) or die("error opening db: ".mysql_error());
$drawid=$_GET['drawingid'];
if(isSet($_GET['bid'])){$bid=$_GET['bid'];}else{$bid="";}
if($drawid=='')
{

$query="SELECT cust.Customer_Name,
SUM(CASE WHEN Activity_ID=1 THEN TIMESTAMPDIFF(minute,Start_Date_Time,End_Date_Time) END) AS Production,
SUM(CASE WHEN Activity_ID=2 THEN TIMESTAMPDIFF(minute,Start_Date_Time,End_Date_Time) END) AS Setup,
SUM(CASE WHEN Activity_ID=3 THEN TIMESTAMPDIFF(minute,Start_Date_Time,End_Date_Time) END) AS Rework,
SUM(TIMESTAMPDIFF(minute,Start_Date_Time,End_Date_Time)) AS Total From Production as prod INNER JOIN ActivityLog as actl ON actl.Activity_Log_ID=prod.Activity_Log_ID
INNER JOIN Component as comp on comp.Drawing_ID=prod.Drawing_ID
INNER JOIN Customer as cust ON cust.Customer_ID=comp.Customer_ID WHERE Start_Date_Time BETWEEN DATE_SUB(NOW(), INTERVAL 60 DAY) AND NOW() GROUP BY cust.Customer_ID";
}
else {
$query="SELECT cust.Customer_Name,
SUM(CASE WHEN Activity_ID=1 THEN TIMESTAMPDIFF(minute,Start_Date_Time,End_Date_Time) END) AS Production,
SUM(CASE WHEN Activity_ID=2 THEN TIMESTAMPDIFF(minute,Start_Date_Time,End_Date_Time) END) AS Setup,
SUM(CASE WHEN Activity_ID=3 THEN TIMESTAMPDIFF(minute,Start_Date_Time,End_Date_Time) END) AS Rework,
SUM(TIMESTAMPDIFF(minute,Start_Date_Time,End_Date_Time)) AS Total From Production as prod INNER JOIN ActivityLog as actl ON actl.Activity_Log_ID=prod.Activity_Log_ID
INNER JOIN Component as comp on comp.Drawing_ID=prod.Drawing_ID
INNER JOIN Customer as cust ON cust.Customer_ID=comp.Customer_ID 
WHERE prod.Drawing_ID=$drawid AND Batch_ID='$bid' GROUP BY cust.Customer_ID";
	


}

//print($query);



$res=mysql_query($query) or die(mysql_error());
$r=mysql_affected_rows();

if($drawid=='')
{
	print("<br>Work Hours for all Customers for last 60 Days");
		
	print("<br><br><table cellspacing=\"1\">");
	print("<tr class=\"t\"><th>Customer</th><th>Production</th><th>Set Up</th><th>Rework</th><th>Total</th></tr>");

	$c="q";	

	while($row=mysql_fetch_assoc($res))
	{
		if($row[Production]!=''){$p=min2hm($row[Production]);}else{$p='';}
		if($row[Setup]!=''){$s=min2hm($row[Setup]);}else{$s='';}
		if($row[Reowrk]!=''){$rw=min2hm($row[Rework]);}else{$rw='';}
		if($row[Total]!=''){$t=min2hm($row[Total]);}else{$t='';}
	print("<tr class=\"$c\"><td>$row[Customer_Name]</td><td>$p</td><td>$s</td><td>$rw</td><td>$t</td></tr>");
	if($c=="q"){$c="s";}else{$c="q";}

	}
		
	
}
else {

		if($r==0)
		{
			print("No records for this Drawing");
		}else
			{
			$es=explode("-",$bid);
			$l=count($es)-1;
	
			print("<br>Batch Quantity : $es[$l] Nos");
			print("<br><br><table cellspacing=\"1\">");
			print("<tr class=\"t\"><th>Customer</th><th>Production</th><th>Set Up</th><th>Rework</th><th>Total</th></tr>");

			$c="q";	

			while($row=mysql_fetch_assoc($res))
			{

		if($row[Production]!=''){$p=min2hm($row[Production]);}else{$p='';}
		if($row[Setup]!=''){$s=min2hm($row[Setup]);}else{$s='';}
		if($row[Reowrk]!=''){$rw=min2hm($row[Rework]);}else{$rw='';}
		if($row[Total]!=''){$t=min2hm($row[Total]);}else{$t='';}
		print("<tr class=\"$c\"><td>$row[Customer_Name]</td><td>$p</td><td>$s</td><td>$rw</td><td>$t</td></tr>");
		if($c=="q"){$c="s";}else{$c="q";}
	
				}
			}
}
?>