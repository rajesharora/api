<?php

include_once("DbConfig.php");

class ParticipantAnswerTblDB extends DBConfig
{
    private $querySelect;
    private $resultData;
    private $queryInsert;
    
    public function __construct()
	{
        parent::__construct();
        parent::dbConnect();
   }

   
// Personality Answers Insert   
   
   public function createQueryPersonalityInsert($answer)
    {
        $this->queryInsert = "INSERT INTO participantanswer_tbl 
        SET participantid = ".$answer['useraccountid'].
            ",testtype = ".$answer['testtype'].
            ",testid = ".$answer['testid'].
            ", questionid = ".$answer['question_id'].
            ", answer = '".$answer['answer'].
            "', date_added = '".$answer['datetime']."'";     
    }

    public function insertPersonalityAnswer($answer)
    {        
        $this->createQueryPersonalityInsert($answer);
        $resultData = parent::InsertData($this->queryInsert);
  
        return $resultData;     
    }  

    public function insertPersonalityAnswers($requestjson)
    {
        unset($json["error"]);
        unset($data);
        $data  = json_decode($requestjson);
        
        $testtype = $data->testtype;
        $useraccountid = $data->useraccountid;
        $datetime = $data->datetime;
        $submit = $data->submit; 
        $testid = $data['testid'];

        $answers = $data->answers; 

        $resultArray = array();
        $noOfInsertedRecords = 0;
        $noOfNotInsertedRecords = 0;
        for ($i=0; $i < count($answers); $i++){    
            $answers[$i]->question_id;    
            $answers[$i]->answer;    
            $answer = array("useraccountid"=>$useraccountid,"testtype"=>$testtype,"testid"=>$testid, "question_id"=>$answers[$i]->question_id,"answer"=>$answers[$i]->answer, "datetime"=>$datetime);       
            
            $resultArray[] = $this->insertPersonalityAnswer($answer);
        }

        return $resultArray;
    }
  
// Cognitive Answers Insert

    public function createQueryCognitiveInsert($answer)
    {
        $this->queryInsert = "INSERT INTO participantanswer_tbl 
        SET participantid = ".$answer['useraccountid'].    
            ",testtype = ".$answer['testtype'].      
            ",testid = ".$answer['testid'].
            ", questionid = ".$answer['question_id'].
            ", answer = '".$answer['answer'].
            "', date_added = '".$answer['datetime']."'";     
        // echo $this->queryInsert;
    }


    public function insertCognitiveAnswer($answer)
    {        
        $this->createQueryCognitiveInsert($answer);
        $resultData = parent::InsertData($this->queryInsert);
  
        return $resultData;     
    }  

    public function insertCognitiveAnswers($requestjson)
    {
        unset($json["error"]);
        unset($data);
        $data  = json_decode($requestjson);
        
        $testtype = $data->testtype;
        $useraccountid = $data->useraccountid;
        $datetime = $data->datetime;
        $submit = $data->submit; 
        $testid = $data['testid'];

        $answers = $data->answers; 

        $resultArray = array();
        $noOfInsertedRecords = 0;
        $noOfNotInsertedRecords = 0;
        for ($i=0; $i < count($answers); $i++){    
            $answers[$i]->question_id;    
            $answers[$i]->answer;    
            $answer = array("useraccountid"=>$useraccountid,"testtype"=>$testtype,"testid"=>$testid, "question_id"=>$answers[$i]->question_id,"answer"=>$answers[$i]->answer, "datetime"=>$datetime);       
            
            $resultArray[] = $this->insertCognitiveAnswer($answer);
        }

        return $resultArray;
    }   
    
    

// Common for all type of Answers

    
    public function getJsonData($data)
    {
		header("Content-Type: application/json");

        $jsonObj =  array(); 
        foreach($data as $val)
        {        
            $jsonData = json_encode($val);
            $jsonObj[] = $jsonData;    		
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
            $jsonObj[] = $jsonData;    		
        }

        return $jsonObj;
    }

}

// Sample End Points and Call for Personality Questions

