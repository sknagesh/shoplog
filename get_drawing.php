<?php
include('dewdb.inc');
$cxn = mysql_connect($dewhost,$dewname,$dewpswd) or die(mysql_error());
mysql_select_db('ShopLog',$cxn) or die("error opening db: ".mysql_error());
$custid=$_GET['custid'];
if(isSet($_GET['did'])){$did=$_GET['did'];}else{$did="";}
if(isSet($_GET['hcomp'])){$hcomp=$_GET['hcomp'];}else{$hcomp="";}
//print_r($_POST);
if($hcomp!=1)
{
$query="SELECT * FROM Component WHERE Customer_ID='$custid';";
}else
	{
		$query="SELECT * FROM Component WHERE Customer_ID='$custid' AND Hide_In_Prod=0;";
	}
print("<label for=\"draw\">Select Drawing</label>");
print("<select name=\"Drawing_ID\" id=\"Drawing_ID\" class=\"required\">");
echo '<option value="">Select Drawing</option>';
$resa = mysql_query($query, $cxn) or die(mysql_error($cxn));
while ($row = mysql_fetch_assoc($resa))
{
	if($row['Drawing_ID']==$did){$sel="selected=\"selected\"";}else{$sel="";}
echo "<option value=".$row['Drawing_ID']." $sel >";
echo "$row[Drawing_NO] - $row[Component_Name]</option>";
}
print("</select>");



?>