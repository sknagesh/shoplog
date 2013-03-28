<?php
include('dewdb.inc');
$cxn = mysql_connect($dewhost,$dewname,$dewpswd) or die(mysql_error());
mysql_select_db('ShopLog',$cxn) or die("error opening db: ".mysql_error());
//print_r($_POST);
$query="SELECT * FROM Activity;";
$resa = mysql_query($query, $cxn) or die(mysql_error($cxn));
print("<td><select name=\"Activity_ID\" id=\"Activity_ID\" class=\"required\">");
echo '<option value="">Select Activity</option>';
while ($row = mysql_fetch_assoc($resa))
{
echo "<option value=".$row['Activity_ID'].">";
echo "$row[Activity_Name]</option>";
}
print("</select></td>");



?>