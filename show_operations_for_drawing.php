<?php
include('dewdb.inc');
$cxn = mysql_connect($dewhost,$dewname,$dewpswd) or die(mysql_error());
mysql_select_db('ShopLog',$cxn) or die("error opening db: ".mysql_error());
$drawingid=$_GET['drawingid'];

$query="SELECT * FROM Operation WHERE Drawing_ID='$drawingid';";

//print($query);

$res=mysql_query($query) or die(mysql_error());
$r=mysql_num_rows($res);
if($r!=0)
{
print("<table border=\"1\" cellspacing=\"1\">");
print("<tr><th>Operation ID</th><th>Operation Description</th></tr>");
while($row=mysql_fetch_assoc($res))
{

	print("<tr><td>$row[Operation_ID]</td><td>$row[Operation_Desc]</td></tr>");
	
}
print("</table>");
}
else {
	print("No Operations Added For this Drawing Yet");
}
?>