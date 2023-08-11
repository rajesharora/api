<?php

header("Access-Control-Allow-Methods: *");
class QuestionClass
{
	public $quesId;
	public $quesText;
	
	function setQuesId($qid)
	{
		$quesId = $qid;		
	}
	
	function setQuesText($qText)
	{
		$quesText = $qText;		
	}
	
	function getQuesId()
	{
		return $quesId;;		
	}
	
	function getQuesText()
	{
		return $quesText;
	}	
	
	function setQuestion($qid,$qText)
	{
		$quesId = $qid;
		$quesText = $qText;
	}
}				
?>		
