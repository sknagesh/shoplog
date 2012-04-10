<?php
include('dewdb.inc');
$cxn = mysql_connect($dewhost,$dewname,$dewpswd) or die(mysql_error());
mysql_select_db('ShopLog',$cxn) or die("error opening db: ".mysql_error());
$drawingd=$_GET['drawingid'];
//print_r($_POST);
$query="SELECT * FROM Operation WHERE Drawing_ID='$drawingd';";
print("<label for=\"draw\">Select Operation</label>");
print("<select name=\"Operation_ID\" id=\"Operation_ID\" class=\"required\">");
echo '<option value="">Select Operation</option>';
$resa = mysql_query($query, $cxn) or die(mysql_error($cxn));
while ($row = mysql_fetch_assoc($resa))
{
echo "<option value=".$row['Operation_ID'].">";
echo "$row[Operation_Desc]</option>";
}
print("</select>");



?>