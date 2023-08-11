<?php
	include_once("../controllers/questionnaire/QuestionnaireController.php");
	
	header("Access-Control-Allow-Credentials:true");
	header("Access-Control-Allow-Headers:Content-Type, Authorization");
	header("Access-Control-Allow-Methods:GET, POST, OPTIONS, PUT, DELETE");
	header("Access-Control-Allow-Origin:*");
	header("Content-Type:application/json; charset=utf-8");
	header("Content-Type: application/json");
	
	$jsdata=json_decode(file_get_contents('php://input'),true);
	$uid=$jsdata['useraccountid'];   
	$lang=$jsdata['languageid'];     
	
	$qc = new QuestionnaireController();   

	//$sql = "SELECT `test_id` FROM `questionnaire_assignment` WHERE  `useraccountid` = \'202903\'";".$key. " = '".$keyValue."'";

	print_r($qc->getIntroduction($uid,$lang));
?>
