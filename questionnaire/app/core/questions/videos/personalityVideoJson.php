<?php
include "../../../db/DbConfig.php";
include "VideosClass.php";

	header("Content-Type: application/json");	

	$jsdata=json_decode(file_get_contents('php://input'),true);
	
	$userId=$jsdata['userId'];
	$testType = $jsdata['testType'];	
	$language = $jsdata['language'];
	
	$classObject = new VideosClass();
	$classObject->$videoUri =  "https://tryonjobs.s3.amazonaws.com/jobvideos/mp4/sc001.mp4";
	$arrayObjects = array("videoUrl" => $classObject->$videoUri);

	

	$jsonQues = json_encode($arrayObjects);
	
	echo $jsonQues;
	
	//$dbc->dbDisconnect();
?>	
