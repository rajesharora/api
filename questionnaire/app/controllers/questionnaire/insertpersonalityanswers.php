<?php
	include_once("AnswerController.php");
	
	header("Access-Control-Allow-Credentials:true");
	header("Access-Control-Allow-Headers:Content-Type, Authorization");
	header("Access-Control-Allow-Methods:GET, POST, OPTIONS, PUT, DELETE");
	header("Access-Control-Allow-Origin:*");
	header("Content-Type:application/json; charset=utf-8");
	header("Content-Type: application/json");
	
	$jsdata=json_decode(file_get_contents('php://input'),true);

	$controllerObject = new AnswerController();   	

	$result = $controllerObject->insertPersonalityAnswers($jsdata);

	print_r($result);
?>
