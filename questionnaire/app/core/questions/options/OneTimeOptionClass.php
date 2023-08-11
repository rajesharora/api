<?php

header("Access-Control-Allow-Methods: *");
class OneTimeOptionClass
{
	public $optionTyoe;
	public $noOfOptions;
	public $options = array();

	function setOptionTyoe($otype)
	{
		$optionTyoe = $otype;		
	}
	
	function setNoOfOptions($noOfOpt)
	{
		$noOfOptions = $noOfOpt;		
	}

	function setOptions($opts)
	{
		$options = $opts;
	}

	function getOptionTyoe()
	{
		return $optionTyoe;
	}	
	
	function getNoOfOptions()
	{
		return $noOfOptions;		
	}
	
	function getOptions()
	{
		return $options;
	}	
}				
?>		