/*
    $inputData ='{
        "useraccountid": "260",
        "answers": [
           {
              "answer": "A",
              "question_id": "122"
           },
           {
              "answer": "B",
              "question_id": "139"
           },
           {
              "answer": "A",
              "question_id": "110"
           },
           {
              "answer": "B",
              "question_id": "146"
           },
           null,
           {
              "answer": "C",
              "question_id": "107"
           },
           {
              "answer": "C",
              "question_id": "86"
           },
           {
              "answer": "B",
              "question_id": "123"
           },
           {
              "answer": "C",
              "question_id": "135"
           },
           {
              "answer": "C",
              "question_id": "112"
           },
           {
              "answer": "C",
              "question_id": "147"
           },
           {
              "answer": "B",
              "question_id": "106"
           },
           {
              "answer": "C",
              "question_id": "94"
           },
           {
              "answer": "D",
              "question_id": "158"
           },
           {
              "answer": "E",
              "question_id": "124"
           },
           {
              "answer": "F",
              "question_id": "134"
           },
           {
              "answer": "F",
              "question_id": "111"
           },
           {
              "answer": "E",
              "question_id": "148"
           },
           {
              "answer": "D",
              "question_id": "102"
           },
           {
              "answer": "C",
              "question_id": "18"
           },
           {
              "answer": "B",
              "question_id": "159"
           },
           {
              "answer": "A",
              "question_id": "125"
           },
           {
              "answer": "B",
              "question_id": "144"
           },
           {
              "answer": "C",
              "question_id": "116"
           },
           {
              "answer": "D",
              "question_id": "149"
           },
           {
              "answer": "E",
              "question_id": "108"
           },
           {
              "answer": "D",
              "question_id": "81"
           },
           {
              "answer": "C",
              "question_id": "160"
           },
           {
              "answer": "B",
              "question_id": "126"
           },
           {
              "answer": "C",
              "question_id": "137"
           },
           {
              "answer": "D",
              "question_id": "114"
           },
           {
              "answer": "E",
              "question_id": "150"
           },
           {
              "answer": "F",
              "question_id": "104"
           },
           {
              "answer": "E",
              "question_id": "75"
           },
           {
              "answer": "D",
              "question_id": "161"
           },
           {
              "answer": "C",
              "question_id": "127"
           },
           {
              "answer": "C",
              "question_id": "145"
           },
           {
              "answer": "C",
              "question_id": "113"
           },
           {
              "answer": "D",
              "question_id": "152"
           },
           {
              "answer": "E",
              "question_id": "105"
           },
           {
              "answer": "D",
              "question_id": "87"
           },
           {
              "answer": "C",
              "question_id": "162"
           },
           {
              "answer": "B",
              "question_id": "130"
           },
           {
              "answer": "A",
              "question_id": "142"
           },
           {
              "answer": "B",
              "question_id": "115"
           },
           {
              "answer": "C",
              "question_id": "151"
           },
           {
              "answer": "D",
              "question_id": "100"
           },
           {
              "answer": "E",
              "question_id": "11"
           },
           {
              "answer": "F",
              "question_id": "163"
           },
           {
              "answer": "E",
              "question_id": "133"
           },
           {
              "answer": "E",
              "question_id": "140"
           },
           {
              "answer": "D",
              "question_id": "118"
           },
           {
              "answer": "D",
              "question_id": "156"
           },
           {
              "answer": "C",
              "question_id": "109"
           },
           {
              "answer": "B",
              "question_id": "93"
           },
           {
              "answer": "A",
              "question_id": "164"
           },
           {
              "answer": "B",
              "question_id": "128"
           },
           {
              "answer": "C",
              "question_id": "138"
           },
           {
              "answer": "D",
              "question_id": "120"
           },
           {
              "answer": "E",
              "question_id": "155"
           },
           {
              "answer": "D",
              "question_id": "98"
           },
           {
              "answer": "C",
              "question_id": "95"
           },
           {
              "answer": "D",
              "question_id": "169"
           },
           {
              "answer": "C",
              "question_id": "131"
           },
           {
              "answer": "D",
              "question_id": "143"
           },
           {
              "answer": "E",
              "question_id": "119"
           },
           {
              "answer": "D",
              "question_id": "153"
           },
           {
              "answer": "C",
              "question_id": "101"
           },
           {
              "answer": "B",
              "question_id": "97"
           },
           {
              "answer": "A",
              "question_id": "165"
           },
           {
              "answer": "A",
              "question_id": "129"
           },
           {
              "answer": "B",
              "question_id": "141"
           },
           {
              "answer": "C",
              "question_id": "117"
           },
           {
              "answer": "D",
              "question_id": "154"
           },
           {
              "answer": "E",
              "question_id": "99"
           },
           {
              "answer": "F",
              "question_id": "91"
           },
           {
              "answer": "E",
              "question_id": "166"
           },
           {
              "answer": "D",
              "question_id": "132"
           },
           {
              "answer": "D",
              "question_id": "136"
           },
           {
              "answer": "C",
              "question_id": "121"
           },
           {
              "answer": "C",
              "question_id": "157"
           },
           {
              "answer": "C",
              "question_id": "103"
           },
           {
              "answer": "C",
              "question_id": "96"
           }
        ],
        "datetime": "2023-07-10 11:46:56",
        "submit": true,
        "testtype": "2"
     }';
     
     
     $objdb = new ParticipantAnswerTblDB();
     $data = $objdb->insertPersonalityAnswers($inputData);     
     echo "Data : ".print_r($data);
 */ 
