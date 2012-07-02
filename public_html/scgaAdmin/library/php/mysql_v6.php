<?php

class mysql{

var $dbh;
var $safeInputs;	

	//constructor, connects to database
 	function mySql($db=MYSQLDB, $user=MYSQLUSER, $pass=MYSQLPASS, $host=MYSQLHOST){
		$this->dbh = mysql_connect ($host, $user, $pass) or die ('I cannot connect to the database because: ' . mysql_error());
		mysql_select_db ($db) or die(mysql_error());
		$this->safeInputs = false;
	}
	
	function close(){
		mysql_close($this->dbh);
	}
	
	//input mysql query
	//set $htmlFriendly to false if not desired
	//output double associative array of mysql data
	function get($query){	
		$this->query($query, 'get');
		
		$data = array();
		while ($myRow = mysql_fetch_assoc($this->result)) {
			array_push($data, $myRow);
		}
		mysql_free_result($this->result);
		
		if(count($data) == 0 ){
			return false;
		}
		return $data;
	}
	
	function getSingle($query){
		$query .=" LIMIT 1";
		$this->query($query, 'getSingle');
		
		$data = array();
		if($myRow = mysql_fetch_assoc($this->result)) {
			$data = $myRow; 
		}
		mysql_free_result($this->result);
		if(count($data)==0){
			return false;
		}
		return $data;
	}
	
	function getUnion($getStr, $tableStr, $whereStrList){
		if(!is_array($whereStrList)){
			die('mysql error in function getUnion :: $whereStrList must be a double array');
		}
		$queryThis = 'SELECT '.$getStr.' FROM '.$tableStr.' WHERE '.$whereStrList[0];
		$count = count($whereStrList);
		for($i=1; $i<$count; $i++){
			$queryThis .= ' UNION SELECT '.$getStr.' FROM '.$tableStr.' WHERE '.$whereStrList[$i];
		}
		
		$this->query($queryThis, 'getUnion');
		
		$data = array();
		while ($myRow = mysql_fetch_assoc($this->result)) {
			array_push($data, $myRow);
		}
		mysql_free_result($this->result);
		
		if(count($data) == 0 ){
			return false;
		}
		else{
			return $data;
		}
	}
	
	
	function insert($table, $fieldList, $valueList){
		
		if(!$this->safeInputs){
			die('mysql error: safe input is not set');
		}
		
		if(is_array($fieldList) && is_array($valueList)){ 
			$queryString = "INSERT INTO ".$table."  (`" . implode("`, `", $fieldList) . "`) VALUES ('" . implode("', '", $valueList). "')";
		}
		else{//if inputs are mismatch
			die('mySql class error in function insert(), field array dosnt match value array');
		}
		return $this->query($queryString, 'insert');
		
	}
	
	
	//--------------------------------------------//
	//insert many new entries into the mySql table fast
	//$fieldList store array of fields
	//$valueList store array of values that will go into those fields
	//field array index should matach with value index
	//ex:	$fieldAray= array("userid", "title", "isbn");
	//		$valueList= array('45', 'sex and the city', '12345'); $valueList2= array('45', 'sex and the city', '12345');
	//		$valueList = array($valueList, $valueList2); 
	
	
	function insertMany($table, $fieldList, $valueList){
		if(!$this->safeInputs){
			die('mysql error: safe input is not set');
		}
		if( is_array($fieldList) && is_array($valueList) && is_array($valueList[0]) ){ 
			//make sure values are safe
			$valueStrs = array();
			foreach($valueList as $values){
				array_push($valueStrs, "('" . implode("', '", $values). "')" );
			}
			
			$queryString = "INSERT INTO ".$table." (`" . implode("`, `", $fieldList) . "`) VALUES " . implode(', ', $valueStrs);
			
		}
		else{//if inputs are mismatch
			die('mySql class error in function insertMany(), field array dosnt match value array');
		}
		return $this->query($queryString, 'insertMany');
	}
	
