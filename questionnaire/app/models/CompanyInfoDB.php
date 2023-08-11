<?php

include_once("DbConfig.php");

class CompanyInfoDB extends DBConfig
{
    private $querySelect;
    private $resultData;
    
    public function __construct()
	{
        parent::__construct();
    }

    public function createQuery($key, $keyValue)
    {
        $this->querySelect ="SELECT `companyname`,`companylogo` FROM `company` where ".$key. " = '".$keyValue."'";
    }

    public function createQueryConfig($key, $keyValue,$imgPath)
    {
        $this->querySelect = "SELECT `companyname`, CONCAT('".$imgPath."',`companylogo`) as companylogo FROM `company` where ".$key. " = '".$keyValue."'";
    }

    public function createQueryLogo($key,$keyValue,$imgPath) 
    {
        $this->querySelect ="SELECT `companyname`, CONCAT('".$imgPath."', companylogo) as companylogo  FROM `company` where ".$key. " = '".$keyValue."'";
    }    
   
    public function createQueryLogoWhitelabel($key,$keyValue,$imgPath) 
    {
        $this->querySelect ="SELECT `companyname`, CONCAT('".$imgPath."', companylogo) as companylogo  FROM `company` where ".$key. " = '".$keyValue."' and whitelabel = 1";
        // echo $this->querySelect;
    } 

    public function fetchData($key,$keyValue)
    {
        parent::dbConnect();
        $this->createQuery($key, $keyValue);
        $resultData = parent::selectThis($this->querySelect);

        return $resultData;
    } 

    public function fetchDataCustom($key,$keyValue,$imgPath)
    {
        parent::dbConnect();
        $this->createQueryConfig($key, $keyValue,$imgPath);
        $resultData = parent::selectThis($this->querySelect);

        return $resultData;
    }

    public function fetchDataLogo($key,$keyValue,$imgPath)
    {
        parent::dbConnect();
        $this->createQueryLogo($key, $keyValue,$imgPath);
        $resultData = parent::selectThis($this->querySelect);

        return $resultData;
    }
    
    public function fetchDataLogoWhitelabel($key,$keyValue,$imgPath)
    {
        parent::dbConnect();
        $this->createQueryLogoWhitelabel($key, $keyValue,$imgPath);
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

    // $cidb = new CompanyInfoDB();
    // $data = $cidb->fetchData("companyid","819");

    // print_r($cidb->getJsonData($data));

?>