/* 
 $inputData ='{
   "action": "2",
   "useraccountid": 260,
   "answers": [
     {
       "answer": "",
       "question_id": "23"
     },
     {
       "answer": "A",
       "question_id": "24"
     },
     {
       "answer": "",
       "question_id": "67"
     },
     {
       "answer": "",
       "question_id": "25"
     },
     {
       "answer": "",
       "question_id": "70"
     },
     {
       "answer": "",
       "question_id": "26"
     },
     {
       "answer": "",
       "question_id": "27"
     },
     {
       "answer": "",
       "question_id": "28"
     },
     {
       "answer": "",
       "question_id": "68"
     },
     {
       "answer": "",
       "question_id": "29"
     },
     {
       "answer": "",
       "question_id": "69"
     },
     {
       "answer": "",
       "question_id": "30"
     },
     {
       "answer": "",
       "question_id": "71"
     },
     {
       "answer": "",
       "question_id": "31"
     },
     {
       "answer": "",
       "question_id": "32"
     },
     {
       "answer": "",
       "question_id": "33"
     },
     {
       "answer": "",
       "question_id": "72"
     },
     {
       "answer": "",
       "question_id": "34"
     },
     {
       "answer": "",
       "question_id": "35"
     },
     {
       "answer": "",
       "question_id": "36"
     },
     {
       "answer": "",
       "question_id": "44"
     },
     {
       "answer": "",
       "question_id": "37"
     },
     {
       "answer": "",
       "question_id": "38"
     },
     {
       "answer": "",
       "question_id": "39"
     },
     {
       "answer": "",
       "question_id": "1"
     },
     {
       "answer": "",
       "question_id": "40"
     },
     {
       "answer": "",
       "question_id": "9"
     },
     {
       "answer": "",
       "question_id": "41"
     },
     {
       "answer": "",
       "question_id": "73"
     },
     {
       "answer": "",
       "question_id": "42"
     },
     {
       "answer": "",
       "question_id": "43"
     },
     {
       "answer": "",
       "question_id": "45"
     },
     {
       "answer": "",
       "question_id": "2"
     },
     {
       "answer": "",
       "question_id": "46"
     },
     {
       "answer": "",
       "question_id": "47"
     },
     {
       "answer": "",
       "question_id": "48"
     },
     {
       "answer": "",
       "question_id": "49"
     },
     {
       "answer": "",
       "question_id": "50"
     },
     {
       "answer": "",
       "question_id": "66"
     },
     {
       "answer": "",
       "question_id": "51"
     },
     {
       "answer": "",
       "question_id": "52"
     },
     {
       "answer": "",
       "question_id": "65"
     },
     {
       "answer": "",
       "question_id": "53"
     },
     {
       "answer": "",
       "question_id": "54"
     },
     {
       "answer": "",
       "question_id": "55"
     },
     {
       "answer": "",
       "question_id": "64"
     },
     {
       "answer": "",
       "question_id": "56"
     },
     {
       "answer": "",
       "question_id": "57"
     },
     {
       "answer": "",
       "question_id": "58"
     },
     {
       "answer": "",
       "question_id": "63"
     },
     {
       "answer": "",
       "question_id": "59"
     },
     {
       "answer": "",
       "question_id": "60"
     },
     {
       "answer": "",
       "question_id": "61"
     },
     {
       "answer": "",
       "question_id": "62"
     },
     {
       "answer": "",
       "question_id": "5"
     },
     {
       "answer": "",
       "question_id": "10"
     },
     {
       "answer": "",
       "question_id": "7"
     },
     {
       "answer": "",
       "question_id": "21"
     },
     {
       "answer": "",
       "question_id": "12"
     },
     {
       "answer": "",
       "question_id": "22"
     }
   ],
   "datetime": "2023-07-10 11:52:12",
   "submit": true,
   "testid": "1"
 }';

 $objdb = new ParticipantAnswerTblDB();
 $data = $objdb->insertCognitiveAnswers($inputData);     
 echo "Data : ".print_r($data); */
?>