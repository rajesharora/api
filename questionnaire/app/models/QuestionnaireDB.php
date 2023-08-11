<?php

include_once("../models/QuestionnaireDB.php");

include_once("DbConfig.php");

class QuestionnaireDB extends DBConfig
{
    private $querySelect;
    private $resultData;
    
    public function __construct()
	{
        parent::__construct();
    }

    public function createQuery($key, $keyValue,$uri)
    {
        $this->querySelect = "SELECT  `site_video_id` as id,`site_video_sdescription` as short_description, `site_video_ldescription` as long_description, CONCAT('".$uri."',site_video_mp4)  as mp4, CONCAT('".$uri."',site_video_webm)  as webm   FROM `site_video_tbl` WHERE ". $key." = '".$keyValue."'";
       // echo $this->querySelect;
    }
    
    public function fetchIntroVideo($vid, $vidValue,$uri)
    {
        parent::dbConnect();
	    $this->createQuery($vid, $vidValue,$uri);
        $resultData = parent::selectThis($this->querySelect);

        return $resultData;
    }     

    public function getJsonData($data)
    {
		header("Content-Type: application/json");

        $jsonObj =  array(); 
        foreach($data as $val)
        {        
            $jsonData = $jsonData.json_encode($val);
            
            $jsonObj[] =  $jsonData;    		
        }

        return $jsonObj;
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

    public function fetchPersonalityQuestions($uid, $langid)
    {
        parent::dbConnect();
        $query= "SELECT `Que_QuestionId` as id, `Que_QuestionText` as question_text FROM `questions_tbl` WHERE `Que_TraitId` = 2";        
    //    echo $query;
        $resultData = parent::selectThis($query);

        return $resultData;
    }


    public function fetchPersonalityOptions($uid, $langid)
    {
        parent::dbConnect();
        $query= "SELECT `testanswerposition` as position,`testanswertext` as  text, `testanswervalue` as value_returned FROM `testanswer_tbl`";        
     //   echo $query;
        $resultData = parent::selectThis($query);

        return $resultData;
    } 
    
    public function fetchCognitiveQuestions($uid, $langid)
    {
        parent::dbConnect();
        $query= "SELECT `Que_QuestionId` as id, `Que_QuestionText` as question_text FROM `questions_tbl` WHERE `Que_TraitId` = 2";        
    //    echo $query;
        $resultData = parent::selectThis($query);

        return $resultData;
    }   
    
    public function fetchCognitiveOptions($uid, $langid)
    {
        parent::dbConnect();
        $query= "SELECT `testanswerposition` as position,`testanswertext` as  text, `testanswervalue` as value_returned FROM `testanswer_tbl`";        
      //  echo $query;
        $resultData = parent::selectThis($query);

        return $resultData;
    } 

    Public function personality($testid,$language){
        
        $personalityanswers = "SELECT
            testanswerposition AS 'Position',
            testanswertext AS 'Text',
            testanswervalue AS 'Value_returned'
            from testanswer_tbl;
            -- where testid = $testtype
            -- and testanswerlanguage = $language";

        $personality = "SELECT 
                  TestQue_QuestionId AS 'ID',
                  TestQue_Sequence AS 'Order',
                  Que_QuestionText AS 'Question_text'

                  from test_tbl 
                  inner join testquestions_tbl on Test_TestId = TestQue_TestId 
                  inner join questions_tbl on Que_QuestionId=TestQue_QuestionId 
                  where  Test_TestId = ".$testid." order by testQue_sequence";

    //   echo $personality;
        parent::dbConnect();
        
        $resultData[0] = parent::selectThis($personality);
        $resultData[1] = parent::selectThis($personalityanswers);
    
    return $resultData;		
  }    
    
    
    
	Public function cognitive($testid,$language,$quesPath){
        $cogQuery = "SELECT  
                TestQue_QuestionId as 'ID',
                TestQue_Sequence as 'Order',
                CASE when Que_QuestionText =''  THEN '' ELSE Que_QuestionText END as 'Question_text',
                CASE when RTRIM(LTRIM(CogQue_QuestionImage)) LIKE  '%.jpg'  THEN CONCAT('".$quesPath."',CogQue_QuestionImage) ELSE '' END  as 'Question_Image',
                CogQue_IsImageAnswer as 'Answer_is_Image',
                CASE when RTRIM(LTRIM(CogQue_Option1)) LIKE '%.jpg'  THEN CONCAT('".$quesPath."',CogQue_Option1) ELSE  CogQue_Option1 END as 'A' ,
                CASE when RTRIM(LTRIM(CogQue_Option1)) LIKE '%.jpg'  THEN CONCAT('".$quesPath."',CogQue_Option2) ELSE  CogQue_Option2 END as 'B',
                CASE when RTRIM(LTRIM(CogQue_Option1)) LIKE '%.jpg'  THEN CONCAT('".$quesPath."',CogQue_Option3) ELSE  CogQue_Option3 END as 'C',
                CASE when RTRIM(LTRIM(CogQue_Option1)) LIKE '%.jpg'  THEN CONCAT('".$quesPath."',CogQue_Option4) ELSE  CogQue_Option4 END as 'D',
                CASE when RTRIM(LTRIM(CogQue_Option1)) LIKE '%.jpg'  THEN CONCAT('".$quesPath."',CogQue_Option5) ELSE  CogQue_Option5 END as 'E',
                CASE RTRIM(LTRIM(CogQue_Option1)) WHEN ''  THEN 'FALSE' ELSE  'TRUE' END as 'A_Visible' ,
                CASE RTRIM(LTRIM(CogQue_Option2)) WHEN ''  THEN 'FALSE' ELSE  'TRUE' END as 'B_Visible' ,
        CASE RTRIM(LTRIM(CogQue_Option3)) WHEN ''  THEN 'FALSE' ELSE  'TRUE' END as 'C_Visible' ,
            CASE RTRIM(LTRIM(CogQue_Option4)) WHEN ''  THEN 'FALSE' ELSE  'TRUE' END as 'D_Visible' ,
        CASE RTRIM(LTRIM(CogQue_Option5)) WHEN ''  THEN 'FALSE' ELSE  'TRUE' END as 'E_Visible' 
            from  test_tbl 
            inner join testquestions_tbl on Test_TestId= TestQue_TestId   
            inner join questions_tbl on Que_QuestionId=TestQue_QuestionId 
            inner join cognitivequestions_tbl on CogQue_QuestionId=Que_QuestionId 
            where que_questiontype='COGNITIVE' and Test_TestId = ".$testid."  and 
            TestQue_Deleted ='False' 
            order by TestQue_Sequence";

 //       echo $cogQuery;
        parent::dbConnect();
        $resultData = parent::selectThis($cogQuery);

//         $cognitive2 = parent::selectThis($cogQuery);
          
//         $coginstruct = parent::selectThis(
//                               "SELECT 
//                               Test_Instruction AS 'Test_Instruction'
//                               from test_tbl 
//                               where  Test_TestId = 1");	

//         $cogduration = parent::selectThis(
//                               "SELECT 
//                               Test_CogTestDuration AS 'Test_Duration'
//                               from test_tbl 
//                               where  Test_TestId = 1");	

//         $cogvideoinstruction = parent::selectThis("
//                             select 
//                               sv.site_video_id AS 'ID',
//                               sv.site_video_sdescription AS 'Short_Description',
//                               sv.site_video_ldescription AS 'Long_Description',
//                               CONCAT(ps.mp4_base_url,sv.site_video_mp4) AS 'mp4',
//                               CONCAT(ps.webm_base_url,sv.site_video_webm) AS 'webm'
//                               from product_site_tbl ps
//                               Join site_video_use_tbl svu ON (svu.website_id = ps.website_id)
//                               Join site_video_tbl sv ON (sv.site_video_id = svu.site_video_id)
//                               where sv.site_video_sdescription = 'Cognitive Intro' and ps.product_category = 0 and (sv.archived = ps.archived = svu.archived = 0)");


//                       $c = $cognitive2 ->rows;
//                       $json["success"] = true;
//                       $json["testtype"] = "1";
//                       $json["Instructions"] = $coginstruct->row;
//                       $json['duration'] = $cogduration->row;						
//                       $json["Test_video"]  =  array($cogvideoinstruction->rows);
// //						$json["Image_location"] = 'https://csquestionnaire.s3.amazonaws.com/images/';
//                       $json["Questionnaire_Type"] = array("Cognitive",$c);
    
    return $resultData;		
  }      

    
}

?>
