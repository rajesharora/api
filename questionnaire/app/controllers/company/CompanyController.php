<?php
       
    include_once("../../models/CompanyInfoDB.php");
    include_once("../../config/ConfifController.php");
    

class CompanyController 
{
    private $error;
    private $success;

    public $cidb;

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
       
    public function getCompanyDetails($cid)
    {
        $cq = new ConfifController();

        $image_pathecho = $cq->IMAGE_PATH(); 

        $cidb = new CompanyInfoDB();  
        $data1 = $cidb->fetchDataLogo("companyid",$cid,$image_pathecho);
        $b = $cidb->getData($data1);  

        
        $responseData = array("UserInfo"=>$a, "CompanyInfo"=>$b);
      
        $response = array("status"=>1,"message"=>"Data Fetched","data"=>$responseData);

        $jsonResponse = json_encode($response); 
    
        return $jsonResponse;
    }

    public function updateUserStatus($uid,$status)
    {
        $uidb = new UserInfoDB();        
        
        $data = $uidb->updateUserStatus($uid,$status);
        $a = $uidb->getData($data);  
      
        $responseData = array("userstatus"=>$a);
      
        $response = array("status"=>1,"message"=>"Status Updated","data"=>$responseData);

        $jsonResponse = json_encode($response); 
    
        return $jsonResponse;
    }    
}

//    $uc = new UserController();   
//    print_r($uc->getUserBasicInfo("202901","819"));

//    $uc = new UserController();   
//    print_r($uc->fetchLinkDetatils("9UDOnU3EsyQoNI6U2Ile"));



?>