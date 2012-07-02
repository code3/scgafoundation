<?php



if (class_exists('mysql')){
	 
	if($_mysql instanceof mysql){
		
		 $mysqlObj = $_mysql;
		 }else{
			 $mysqlObj = new mysql();
			 }
	 }else{
		
		echo 'DB class not available';
		
		}



if (class_exists('login')){
	 
	if($_login instanceof login){
		
		 $loginObj = $_login;
		 
		 }else{
			 
			 $loginObj = new login($mysqlObj);//mysql class object needs to be instatiated first
			 }
			 
	 }else{
		
		echo 'Login class not available';
		
		}




if ( class_exists('Scga_Model_UrlLocator') ){
	
	$urlLocatorObj = new Scga_Model_UrlLocator();
	
	}else{
		
		echo 'Url Locator Class not available';
		
		
		}


 ?>