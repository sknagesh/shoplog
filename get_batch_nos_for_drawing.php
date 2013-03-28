<?php
include('dewdb.inc');
$cxn = mysql_connect($dewhost,$dewname,$dewpswd) or die(mysql_error());
mysql_select_db('ShopLog',$cxn) or die("error opening db: ".mysql_error());

if(isSet($_GET['drawingid'])){$drawingid=$_GET['drawingid'];}else{$drawingid="";}

//print_r($_POST);
$query="SELECT distinct(Batch_ID) FROM Production WHERE Drawing_ID='$drawingid';";
print("<label for=\"draw\">Select Batch NO</label>");
print("<select name=\"Batch_ID\" id=\"Batch_ID\" >");
echo '<option value="">Select Batch NO</option>';
$resa = mysql_query($query, $cxn) or die(mysql_error($cxn));

while ($row = mysql_fetch_assoc($resa))
{
echo "<option value=".$row['Batch_ID'].">".$row['Batch_ID']."</option>";
}
print("</select>");



?>