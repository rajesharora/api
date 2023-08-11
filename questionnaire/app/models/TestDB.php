<?php

include_once("DbConfig.php");

class TestDB extends DBConfig
{
    private $querySelect;
    private $resultData;
    
    public function __construct()
	{
        parent::__construct();
    }

    public function createQuery($key, $keyValue)    
    {
    	//$sql = "SELECT Test_TestName as questionnaire_name, Test_TestType as questionnaire_type FROM `test_tbl` WHERE `Test_TestId` = 1";
        $this->querySelect ="SELECT Test_TestName as questionnaire_name, Test_TestType as questionnaire_type, Test_TestId as testid FROM `test_tbl` WHERE ".$key. " = '".$keyValue."'";
    }

    public function createQueryInst($key, $keyValue)    
    {
    	//$sql = "SELECT `Test_Instruction` FROM `test_tbl` WHERE Test_TestId = \'1\'";
        $this->querySelect ="SELECT `Test_Instruction` as test_instruction,  Test_TestId as testid  FROM `test_tbl` WHERE ".$key. " = '".$keyValue."'";
    }  
    
    public function createQueryDuration($key, $keyValue)    
    {
    	//$sql = "SELECT `Test_Instruction` FROM `test_tbl` WHERE Test_TestId = \'1\'";
        $this->querySelect ="SELECT `Test_CogTestDuration` as test_duration FROM `test_tbl` WHERE ".$key. " = '".$keyValue."'";
    }      

    public function fetchData($key,$keyValue)
    {
        parent::dbConnect();
        $this->createQuery($key, $keyValue);
        $resultData = parent::selectThis($this->querySelect);

        return $resultData;
    } 

    public function fetchInstructions($key,$keyValue)
    {
        parent::dbConnect();
        $this->createQueryInst($key, $keyValue);
        $resultData = parent::selectThis($this->querySelect);

        return $resultData;
    }     

    public function fetchDuration($key,$keyValue)
    {
        parent::dbConnect();
        $this->createQueryDuration($key, $keyValue);
        $resultData = parent::selectThis($this->querySelect);

        return $resultData;
    }         

    public function getData($data)
    {
		header("Content-Type: application/json");

        $jsonObj =  array(); 
        foreach($data as $val)
        {        
            $jsonData = $val;
            
            $jsonObj[] =  $jsonData;    		
        }

        return $jsonObj;
    }


    // public function getVideoId($uid)
    // {
    //     $query = "$this->querySelect ="SELECT Test_TestName as questionnaire_name, Test_TestType as questionnaire_type FROM `test_tbl` WHERE ".$key. " = '".$keyValue."'";";
        
    //     $this->createQuery("useraccountid", $uid);   

    //     $field = "Test_TestType";
    //     parent::dbConnect();
    //     $tid = parent::getSingleValue($query,$field);

    //     return $tid;
    // }      
}

?>
