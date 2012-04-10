<?php
include('dewdb.inc');
$cxn = mysql_connect($dewhost,$dewname,$dewpswd) or die(mysql_error());
mysql_select_db('ShopLog',$cxn) or die("error opening db: ".mysql_error());
$mid=$_GET['mid'];
//print($mid);


$query="SELECT DATE_FORMAT(End_Date_Time,'%d/%m/%Y %h:%i %p')as edt FROM ActivityLog WHERE Machine_ID='$mid' AND Activity_ID IN(1,2,3,4,5,6,8) ORDER BY End_Date_Time DESC LIMIT 1;";

$resa = mysql_query($query, $cxn) or die(mysql_error($cxn));
while ($row = mysql_fetch_assoc($resa))
{
	print($row['edt']);
}

?>