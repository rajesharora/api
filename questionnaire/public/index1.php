<h1>Questionnaire backend api 1</h1>
<?php 
    include_once("Router.php");
    try{
	    
	    $router = new Router();
	    
	    $uri = $router::request_path();
	    $method = $router::requestMethod();
	    
	//    $router->get($uri,"/",$method,"");
	    
	    if($method == "POST")
	    {
	    	throw new Exception("Method : must be post");
	    }
	    else
	    {
	    	echo "URI = ".$uri;
	    	echo "Method = ".$method;
	    }	    
	}catch(Exception $e) {
		echo 'Message: ' .$e->getMessage();
		//echo "Method must be post";
	}
?>
