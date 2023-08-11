<?php

class UserInfoCore
{
    private $userlink;
    private $languageid;
    
    private $useraccountid;
    private $compamyid;
    private $username;     
    private $inviteeid; 
    private $questionnairestatus; 
    private $questionnairestatusdate; 
    private $landingassessmentid;
    private $companyname;
    private $compnaylogo;


    /* setter methods of member variabkes */
    
    public function setUserLink($userlink)
    {
        $this->userlink = $userlink;
    }    

    public function setUserAccountId($useraccountid)
    {
        $this->useraccountid = $useraccountid;
    }

    public function setCompanyId($compamyid)
    {
        $this->compamyid = $compamyid;
    }
    
    public function setLanguageId($languageid)
    {
        $this->languageid = $languageid;
    }
    
    public function setUserName($username)
    {
        $this->username = $useraccusernameountid;
    }

    public function setInviteeId($inviteeid)
    {
        $this->inviteeid = $inviteeid;
    }    

    public function setQuestionnaireStatus($questionnairestatus)
    {
        $this->questionnairestatus = $questionnairestatus;
    }
    
    public function setQuestionnaireStatusDate($questionnairestatusdate)
    {
        $this->questionnairestatusdate = $questionnairestatusdate;
    }
    
    public function setLandingAssessmentId($landingassessmentid)
    {
        $this->landingassessmentid = $landingassessmentid;
    }
    
    public function setCompanyName($companyname)
    {
        $this->companyname = $companyname;
    }

    public function setCompanyLogo($useraccompnaylogocountid)
    {
        $this->compnaylogo = $compnaylogo;        
    }


    /* getter methods of member variabkes */
    
    public function getUserLink()
    {
        return $this->userlink;
    }     

    public function getUserAccountId($useraccountid)
    {
        return $this->useraccountid;
    }

    public function getCompanyId($compamyid)
    {
        return $this->compamyid;
    }
    
    public function getLanguageId($languageid)
    {
        return $this->languageid;
    }

    public function getInviteeId($inviteeid)
    {
        return $this->inviteeid;
    }    
    
    public function getUserName($username)
    {
        return $this->username;
    }

    public function getQuestionnaireStatus($questionnairestatus)
    {
        return $this->questionnairestatus;
    }
    
    public function getQuestionnaireStatusDate($questionnairestatusdate)
    {
        return $this->questionnairestatusdate;
    }
    
    public function getLandingAssessmentId($landingassessmentid)
    {
        return $this->landingassessmentid;
    }
    
    public function getCompanyName($companyname)
    {
        return $this->companyname;
    }

    public function getCompanyLogo($useraccompnaylogocountid)
    {
        return $this->compnaylogo;  
    }
}
?>
