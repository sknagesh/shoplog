  $(document).ready(function(){
	var phpfile="test.php";
  	$("#activity").load('get_activity.php');  //load activity list from get_activity.php

	$("#submit").click(function(event) {

	 if($("#addlog").valid())
  	{
	  	event.preventDefault();  ///we are preventing the form submitting as we are using ajax to dynamically submitting
		$.ajax({
      					data: $('#addlog').serializeArray(),
      					type: "POST",
      					url: phpfile,
      					success: function(html) {
				document.getElementById("footer2").innerHTML=html;
				$('#addlog')[0].reset();
      							}
    							});
  	}

		});
		
	$('#activity').click(function(){
	var aid=$('#Activity_ID').val();
	if(aid==1)  //production
	{
		var url="production_log.html";
		phpfile="production_log.php";
	}else
	if(aid==2)  //setup: as there is no difference we are using production_log.html and php files
	{
		var url="production_log.html";
		phpfile="production_log.php";
	}else
	if(aid==3) //rework: as there is no difference we are using production_log.html and php files
	{
		var url="production_log.html";
		phpfile="production_log.php";

	}else
	if(aid==4)  //fixture work
	{
		var url="fixturework_log.html";
		phpfile="fixturework_log.php";
	}else
	if(aid==5) //breakdown maintenance
	{
		var url="breakdown_log.html";
		phpfile="breakdown_log.php";
	}else
	if(aid==6) //preventive maintenance
	{
		var url="breakdown_log.html";
		phpfile="breakdown_log.php";
	}else
	if(aid==7) //power Failure
	{
		var url="powerfailure_log.html";
		phpfile="powerfailure_log.php";
	}else
	if(aid==8) //machine idle
	{
		var url="machineidle_log.html";
		phpfile="machineidle_log.php";
	}else
	if(aid==9) //rejection log
	{
		var url="rejection_log.html";
		phpfile="rejection_log.php";
	}else
	if(aid==10) //rejection log
	{
		var url="toolchange_log.html";
		phpfile="toolchange_log.php";
	}else
		if(aid==11) //FAI
	{
		var url="fai_log.html";
		phpfile="fai_log.php";
	}else
		if(aid==12) //one of job
	{
		var url="fixturework_log.html";
		phpfile="fixturework_log.php";
	}else
		if(aid==14) //CMM inspection
	{
		var url="production_log.html";
		phpfile="production_log.php";
	}else
		if(aid==15) //Non Conformance Report
	{
		var url="non_conformance_log.html";
		phpfile="non_conformance_log.php";
	}


	$('#fields').load(url);

	});		
 


  });
