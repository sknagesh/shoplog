<?php
include('dewdb.inc');
$cxn = mysql_connect($dewhost,$dewname,$dewpswd) or die(mysql_error());
mysql_select_db('ShopLog',$cxn) or die("error opening db: ".mysql_error());
//print_r($_GET);
$lid=$_GET['lid'];


$q="SELECT prod.Activity_Log_ID, Machine_ID, comp.Customer_ID, prod.Drawing_ID,Operation_ID,
	Operator_ID, DATE_FORMAT(Start_Date_Time,'%d-%m-%Y %h:%i:%s %p') as sdt, DATE_FORMAT(End_Date_time,'%d-%m-%Y %h:%i:%s %p') as edt,Quantity,Remarks,Program_NO FROM Production as prod
	INNER JOIN ActivityLog as actl ON actl.Activity_Log_ID=prod.Activity_Log_ID 
	INNER JOIN Component as comp ON comp.Drawing_ID=prod.Drawing_ID 
	INNER JOIN Customer as cust on cust.Customer_ID=comp.Customer_ID 
	WHERE prod.Activity_Log_ID='$lid';";

//print($q);
$resa = mysql_query($q, $cxn) or die(mysql_error($cxn));

$noofrecords=mysql_affected_rows();
if($noofrecords!=0)
{
	$row=mysql_fetch_assoc($resa);
	$mid=$row['Machine_ID'];
	$cid=$row['Customer_ID'];
	$did=$row['Drawing_ID'];
	$oid=$row['Operation_ID'];
	$opeid=$row['Operator_ID'];
	$sdt=$row['sdt'];
	$edt=$row['edt'];
	$qty=$row['Quantity'];
	$remark=$row['Remarks'];
	$pno=$row['Program_NO'];
	
	//machine
	$query="SELECT * FROM Machine;";
	$resa = mysql_query($query, $cxn) or die(mysql_error($cxn));
	print("<p><label>Select Machine</label>");
	print("<select name=\"Machine_ID\" id=\"Machine_ID\" class=\"required\">");
	echo '<option value="">Select Machine</option>';
	while ($row = mysql_fetch_assoc($resa))
	{
		if($row['Machine_ID']==$mid){$sel="selected=\"selected\"";}else{$sel="";}
	echo "<option value=".$row['Machine_ID']." $sel >";
	echo "$row[Machine_Name]</option>";
	}
	print("</select></p>");
		
	//customer
	$query="SELECT * FROM Customer;";
	$resa = mysql_query($query, $cxn) or die(mysql_error($cxn));
	print("<div id=\"customer\">");
	print("<p><label for=\"draw\">Select Customer</label>");
	print("<select name=\"Customer_ID\" id=\"Customer_ID\" class=\"required\">");
	echo '<option value="">Select Customer</option>';
	while ($row = mysql_fetch_assoc($resa))
	{
		if($row['Customer_ID']==$cid){$sel="selected=\"selected\"";}else{$sel="";}
	echo "<option value=".$row['Customer_ID']." $sel >";
	echo "$row[Customer_Name]</option>";
	}
	print("</select></p></div>");

	//drawing
	$query="SELECT * FROM Component WHERE Customer_ID='$cid';";
	print("<div id=\"drawing\">");
	print("<p><label for=\"draw\">Select Drawing</label>");
	print("<select name=\"Drawing_ID\" id=\"Drawing_ID\" class=\"required\">");
	echo '<option value="">Select Drawing</option>';
	$resa = mysql_query($query, $cxn) or die(mysql_error($cxn));
	while ($row = mysql_fetch_assoc($resa))
	{
			if($row['Drawing_ID']==$did){$sel="selected=\"selected\"";}else{$sel="";}
	echo "<option value=".$row['Drawing_ID']." $sel >";
	echo "$row[Drawing_NO] - $row[Component_Name]</option>";
	}
	print("</select></div>");
		
	//operation
	$query="SELECT * FROM Operation WHERE Drawing_ID='$did';";
	print("<div id=\"operation\">");
	print("<label for=\"draw\">Select Operation</label>");
	print("<select name=\"Operation_ID\" id=\"Operation_ID\" class=\"required\">");
	echo '<option value="">Select Operation</option>';
	$resa = mysql_query($query, $cxn) or die(mysql_error($cxn));
	while ($row = mysql_fetch_assoc($resa))
	{
		if($row['Operation_ID']==$oid){$sel="selected=\"selected\"";}else{$sel="";}
	echo "<option value=".$row['Operation_ID']." $sel >";
	echo "$row[Operation_Desc]</option>";
	}
	print("</select></div>");
		
	//operator
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

     print("<p><label>Start Date Time</label>");
     print("<input type=\"text\" id=\"sdate\" name=\"sdate\" size=\"25\" value=\"$sdt\" class=\"required\"/></p>");
	 
	 print("<p><label>End Date Time</label>");
     print("<input type=\"text\" id=\"edate\" name=\"edate\" size=\"25\" value=\"$edt\" class=\"required\"/></p>");

	 print("<p><label>Program No</label>");
     print("<input type=\"text\" id=\"pno\" name=\"pno\" size=\"25\" value=\"$pno\" class=\"required\"/></p>");
	
	 print("<p><label>Production Quantity</label>");
     print("<input type=\"text\" id=\"qty\" name=\"qty\" size=\"25\" value=\"$qty\" class=\"required number\"/></p>");

	 print("<p><label>Remarks</label>");
     print("<textarea name=\"remark\" rows=\"4\" cols=\"50\" id=\"remarks\"  >$remark</textarea>"); 

   print("<p><input class=\"submit\" id=\"submit\" type=\"submit\" value=\"Submit\"/></p>");
	
}else

{print("No Log Entry with this ID Found");}



?>
