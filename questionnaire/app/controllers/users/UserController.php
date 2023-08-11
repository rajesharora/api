<?php
    include_once("../core/UserInfoCore.php");
    include_once("../models/UserInfoDB.php");
    include_once("../models/CompanyInfoDB.php");
    include_once("../../config/ConfifController.php");
    include_once("../controllers/BaseController.php");    
    include_once("../models/QuestionnaireAssignmentDB.php");
    
    

class UserController extends UserInfoCore
{
    private $error;
    private $success;    
    public $uidb;
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
  
    
    public function fetchLinkDetatils($userlink)
    {   
        $uidb = new UserInfoDB(); 
        $data = $uidb->fetchDataLinkData("linkid",$userlink);       
        
        $bc = new BaseController();
        $dbresponse = $bc->getDBStatusCustom($data,-1,0,1,"Some other issues","No Paper Assigned","Data Fetched");

        $a = $uidb->getData($data);          
       
        $uid = $a[0]["useraccountid"];
        $cid = $a[0]["companyid"];
        
        $responseData = $this->getUserBasicInfo($uid,$cid);

        $response = array("status"=>$dbresponse,"data"=>$responseData);

        $jsonResponse = json_encode($response);         
        
        return $jsonResponse;
    }
    
    public function getUserBasicInfo($uid,$cid)    
    {
        $cq = new ConfifController();
        $image_path = $cq->IMAGE_PATH(); 
        $referring_url = $cq->getPATH("REFERRING_URL");

        $uidb = new UserInfoDB();
        $data = $uidb->fetchData("useraccountid",$uid);
        $a = $uidb->getData($data);  

        $cidb = new CompanyInfoDB();  
        $data1 = $cidb->fetchDataLogoWhitelabel("companyid",$cid,$image_path);
        $numrow = $data1->num_rows;

        // echo "Numrow - > ".$numrow."  ---- ";
        // print_r($data1);
        
        if($numrow == 0)
        {
            $b[0] = array("companyname"=>$cq->getPATH("REFERRING_NAME"),"companylogo"=>$cq->getPATH("REFERRING_URL"));
        }
        else
        {
            $b = $cidb->getData($data1);  
        }       
        
        $responseData = array("UserInfo"=>$a, "CompanyInfo"=>$b);
    
        return $responseData;
    }

    public function messagesOutput()
    {

    }

    public function updateUserStatus($uid,$status)
    {
        $uidb = new UserInfoDB();        
        
        $data = $uidb->updateUserStatus($uid,$status);

        $bc = new BaseController();
        $dbresponse = $bc->getDBStatusCustom($data,-1,0,1,"Some other issues","Status Not Updated","User Status Updated");        
     //   print_r($dbresponse);

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
