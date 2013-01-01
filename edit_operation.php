<?php
include('dewdb.inc');
$cxn = mysql_connect($dewhost,$dewname,$dewpswd) or die(mysql_error());
mysql_select_db('ShopLog',$cxn) or die("error opening db: ".mysql_error());
//print_r($_POST);
//print_r($_FILES);
$opid=$_GET['opid'];

$query="SELECT * FROM Operation WHERE Operation_ID=$opid;";

//print($query);

$res=mysql_query($query) or die(mysql_error());

$result=mysql_affected_rows();
if($result!=0)
{
while ($row = mysql_fetch_assoc($res))
{
	print($row['Operation_Desc']);
}

	
}else
	{
		print("Error");
	}


?>