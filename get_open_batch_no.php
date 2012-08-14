<?php
include('dewdb.inc');
$cxn = mysql_connect($dewhost,$dewname,$dewpswd) or die(mysql_error());
mysql_select_db('ShopLog',$cxn) or die("error opening db: ".mysql_error());
$drawingd=$_GET['drawingid'];
if(isSet($_GET['oid'])){$oid=$_GET['oid'];}else{$oid="";}
//print_r($_POST);
$query="SELECT * FROM Component WHERE Drawing_ID='$drawingd';";
$resa = mysql_query($query, $cxn) or die(mysql_error($cxn));
$row = mysql_fetch_assoc($resa);
$qmsid=$row['QMS_Comp_ID'];

$cxn2 = mysql_connect($dewhost,$dewname,$dewpswd) or die(mysql_error());
mysql_select_db('Inspection',$cxn2) or die("error opening db: ".mysql_error());

$query2="SELECT Batch_Desc FROM Batch_NO WHERE Drawing_ID=$qmsid AND Batch_Under_Progress=1;";



print("<label for=\"bno\">Select Batch ID</label>");
print("<select name=\"Batch_ID\" id=\"Batch_ID\" class=\"required\">");
echo '<option value="">Select Batch NO</option>';
$resa2 = mysql_query($query2, $cxn2) or die(mysql_error($cxn2));
while ($row2 = mysql_fetch_assoc($resa2))
{
	
echo "<option value=".$row2['Batch_Desc'].">".$row2[Batch_Desc]."</option>";
}
print("</select>");



?>