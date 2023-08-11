<?php

include_once("../../models/TestDB.php");

class TestController
{
    private $error;
    private $success;

    public function __construct() {       
            
    }

    public function setError($error)
    {
        $this->error = $error;
    }

    public function setSuccess($success)
    {
        $this->success = $success;
    }    

    public function getError()
    {
        return $this->error;
    }

    public function getSuccess()
    {
        return $this->success;
    }   
    
    
    public function getTestInfo($tid)
    {
        $tdb = new TestDB();        

        $data = $tdb->fetchData("Test_TestId",$tid);
        $a = $tdb->getData($data);  
      
        $responseData = array("testinfo"=>$a);
      
        $response = array("status"=>1,"message"=>"Data Fetched","data"=>$responseData);

        $jsonResponse = json_encode($response); 
    
        return $jsonResponse;
    }  
    
    public function getInstructions($tid)
    {
        $tdb = new TestDB();        

        $data = $tdb->fetchInstructions("Test_TestId",$tid);
        $a = $tdb->getData($data);  
      
        $responseData = array("testinfo"=>$a);
      
        $response = array("status"=>1,"message"=>"Data Fetched","data"=>$responseData);

        $jsonResponse = json_encode($response); 
    
        return $jsonResponse;
    }

}

?>
