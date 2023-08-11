<?php

include_once("DbConfig.php");

class QuestionnaireAssignmentDB extends DBConfig
{
    private $querySelect;
    private $resultData;
    
    public function __construct()
	{
        parent::__construct();
    }

    public function createQuery($key, $keyValue)
    {
        $this->querySelect ="SELECT `test_id` FROM `questionnaire_assignment` WHERE ".$key. " = '".$keyValue."'";
        return $this->querySelect;
    }

    public function createQueryComapanyId($key, $keyValue)
    {
        $this->querySelect ="SELECT `assigned_by` as companyid FROM `questionnaire_assignment` WHERE ".$key. " = '".$keyValue."'";
     //  echo $this->querySelect;
        return $this->querySelect;
    }
   

    public function updateStartDate($uid,$testid,$stDate)
    {
        parent::dbConnect();

        $sql = "UPDATE `questionnaire_assignment` SET `date_started`='".$stDate."' where `useraccountid`=".$uid." and `test_id`=".$testid;

        $result = parent::updateData($sql);

//        echo "Result : ".$reesult;

        return $result;   
    }
    

    public function fetchData($key,$keyValue)
    {
        parent::dbConnect();
        $this->createQuery($key, $keyValue);
        $resultData = parent::selectThis($this->querySelect);

        return $resultData;
    } 


    public function fetchComapanyId($key,$keyValue)
    {
        parent::dbConnect();
        $this->createQueryComapanyId($key, $keyValue);
        $resultData = parent::selectThis($this->querySelect);

        return $resultData;
    }     

    public function displayArrayData($data)
    {
        foreach($data as $val)
        {
            print_r($val);
        }
    }  
    
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

    public function getTestId($uid)
    {
        $query = $this->createQuery("useraccountid", $uid);   

        $field = "test_id";
        parent::dbConnect();
        $tid = parent::getSingleValue($query,$field);

        return $tid;
    }
  

}

/*     $qadb = new QuestionnaireAssignmentDB();
    $data = $qadb->updateStartDate("202903",4,"2023-07-05 12:51:50");


    //  $data = $qadb->getTestId("202903");

     echo $data; */

?>
