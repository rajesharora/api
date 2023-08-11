<?php
include "../../db/DbConfig.php";
include "QuestionClass.php";

	header("Content-Type: application/json");	

	$dbc = new Dbconfig();

	$sqlQuery = "SELECT * FROM questions_tbl";
		
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
