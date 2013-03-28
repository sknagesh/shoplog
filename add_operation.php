<?php
include('dewdb.inc');
$cxn = mysql_connect($dewhost,$dewname,$dewpswd) or die(mysql_error());
mysql_select_db('ShopLog',$cxn) or die("error opening db: ".mysql_error());
$drawid=$_POST['Drawing_ID'];
$opedesc=$_POST['opdesc'];

$query="INSERT INTO Operation (Drawing_ID,
								Operation_Desc) 
	 						VALUES('$drawid',
									'$opedesc');";

//print($query);

$res=mysql_query($query) or die(mysql_error());

$result=mysql_affected_rows();
if($result!=0)
{
print("Added new Operaton $opedesc");	
	
}else
	{
		print("Error Adding");
	}


?>