<?php
include "../../../db/DbConfig.php";
include "OneTimeOptionClass.php";

	header("Content-Type: application/json");	

	$jsdata=json_decode(file_get_contents('php://input'),true);
	$userId=$jsdata['id'];
	$testType = $jsdata['testType'];		
	
	
	$sqlQuery = "SELECT * FROM testanswer_tbl";


	
	$dbc = new Dbconfig();
		
	$dbc->dbConnect(); 

	$records = $dbc->selectThis($sqlQuery);

	$optionObjects  =  array(); 
	$optObject = new OneTimeOptionClass();

	$i = 0;

	while ($result = $records->fetch_assoc())
	{		
		$optObject->options[$i] = $result['testanswertext'];	
		$i = $i + 1;	
	}	

	$optionObjects[0] = $i;
	$optionObjects[1] = $optObject->options;

	$jsonQues = json_encode($optionObjects);
	
	echo $jsonQues;
	
	$dbc->dbDisconnect();
?>	