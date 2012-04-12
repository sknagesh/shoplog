<?php
include('dewdb.inc');
$cxn = mysql_connect($dewhost,$dewname,$dewpswd) or die(mysql_error());
mysql_select_db('ShopLog',$cxn) or die("error opening db: ".mysql_error());
//print_r($_POST);
if(isSet($_GET['cid'])){$cid=$_GET['cid'];}else{$cid="";}
$query="SELECT * FROM Customer;";
$resa = mysql_query($query, $cxn) or die(mysql_error($cxn));
print("<label for=\"draw\">Select Customer</label>");
print("<td><select name=\"Customer_ID\" id=\"Customer_ID\" class=\"required\">");
echo '<option value="">Select Customer</option>';
while ($row = mysql_fetch_assoc($resa))
{
	if($row['Customer_ID']==$cid){$sel="selected=\"selected\"";}else{$sel="";}
echo "<option value=".$row['Customer_ID']." $sel >";
echo "$row[Customer_Name]</option>";
}
print("</select></td>");



?>