	//--------------------------------------------//
	//update an entry 
	//functions is obvious
	function update($tableStr, $fieldList, $valueList, $whereStr){
		if(!$this->safeInputs){
			die('mysql error: safe input is not set');
		}
		//create querystring for mysql
		$numOfElements=count($fieldList);
		$queryString= "UPDATE ".$tableStr." SET ";	
		if(is_array($fieldList) && is_array($valueList)){
			//check if field array and value array have same number of elements
			if(count($fieldList)!=count($valueList)){
				die('mySql Error in function update(), number of fields do not match number of values.');
			}
		
			$queryString.='`'.$fieldList[0]."` = '".$valueList[0]."'";
			for($i=1; $i<$numOfElements; $i++){
				$queryString.=", ".$fieldList[$i]." = '".$valueList[$i]."' ";
			}
		}
		elseif(!is_array($fieldList) && !is_array($valueList)){
			$queryString.=''.$fieldList." = '".$valueList."'";
		}
		else{//if inputs are mismatch
			die('mySql Error in function get(), input fields are mismatch, one is an array one is not');
		}
		$queryString.= " WHERE ".$whereStr;
		return $this->query($queryString, 'update');
		
	}
	
	//--------------------------------------------//
	//delete an entry
	function delete($tableStr, $whereStr){
		$queryString = "DELETE FROM ".$tableStr." WHERE ".$whereStr;
		return $this->query($queryString, 'delete');
	}
	
	function query($query, $funct){ //echo $query;
		$this->result = mysql_query($query, $this->dbh) or die(mysql_error()." <br/> In mySql Class function ".$funct.". <br/>The query was: ".$query."<br/>In Page:".$_SERVER['PHP_SELF']);//die('A fatal error has occured, please contact staff.');//die('A fatal error has occured, please contact staff.'); //or die(mysql_error()." <br/> In mySql Class function ".$funct.". <br/>The query was: ".$query."<br/>In Page:".$_SERVER['PHP_SELF']);
	}
	
	//create a mySql Injection free string
	function makeSafe($value){
   		// Stripslashes
   		if (get_magic_quotes_gpc() && !isset($GLOBALS['magicQuotesOff'])) {
      	 	$value = stripslashes($value);
  		}
  		 //if not integer
   		if (!is_numeric($value)) {
      		$value = mysql_real_escape_string($value);
  		}
   		return $value;
	}
	
	function makeInputsSafe(){//make get/post safe for sql, html, and trim, careful for things that need spaces, ie: passwords
		$this->safeInputs = true;
		if(is_array($_POST)){
			foreach($_POST as $key=>$value){
				if(is_array($_POST[$key])){ // in case if an aray
					$len = count($_POST[$key]);
					for($i=0; $i<$len; $i++){
						$_POST[$key][$i] = $this->makeSafe(trim($_POST[$key][$i]));
					}
				}
				else{
					$_POST[$key] = $this->makeSafe(trim($value));
				}
			}
		}
		if(is_array($_GET)){
			foreach($_GET as $key=>$value){
				if(is_array($_GET[$key])){ // in case if an aray
					$len = count($_GET[$key]);
					for($i=0; $i<$len; $i++){
						$_GET[$key][$i] = $this->makeSafe(trim($_GET[$key][$i]));
					}
				}
				else{
					$_GET[$key] = $this->makeSafe(trim($value));
				}
			}
		}
	}
	
	function makeItSafe(&$list){
		if(is_array($list)){
			foreach($list as $key=>$value){
				if(is_array($value)){
					continue; //recurssion not working yet
					//$this->makeItSafe($value, $html) or die('makeItSafe(): recurssion not working yet');
				}
				else{
					if(is_array($list[$key])){
						$len = count($list[$key]);
						for($i=0; $i<$len; $i++){
							$list[$key][$i] = $this->makeSafe(trim($list[$key][$i]));
						}
					}
					else{
						$list[$key] = $this->makeSafe(trim($value));
					}
				}
			}
		}
	}
	
	
	
}

?>