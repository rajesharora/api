<?php
class BaseController
{
    public function hasData($dataSet)
    {
        $numrow = $dataSet->num_rows;

        return $numrow;
    }

    public function getDBStatus($dataSet)
    {
        $numrow = $dataSet->num_rows;

        $message = "Some other issues";
        $status = -1;

        if($numrow == 0)
        {
            $message = "No Data Found";
            $status = 0;
        }
        elseif($numrow > 0)
        {
            $message = "Data Fetched";
            $status = 1;            
        }   
        
        $dbstatus = array("Status"=>$status, "message"=>$message);

        return $dbstatus;
    }

    public function getDBStatusCustom($dataSet,$s_init,$s_zero,$s_greater,$m_init,$m_zero,$m_greater)
    {
        $dbstatus = array();

        $numrow = $dataSet->num_rows;

        $message =  $m_init;
        $status = $s_init;

        if($numrow == 0)
        {
            $message = $m_zero;
            $status = $s_zero;
        }
        elseif($numrow > 0)
        {
            $message = $m_greater;
            $status = $s_greater;            
        }   
        
        $dbstatus = array("Status"=>$status, "message"=>$message);

        return $dbstatus;
    }    

    public function getDBUpdateStatus($dataSet,$s_init,$s_zero,$s_greater,$m_init,$m_zero,$m_greater)
    {
        $dbstatus = array();

        $numrow = $dataSet->num_rows;

        $message =  $m_init;
        $status = $s_init;

        if($numrow == 0)
        {
            $message = $m_zero;
            $status = $s_zero;
        }
        elseif($numrow > 0)
        {
            $message = $m_greater;
            $status = $s_greater;            
        }   
        
        $dbstatus = array("Status"=>$status, "message"=>$message);

        return $dbstatus;
    }

}
?>