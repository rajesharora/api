<?php

include_once("DbConfig.php");

class UserAssociationDB extends DBConfig
{
    private $querySelect;
    private $resultData;
    
    public function __construct()
	{
        parent::__construct();
    }

    public function createQuery($key, $keyValue)
    {
        $this->querySelect ="SELECT `companyid` FROM `user_association` where ".$key. " = '".$keyValue."'";
    }

    public function fetchData($key,$keyValue)
    {
        parent::dbConnect();
        $this->createQuery($key, $keyValue);
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

}

//     $uadb = new UserAssociationDB();
//     $data = $uadb->fetchData("useraccountid","202901");

//     print_r($uadb->getJsonData($data));

?>
