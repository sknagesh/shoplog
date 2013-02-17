<?php
include('dewdb.inc');
$cxn = mysql_connect($dewhost,$dewname,$dewpswd) or die(mysql_error());
mysql_select_db('ShopLog',$cxn) or die("error opening db: ".mysql_error());
if(isSet($_GET['ncid'])){$ncid=$_GET['ncid'];}else{$ncid="";}
$query="SELECT * FROM NCType;";
print("<label for=\"draw\">Select Non Conformance Type</label>");
print("<select name=\"NC_ID\" id=\"NC_ID\" class=\"required\">");
echo '<option value="">Select NC Type</option>';
$resa = mysql_query($query, $cxn) or die(mysql_error($cxn));
while ($row = mysql_fetch_assoc($resa))
{
	if($row['NC_ID']==$ncid){$sel="selected=\"selected\"";}else{$sel="";}
echo "<option value=".$row['NC_ID']." $sel >";
echo "$row[NC_Desc]</option>";
}
print("</select>");



?>