<?php
include "../../db/DbConfig.php";
include "QuestionClass.php";

	header("Content-Type: application/json");	

	$dbc = new Dbconfig();

	$jsdata=json_decode(file_get_contents('php://input'),true);
	$noq=$jsdata['noofquestions'];	

	$sqlQuery = "SELECT * FROM questions_tbl LIMIT ". $noq;
		
	$dbc->dbConnect(); 

	$records = $dbc->selectThis($sqlQuery);

	$quesObjects  =  array(); 

	while ($result = $records->fetch_assoc())
	{
		$quesObject = new QuestionClass();
		$quesObject->quesId = $result['Que_QuestionId'];
		$quesObject->quesText = $result['Que_QuestionText'];		

		$quesObjects[] = $quesObject;			

		$jsonQues = json_encode($quesObjects);		
		
	}
	echo $jsonQues;
	
	$dbc->dbDisconnect();
?>		
