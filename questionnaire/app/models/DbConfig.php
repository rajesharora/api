<?php
class Dbconfig
{
	public $connectionString;
	public $dataSet;
	private $sqlQuery;
	
    protected $hostName;
    protected $userName;
    protected $passWd;
    protected $dbName;
	

    public function __construct()

	{
        // 	$this-> hostName="192.168.200.67"; // Host name 
		// $this-> userName="itneer"; // Mysql username 
		$this-> hostName="localhost"; // Host name 
		$this-> userName="root"; // Mysql username 
		$this-> passWd="Rdev@2022"; // Mysql password 
		$this-> dbName="itneer_ashop"; // Database name 		
    }
	function dbConnect()   
	{
		// Create connection
		$this -> connectionString = mysqli_connect($this->hostName, $this->userName, $this->passWd, $this->dbName);
		// Check connection
		if (!$this -> connectionString)
		{
			die("Connection failed: " . mysqli_connect_error());
		}			
	}

	function dbDisconnect() 
	{
		mysqli_close($this -> connectionString);
		$this -> connectionString = NULL;
		$this -> sqlQuery = NULL;
		$this -> dataSet = NULL;
        $this -> dbName = NULL;
        $this -> hostName = NULL;
        $this -> userName = NULL;
        $this -> passWd = NULL;
	}

function selectThis($query) 
{
	$this->sqlQuery = $query;
	//echo "<br>".$this->sqlQuery;
	$this->dataSet =  mysqli_query($this->connectionString,$this->sqlQuery);
	return $this->dataSet;
}

function selectAll($tableName,$orderbyfield=NULL) 
	{
		$this -> sqlQuery = 'SELECT * FROM '.$this -> dbName.'.'.$tableName;
		if($orderbyfield != NULL)
		{
			$this -> sqlQuery = 'SELECT * FROM '.$this -> dbName.'.'.$tableName . ' order by '.$orderbyfield ;
		}
		$this -> dataSet =  mysqli_query($this -> connectionString,$this -> sqlQuery);
        return $this -> dataSet;
	}
	
	function selectWhere($tableName,$rowName,$operator,$value,$valueType,$orderbyfield=NULL)
	{
		$this -> sqlQuery = 'SELECT * FROM '.$tableName.' WHERE '.$rowName.' '.$operator.' ';
		if($valueType == 'int')
		{
			$this -> sqlQuery .= $value;
		}
		else if($valueType == 'char')  
		{
			$this -> sqlQuery .= "'".$value."'";
		}
		if($orderbyfield != NULL)
		{
			$this -> sqlQuery .= ' order by '.$orderbyfield . ' desc' ;			
		}
		
		$this -> dataSet =  mysqli_query($this -> connectionString,$this -> sqlQuery);
		$this -> sqlQuery = NULL;
		return $this -> dataSet;
	}
	function selectWhereAnd($tableName,$colName1,$value1,$colName2,$value2)
	{
		$this -> sqlQuery = 'SELECT * FROM '.$tableName.' WHERE '.$colName1. '=' . $value1 . ' AND ' . $colName2. '=' . $value2;
		$this -> dataSet =  mysqli_query($this -> connectionString,$this -> sqlQuery);
		$this -> sqlQuery = NULL;
		return $this -> dataSet;
	}
	function selectBetweenDates($tableName,$colName,$value1,$value2,$orderbyfield=NULL)
	{
		$this -> sqlQuery = "SELECT * FROM " . $tableName." WHERE ".$colName. " between '" . $value1 . "' AND '". $value2 . "'";
		if($orderbyfield != NULL)
		{
			$this -> sqlQuery .= ' order by '.$orderbyfield . ' desc' ;			
		}
		$this -> dataSet =  mysqli_query($this -> connectionString,$this -> sqlQuery);
		$this -> sqlQuery = NULL;
		return $this -> dataSet;
	}
	
   function InsertData($st)
   {
	$this->sqlQuery=$st;
	$result = mysqli_query($this -> connectionString,$this -> sqlQuery);
	//echo $result;
    return $result;
  }
  function InsertDataRtId($st)
   {
	$this->sqlQuery=$st;
	mysqli_query($this -> connectionString,$this -> sqlQuery);
    return mysqli_insert_id($this -> connectionString);
   }
   function InsertItemOther($tableName,$fieldname,$fieldvalue,$fielddescription)
   {
	   $insertst="insert into ". $tableName . "set" . $fieldname . " = ". $fieldvalue . " desc ='" . $fielddescription . "'";
	   $this->sqlQuery= $insertst;
	   mysqli_query($this -> connectionString,$this -> sqlQuery);
	   return mysqli_insert_id($this -> connectionString);
   }
  
  function updateData($st) 
  {
    $this->sqlQuery=$st;
	if(mysqli_query($this -> connectionString,$this -> sqlQuery))
	{
	//	echo $this->sqlQuery;
		return true;
	}
	else
	{
		return false;
	}
  }
  function isDataExist($tableName,$fieldName,$value,$valueType)
  {
	  $this -> sqlQuery = 'SELECT * FROM '.$tableName.' WHERE '.$fieldName. '=';
		if($valueType == 'int')
		{
        $this -> sqlQuery .= $value;
		}
		else if($valueType == 'char')  
		{
        $this -> sqlQuery .= "'".$value."'";
		}
		$this -> dataSet =  mysqli_query($this -> connectionString,$this -> sqlQuery);
		$this -> sqlQuery = NULL;
		if(mysqli_num_rows($this -> dataSet)>0)
			return true;
		else
			return false;
  }

  function getSingleValue($query,$fieldName)  
  {
	$fieldValue = "";
	$this->sqlQuery = $query;
	//echo "<br>".$this->sqlQuery;
	$this->dataSet =  mysqli_query($this->connectionString,$query);
	$row = mysqli_num_rows($this->dataSet);

	if($row>0)
	{
		if($result = mysqli_fetch_array($this->dataSet))
		{	
			$fieldValue = $result[$fieldName];
		}		
	}
	return $fieldValue;    
   }
}
?>
