<?php
include('dewdb.inc');
$cxn = mysql_connect($dewhost,$dewname,$dewpswd) or die(mysql_error());
mysql_select_db('ShopLog',$cxn) or die("error opening db: ".mysql_error());
//print_r($_POST);
//print_r($_FILES);
$custid=$_POST['Customer_ID'];
$drawingno=$_POST['drawingno'];
$componentname=$_POST['componentname'];

$query="INSERT INTO Component  (Customer_ID,
								Drawing_NO,
								Component_Name) ";
$query.="VALUES('$custid',
				'$drawingno',
				'$componentname');";

//print($query);

$res=mysql_query($query) or die(mysql_error());

$result=mysql_affected_rows();
if($result!=0)
{
print("Added new Component $componentname - $drawingno");	
	
}else
	{
		print("Error Adding");
	}


?>