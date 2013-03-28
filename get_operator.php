<?php
include('dewdb.inc');
$cxn = mysql_connect($dewhost,$dewname,$dewpswd) or die(mysql_error());
mysql_select_db('ShopLog',$cxn) or die("error opening db: ".mysql_error());
if(isSet($_GET['opeid'])){$opeid=$_GET['opeid'];}else{$opeid="";}
$query="SELECT * FROM Operator;";
print("<label for=\"draw\">Select Operator</label>");
print("<select name=\"Operator_ID\" id=\"Operator_ID\" class=\"required\">");
echo '<option value="">Select Name</option>';
$resa = mysql_query($query, $cxn) or die(mysql_error($cxn));
while ($row = mysql_fetch_assoc($resa))
{
	if($row['Operator_ID']==$opeid){$sel="selected=\"selected\"";}else{$sel="";}
echo "<option value=".$row['Operator_ID']." $sel >";
echo "$row[Operator_Name]</option>";
}
print("</select>");



?>