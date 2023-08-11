<?php
	include_once("../controllers/users/UserController.php");
	include_once("../core/validations/DataValidator.php");

	ini_set('default_charset','UTF-8');  

	header("Access-Control-Allow-Credentials:true");
	header("Access-Control-Allow-Headers:Content-Type, Authorization");
	header("Access-Control-Allow-Methods:GET, POST, OPTIONS, PUT, DELETE");
	header("Access-Control-Allow-Origin:*");
	header("Content-Type:application/json; charset=utf-8");
	header("Content-Type: application/json");	
	
	$jsdata=json_decode(file_get_contents('php://input'),true);
	$linkid=$jsdata['linkid']; 
	$languageid=$jsdata['languageid'];     

	$validate = new Data_Validator();

	$validate->set('linkid', $linkid)->is_required();
	$validate->set('languageid', $languageid)->is_required();

	if($validate->validate()){
		//All fields have been validated

		$uc = new UserController();   		
		
		print_r($uc->fetchLinkDetatils($linkid));		
   }
   else{
		//Some data has not been validated
		$error = $validate->get_errors(); 		
	    
		// http_response_code(400);

		$errors = array("Status"=>"0","errors"=>$error);

		print_r(json_encode($errors));
   }
	
	
	
// 	$uc = new UserController();   

// //	print_r($uc->getUserBasicInfo("202901","819"));

// 	print_r($uc->fetchLinkDetatils($linkid));
?>
