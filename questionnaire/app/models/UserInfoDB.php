<?php

include_once("DbConfig.php");

class UserInfoDB extends DBConfig
{
    private $querySelect;
    private $resultData;
    
    public function __construct()
	{
        parent::__construct();
    }

    public function createQuery($key, $keyValue)
    {
        $this->querySelect ="Select `useraccountid`,`status` as questionnaire_status,`statusdate` as questionnaire_statusdate,`firstname`,`lastname` from user_accounts where ".$key. " = '".$keyValue."'";
      //  echo $this->querySelect;
    }

    public function createQueryLink($key, $keyValue)
    {
        $this->querySelect ="Select user_accounts.useraccountid as useraccountid,`status` as questionnaire_status, `statusdate` as questionnaire_statusdate,
        `firstname`,`lastname`, `assigned_by` as companyid
        from user_accounts                                     
        inner join questionnaire_assignment on questionnaire_assignment.useraccountid = user_accounts.useraccountid
        where user_accounts.".$key. " = '".$keyValue."' and archive = 0 order by sequence";        
        
       // echo $this->querySelect;
    }    

    public function fetchData($key,$keyValue)
    {
        parent::dbConnect();

        $this->createQuery($key, $keyValue);
        $resultData = parent::selectThis($this->querySelect);        

        return $resultData;
    } 

    public function fetchDataLinkData($key,$keyValue)
    {
        parent::dbConnect();
    
        $this->createQueryLink($key, $keyValue);
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

    public function updateUserStatus($uid,$status)
    {
		header("Content-Type: application/json"); 

        parent::dbConnect();

        $date = new DateTime("NOW");
        
        $sql = "UPDATE `user_accounts` SET `status`= '3', statusdate = '{$date->format('Y-m-d H:i:s')}' WHERE `useraccountid` = '".$uid."' and `status` = '". $status."'";
        
        $result = $this->updateData($sql);

        // $sqlSelect ="SELECT CASE WHEN ROW_COUNT() > 0 THEN 1 ELSE 0 END AS updated";

        $this->querySelect ="Select `useraccountid`,`status` as questionnaire_status,`statusdate` as questionnaire_statusdate from user_accounts WHERE `useraccountid` = '".$uid."'";  
        
        $resultData = parent::selectThis($this->querySelect);

        $jsonObj = $resultData;    

        return $jsonObj;
    } 
    
    public function fetchIntroVideo($uid,$status)
    {
		header("Content-Type: application/json"); 

        parent::dbConnect();

        $this->querySelect = "SELECT  `site_video_id` as id,`site_video_sdescription` as short_description, `site_video_ldescription` as long_description, `site_video_mp4` as mp4,`site_video_webm` as webm   FROM `site_video_tbl` WHERE `site_video_id` = \'9\'";
      
        $resultData = parent::selectThis($this->querySelect);

        $jsonObj = $resultData;    

        return $jsonObj;
    }     
}

?>