<?php
include "../../db/DbConfig.php";					
			
	$dbc = new Dbconfig();

	$sqlQuery = "SELECT * FROM questions_tbl";
		
	$dbc->dbConnect(); 

	$records = $dbc->selectThis($sqlQuery);

	echo "<table>";
	while ($p = $records->fetch_assoc())
	{
		echo  "<tr><td>". $p['Que_QuestionId']. "</td><td>". $p['Que_QuestionText'] . "</td></tr>";
	}
	echo "</table>";
	
	$dbc->dbDisconnect();
?>		
