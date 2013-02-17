<?php
include('dewdb.inc');
$cxn = mysql_connect($dewhost,$dewname,$dewpswd) or die(mysql_error());
mysql_select_db('ShopLog',$cxn) or die("error opening db: ".mysql_error());
if(isSet($_GET['ncid'])){$ncid=$_GET['ncid'];}else{$ncid="";}
$query="SELECT * FROM NC_Status;";
print("<label for=\"draw\">Select NC Status</label>");
print("<select name=\"Status_ID\" id=\"Status_ID\" class=\"required\">");
echo '<option value="">Select NC Status</option>';
$resa = mysql_query($query, $cxn) or die(mysql_error($cxn));
while ($row = mysql_fetch_assoc($resa))
{
	if($row['Status_ID']==$ncid){$sel="selected=\"selected\"";}else{$sel="";}
echo "<option value=".$row['Status_ID']." $sel >";
echo "$row[Status]</option>";
}
print("</select>");



?>