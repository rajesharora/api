<?php
    
    include_once("../../models/QuestionnaireAssignmentDB.php");
    

class QuestionnaireAssignmentController
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
    
    public function updateStartDate($uid,$testid,$startDate)
    {
        $qadb = new QuestionnaireAssignmentDB();
        $data = $qadb->updateStartDate($uid,$testid,$startDate);     

      //  $a = $qadb->getData($data);  
      
        $responseData = array("updatestatus"=>$data);
      
        $response = array("status"=>1,"message"=>"Start Date Updated","data"=>$responseData);

        $jsonResponse = json_encode($response); 
    
        return $jsonResponse;
    }    
}

//    $uc = new UserController();   
//    print_r($uc->getUserBasicInfo("202901","819"));

//    $uc = new UserController();   
//    print_r($uc->fetchLinkDetatils("9UDOnU3EsyQoNI6U2Ile"));



?>
