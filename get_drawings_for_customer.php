<?php
include('dewdb.inc');
$cxn = mysql_connect($dewhost,$dewname,$dewpswd) or die(mysql_error());
mysql_select_db('ShopLog',$cxn) or die("error opening db: ".mysql_error());
$custid=$_GET['cid'];
//print_r($_POST);
$query="SELECT * FROM Component WHERE Customer_ID='$custid';";
$resa = mysql_query($query, $cxn) or die(mysql_error($cxn));
$noofdrawings=mysql_affected_rows();
if($noofdrawings!=0)
{
print("<table cellspacing=\"5\" cellborder=\"2\">");
print("<tr><th>Drawing No</th><th>Component Name</th></tr>");
while ($row = mysql_fetch_assoc($resa))
{
print("<tr><td>$row[Drawing_NO]</td><td>$row[Component_Name]</td></tr>");

}
print("</table>");
}else{print("No drawings added for this Customer");}



?>