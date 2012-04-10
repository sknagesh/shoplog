<?php
include('dewdb.inc');
$cxn = mysql_connect($dewhost,$dewname,$dewpswd) or die(mysql_error());
mysql_select_db('ShopLog',$cxn) or die("error opening db: ".mysql_error());
//print_r($_POST);
$query="SELECT * FROM Machine;";
$resa = mysql_query($query, $cxn) or die(mysql_error($cxn));
print("<td><select name=\"Machine_ID\" id=\"Machine_ID\" class=\"required\">");
echo '<option value="">Select Machine</option>';
while ($row = mysql_fetch_assoc($resa))
{
echo "<option value=".$row['Machine_ID'].">";
echo "$row[Machine_Name]</option>";
}
print("</select></td>");



?>