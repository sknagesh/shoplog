<?php
include('dewdb.inc');
$cxn = mysql_connect($dewhost,$dewname,$dewpswd) or die(mysql_error());
mysql_select_db('ShopLog',$cxn) or die("error opening db: ".mysql_error());
//print_r($_POST);
$query="SELECT * FROM ToolType;";
$resa = mysql_query($query, $cxn) or die(mysql_error($cxn));
print("<label for=\"draw\">Select Tool Type</label>");
print("<td><select name=\"Tool_Type_ID\" id=\"Tool_Type_ID\" class=\"required\">");
echo '<option value="">Select Tool Type</option>';
while ($row = mysql_fetch_assoc($resa))
{
echo "<option value=".$row['Tool_Type_ID'].">";
echo "$row[Tool_Type]</option>";
}
print("</select></td>");



?>