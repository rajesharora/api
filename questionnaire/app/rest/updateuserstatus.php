<?php
	include_once("../controllers/users/UserController.php");	
	include_once("../core/validations/DataValidator.php");

	header("Access-Control-Allow-Credentials:true");
	header("Access-Control-Allow-Headers:Content-Type, Authorization");
	header("Access-Control-Allow-Methods:GET, POST, OPTIONS, PUT, DELETE");
	header("Access-Control-Allow-Origin:*");
	header("Content-Type:application/json; charset=utf-8");
	header("Content-Type: application/json");
	
	$jsdata=json_decode(file_get_contents('php://input'),true);
	$useraccountid=$jsdata['useraccountid'];    
	$questionnaire_status=$jsdata['questionnaire_status']; 

	$validate = new Data_Validator();

	$validate->set('useraccountid', $useraccountid)->is_required();
	$validate->set('questionnaire_status', $questionnaire_status)->is_required();


	if($validate->validate()){
		//All fields have been validated

		$uc = new UserController();   		
		
		print_r($uc->updateUserStatus($useraccountid,$questionnaire_status));
   }
   else{
		//Some data has not been validated
		$error = $validate->get_errors(); 

		$errors = array("Status"=>"0","errors"=>$error);

		print_r(json_encode($errors));
   }

//	print_r($uc->updateUserStatus("202901","819"));

	
?>
