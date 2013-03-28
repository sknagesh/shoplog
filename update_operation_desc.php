<?php
include('dewdb.inc');
$cxn = mysql_connect($dewhost,$dewname,$dewpswd) or die(mysql_error());
mysql_select_db('ShopLog',$cxn) or die("error opening db: ".mysql_error());
//print_r($_POST);

$opid=$_POST['Operation_ID'];
$newdesc=$_POST['opedit'];

$query="UPDATE Operation SET Operation_Desc='$newdesc' WHERE Operation_ID=$opid;";

//print($query);

$res=mysql_query($query) or die(mysql_error());

$result=mysql_affected_rows();
if($result!=0)
{
print("Updated operation with new Desciption");

	
}else
	{
		print("Error");
	}


?>