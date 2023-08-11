<?php

include_once("../../models/ParticipantAnswerTblDB.php");

class AnswerController
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
    
    public function insertPersonalityAnswers($requestjson)
    {        
        unset($data);
        $data  = $requestjson;

        //print_r($data);
        
        $testtype = $data['testtype'];
        $useraccountid = $data['useraccountid'];
        $datetime = $data['datetime'];
        $submit = $data['submit']; 
        $testid = $data['testid'];

        $answers = $data['answers']; 

       // echo $answers;

        $resultArray = array();

        $objdb = new ParticipantAnswerTblDB();   

        $rowCount = count($answers);

        $noOfInsertedRecords = 0;
        $noOfNotInsertedRecords = 0;
        $successStatus = 1;
        $successMessage = "Success";

        for ($i=0; $i < count($answers); $i++){    
            $answer = array("useraccountid"=>$useraccountid,"testtype"=>$testtype,"testid"=>$testid, "question_id"=>$answers[$i]['question_id'],"answer"=>$answers[$i]['answer'], "datetime"=>$datetime);       
            $result = $objdb->insertPersonalityAnswers($answer);
            if($result)
            {
                $noOfInsertedRecords++;                
            }
            else
            {
                $noOfNotInsertedRecords++;
            }

            $resultArray[] = array($answers[$i]['question_id']=>$result);
        }

        if($noOfInsertedRecords > 0 && $noOfNotInsertedRecords == 0)
        {   $successStatus = 1;
            $successMessage = "Success";
        }elseif ($noOfInsertedRecords > 0 && $noOfNotInsertedRecords > 0)
        {
            $successStatus = 2;
            $successMessage = "Partial Success";            
        }elseif ($noOfInsertedRecords == 0 && $noOfNotInsertedRecords > 0)
        {
            $successStatus = 0;
            $successMessage = "Errot";            
        }

     //   $responseData = array("Counts :"=>array({"Insert Record":$noOfInsertedRecords},{"Not Inserted Records":$noOfNotInsertedRecords}),"Row Insert Response"=>$resultArray);
        $rowStatus = array("Records"=>$rowCount,"Insert Record"=>$noOfInsertedRecords,"Not Inserted Records"=>$noOfNotInsertedRecords);

        $responseData = array("Counts"=>$rowStatus,"Row Insert Response"=>$resultArray);
      
        $response = array("status"=>$successStatus,"message"=>$successMessage,"data"=>$responseData);

        $jsonResponse = json_encode($response); 
    
        return $jsonResponse;        
    }  
    
    

    public function insertCognitiveAnswers($requestjson)
    {        
        unset($data);
        $data  = $requestjson;

        //print_r($data);
        
        $testtype = $data['testtype'];
        $useraccountid = $data['useraccountid'];
        $datetime = $data['datetime'];
        $submit = $data['submit']; 
        $testid = $data['testid'];

        $answers = $data['answers']; 

       // echo $answers;

        $resultArray = array();

        $objdb = new ParticipantAnswerTblDB();   

        $rowCount = count($answers);

        $noOfInsertedRecords = 0;
        $noOfNotInsertedRecords = 0;
        $successStatus = 1;
        $successMessage = "Success";

        for ($i=0; $i < count($answers); $i++){    
            $answer = array("useraccountid"=>$useraccountid,"testtype"=>$testtype,"testid"=>$testid, "question_id"=>$answers[$i]['question_id'],"answer"=>$answers[$i]['answer'], "datetime"=>$datetime);       
            $result = $objdb->insertCognitiveAnswer($answer);
            if($result)
            {
                $noOfInsertedRecords++;                
            }
            else
            {
                $noOfNotInsertedRecords++;
            }

            $resultArray[] = array($answers[$i]['question_id']=>$result);
        }

        if($noOfInsertedRecords > 0 && $noOfNotInsertedRecords == 0)
        {   $successStatus = 1;
            $successMessage = "Success";
        }elseif ($noOfInsertedRecords > 0 && $noOfNotInsertedRecords > 0)
        {
            $successStatus = 2;
            $successMessage = "Partial Success";            
        }elseif ($noOfInsertedRecords == 0 && $noOfNotInsertedRecords > 0)
        {
            $successStatus = 0;
            $successMessage = "Errot";            
        }

     //   $responseData = array("Counts :"=>array({"Insert Record":$noOfInsertedRecords},{"Not Inserted Records":$noOfNotInsertedRecords}),"Row Insert Response"=>$resultArray);
        $rowStatus = array("Records"=>$rowCount,"Insert Record"=>$noOfInsertedRecords,"Not Inserted Records"=>$noOfNotInsertedRecords);

        $responseData = array("Counts"=>$rowStatus,"Row Insert Response"=>$resultArray);
      
        $response = array("status"=>$successStatus,"message"=>$successMessage,"data"=>$responseData);

        $jsonResponse = json_encode($response); 
    
        return $jsonResponse;        
    }    
}
?>