<?php

include_once("../models/QuestionnaireDB.php");
include_once("../models/UserInfoDB.php");
include_once("../models/TestDB.php");
include_once("../models/QuestionnaireAssignmentDB.php");
include_once("../../config/ConfifController.php");

class QuestionnaireController
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
    
    
    public function getIntroductionVideo($uid,$langid)
    {
        $qdb = new QuestionnaireDB();  
        
        $qadb = new QuestionnaireAssignmentDB();
        $testType =  "PERSONALITY"; 
        $tid = $qadb->getTestId($uid);  

	    $tdb = new TestDB(); 
        $data2 = $tdb->fetchData("Test_TestId",$tid);

        $row = mysqli_num_rows($data2);
        $testType = "PERSONALITY";
        if($row>0)
        {
            if($result = mysqli_fetch_array($data2))
            {	
                $testType = $result["questionnaire_type"];
            }		
        }        
        
        $a2 = $tdb->getData($data2);         

        $vid = 9;
        if($testType == "PERSONALITY")
        {
            $vid = 9;
        }
        
        if($testType == "COGNITIVE")
        {
            $vid = 10;
        }

        $cq = new ConfifController();

        $uri = $cq->getPATH('INTRO_VIDEO_LOCATION');   
        
        
        $data = $qdb->fetchIntroVideo("site_video_id",$vid,$uri);
        $a = $qdb->getData($data);  

        $uidb = new UserInfoDB(); 

        $data1 = $uidb->fetchData("useraccountid",$uid);
        $a1 = $uidb->getData($data1); 

        
               
      
        $responseData = array("introvideo"=>$a,"userinfo"=>$a1,"testinfo"=>$a2);        
      
        $response = array("status"=>1,"message"=>"Video Fetched","data"=>$responseData);

        $jsonResponse = json_encode($response); 
    
        return $jsonResponse;
    }   

    public function getInstructionVideo($uid,$langid)
    {
        $qdb = new QuestionnaireDB();  
        
        $qadb = new QuestionnaireAssignmentDB();
        $testType =  "PERSONALITY"; 
        $tid = $qadb->getTestId($uid);  

	    $tdb = new TestDB(); 
        $data2 = $tdb->fetchData("Test_TestId",$tid);

        $row = mysqli_num_rows($data2);
        $testType = "PERSONALITY";
        if($row>0)
        {
            if($result = mysqli_fetch_array($data2))
            {	
                $testType = $result["questionnaire_type"];
            }		
        }        
        
        $a2 = $tdb->getData($data2);         

        $vid = 9;
        if($testType == "PERSONALITY")
        {
            $vid = 9;
        }
        
        if($testType == "COGNITIVE")
        {
            $vid = 10;
        }

        $cq = new ConfifController();

        $uri = $cq->getPATH('INSTRUCTION_VIDEO_LOCATION');           
        
        $data = $qdb->fetchIntroVideo("site_video_id",$vid,$uri);
        $a = $qdb->getData($data);  

        $uidb = new UserInfoDB(); 

        $data1 = $uidb->fetchData("useraccountid",$uid);
        $a1 = $uidb->getData($data1); 
      
        $responseData = array("introvideo"=>$a,"userinfo"=>$a1,"testinfo"=>$a2);        
      
        $response = array("status"=>1,"message"=>"Video Fetched","data"=>$responseData);

        $jsonResponse = json_encode($response); 
    
        return $jsonResponse;
    }   


    public function getIntroduction($uid,$langid)
    {
        $qdb = new QuestionnaireDB();  
	
        $qadb = new QuestionnaireAssignmentDB();
        $tid = $qadb->getTestId($uid);  
        
        $tdb = new TestDB(); 
        $data1 = $tdb->fetchData("Test_TestId",$tid);
        $a1 = $tdb->getData($data1);          

        $data2 = $tdb->fetchInstructions("Test_TestId",$tid);
        $a2 = $tdb->getData($data2);                
      
        $responseData = array("testinfo"=>$a1,"instructions"=>$a2);
        
      
        $response = array("status"=>1,"message"=>"Video Fetched","data"=>$responseData);

        $jsonResponse = json_encode($response); 
    
        return $jsonResponse;
    }  
    
    public function getQuestionsPersonality($uid,$langid)
    {
        $qdb = new QuestionnaireDB(); 

        $qadb = new QuestionnaireAssignmentDB();
        $tid = $qadb->getTestId($uid);        
        
       
        $data = $qdb->personality($tid,$langid);
        $a = $qdb->getData($data[0]);        
        $opt = $qdb->getData($data[1]);   

        $tdb = new TestDB(); 
        $data2 = $tdb->fetchData("Test_TestId",$tid);
        $a2 = $tdb->getData($data2);  

        /* Fetching test duration */
        $data1 = $tdb->fetchDuration("Test_TestId",$tid);
        $a1 = $tdb->getData($data1);  
      
        $responseData = array("testinfo"=>$a2,"duration"=>$a1,"options"=>$opt,"questions"=>$a);
        $response = array("status"=>1,"message"=>"Question Fetched","data"=>$responseData);

        $jsonResponse = json_encode($response); 
    
        return $jsonResponse;
    }  
    
    public function getOptionPersonality($uid,$langid)
    {
        $qdb = new QuestionnaireDB();  
       
        $data = $qdb->fetchPersonalityOptions($uid,$langid);
        $a = $qdb->getData($data);  
	    
        $qadb = new QuestionnaireAssignmentDB();
        $tid = $qadb->getTestId($uid);    

        
        $tdb = new TestDB(); 
        $data1 = $tdb->fetchData("Test_TestId",$tid);
        $a1 = $tdb->getData($data1);  
      
        $responseData = array("testinfo"=>$a1,"questions"=>$a);        
      
        $response = array("status"=>1,"message"=>"Question Fetched","data"=>$responseData);

        $jsonResponse = json_encode($response); 
    
        return $jsonResponse;
    }   
    
    public function getQuestionsCognitive($uid,$langid)
    {
        $qdb = new QuestionnaireDB();  

        /* Fetching test_id */
        $qadb = new QuestionnaireAssignmentDB();
        $tid = $qadb->getTestId($uid); 

        /* Fetching config item */
        $cq = new ConfifController();
        $image_path = $cq->QUES_PATH();

        /* Fetching cognitive questions */
        $data = $qdb->cognitive($tid,$langid,$image_path);
        $a = $qdb->getData($data);          

        /* Fetching test info */
        $tdb = new TestDB(); 
        $data2 = $tdb->fetchData("Test_TestId",$tid);
        $a2 = $tdb->getData($data2);  

        /* Fetching test duration */
        $data1 = $tdb->fetchDuration("Test_TestId",$tid);
        $a1 = $tdb->getData($data1);  

        /* Integrating response data in responseData array */      
        $responseData = array("testinfo"=>$a2,"duration"=>$a1,"questions"=>$a);        
        $response = array("status"=>1,"message"=>"Question Fetched","data"=>$responseData);

        /* Converting response data in Json response  */      
        $jsonResponse = json_encode($response); 
           
        return $jsonResponse;
    }
}
?>