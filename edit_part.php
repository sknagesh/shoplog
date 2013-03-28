<?php
include('dewdb.inc');
$cxn = mysql_connect($dewhost,$dewname,$dewpswd) or die(mysql_error());
mysql_select_db('ShopLog',$cxn) or die("error opening db: ".mysql_error());
//print_r($_POST);
//print_r($_FILES);
$drawid=$_POST['Drawing_ID'];
$qmsid=$_POST['qmsid'];

$query="UPDATE Component  SET QMS_Comp_ID=$qmsid WHERE Drawing_ID=$drawid";

//print($query);

$res=mysql_query($query) or die(mysql_error());

$result=mysql_affected_rows();
if($result!=0)
{
print("Updated QMS ID of Component to $qmsid");	
	
}else
	{
		print("Error Updating");
	}


?>