<?php

include_once("DbConfig.php");

class LandingPageDB extends DBConfig
{
    private $querySelect;
    private $resultData;
    
    public function __construct()
	{
        parent::__construct();
    }

    public function createQueryConfig($imgPath, $companyId)
    {
        $this->querySelect ="Select cp.companyname companyname, CONCAT('".$imgPath."', lp.logo) as companylogo \n"

        . "from landingpage lp\n"
    
        . "INNER Join company cp on cp.companyid = lp.companyid\n"
    
        . "WHERE cp.companyid = ".$companyId." and whitelabel = 1";

        //echo $this->querySelect;
    }

    public function fetchData($imgPath,$companyId)
    {
        parent::dbConnect();
        $this->createQueryConfig($imgPath, $companyId);
        $resultData = parent::selectThis($this->querySelect);

        return $resultData;
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

     $lpdb = new LandingPageDB();
     $data = $lpdb->fetchData("http://abc.com/logos/","819");

    print_r($lpdb->getJsonData($data));
?>