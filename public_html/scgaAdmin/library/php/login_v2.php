<?php

/*02/12/08*/
/*
Copyright © 2008 Eckx Media Group, LLC. All rights reserved.
Eckx Media Group respects the intellectual property of others, and we ask others to do the same.
*/

 class login{ 
 var $V76b16438 = '`login`'; 
 var $Vabcf54f9 = '`login_group`'; 
 var $V26adac18 = 1800; 
var $V581628f3 = 604800; 
var $V81c3b080; 
var $groupID; 
var $loginID; 
var $login; 
var $bad = false; 
var $V3c6e0b8a = 'I like red pickled apples!'; 

var $scgaNumber;

function login($V81c3b080){ 

if(session_id()==''){ 
session_start();
} 
											//$V81c3b080 database object
$V81c3b080->safeInputs = true; $this->V81c3b080= $V81c3b080; 
 $Vcaf9b6b9 = $this->V81c3b080->getSingle('SELECT * FROM '. $this->V76b16438. " WHERE session = '".session_id()."'", false);

 if(!$Vcaf9b6b9){ 
 
 if($_COOKIE['emgLoginClassA'] != ''){ 
 
 $this->V57037a87= mcrypt_decrypt(MCRYPT_RIJNDAEL_256, 
 $this->V3c6e0b8a, $_COOKIE['emgLoginClassA'], MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND));
if($_COOKIE['emgLoginClassB'] != ''){ 

$Vcaf9b6b9 = $this->V81c3b080->getSingle('SELECT * FROM '. $this->V76b16438. " WHERE loginName = '".$V81c3b080->makeSafe($this->V57037a87)."'", false );
if($Vcaf9b6b9){ 

if($_COOKIE['emgLoginClassB'] != md5($Vcaf9b6b9['loginPass'])){ $Vcaf9b6b9 = false;
} } } } } 

if($Vcaf9b6b9){ 
if(time()-$Vcaf9b6b9['last'] > $this->V26adac18){//timeout $this->bad = 2;
} else{ 
$this->set($Vcaf9b6b9); 
} 
return; }
 $this->bad = 1;
  } 
 
 
 function authen($login, $V5f4dcc3b, $V3eb4ac6c=0){
	 
 $login = $this->V81c3b080->makeSafe(trim(strtolower($login))); 
 $V5f4dcc3b = $this->V81c3b080->makeSafe($V5f4dcc3b);
 
 if($login == '' || $V5f4dcc3b == ''){ 
 return false; 
 } 
                                                            //$this->V76b16438 log in table
 $Vcaf9b6b9 = $this->V81c3b080->getSingle('SELECT * FROM '. $this->V76b16438. " WHERE login = '$login' AND password = '".md5($login.$V5f4dcc3b)."'", false);
 
if(!$Vcaf9b6b9){ 

return false; 

} else{ 

session_regenerate_id();
 
$this->V81c3b080->update($this->V76b16438, 'session', session_id(), 'loginid = '.$Vcaf9b6b9['loginid']);

$this->set($Vcaf9b6b9); 

if($V3eb4ac6c == 1 || $V3eb4ac6c == 2){ 

$Vc984805e = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $this->V3c6e0b8a, $V57037a87, MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND));

setcookie('emgLoginClassA', $V57037a87, time()+$this->V581628f3, '/', $_SERVER['SERVER_NAME']) or die("unable to set cookie");
} 

if($V3eb4ac6c == 2){ 

setcookie('emgLoginClassB', md5($Vcaf9b6b9['password']), time()+$this->V581628f3, '/', $_SERVER['SERVER_NAME']) or die("unable to set cookie");
} 

$this->setScgaNumber($login);//i added this

return true; 
} } 





//i added setter and getters
function setScgaNumber($login){
	
	$this->scgaNumber = $login;
	
	}

function getScgaNumber(){
	
	return $this->scgaNumber;
	
	}





function logout(){ 

session_regenerate_id(); 

} 


function set($Vcaf9b6b9){ 

$this->loginID = $Vcaf9b6b9['loginid'];
$this->groupID = $Vcaf9b6b9['login_groupid']; 
$this->login = $Vcaf9b6b9['login']; 
$this->V81c3b080->update($this->V76b16438, 'last', time(), 'loginid = '.$this->loginID);

} 

function protect($V34abb3c6 = array()){ if($this->bad){ return false; }
 if(count($V34abb3c6) > 0){if(!in_array($this->groupID, $V34abb3c6)){$this->bad = 3; return false; }} return true; } function createGroup($Va2b861d0){ if($Va2b861d0 == ''){
 return false; } $this->V81c3b080->insert(array('groupName'), array($Va2b861d0)); return mysql_insert_id();
} 

//$login is the scga#
//$V5f4dcc3b is password when account if first created and 
//groupid is type of account
function createLogin($login, $V5f4dcc3b, $groupID){ 

$login = $this->V81c3b080->makeSafe(trim(strtolower($login)));

$V5f4dcc3b = $this->V81c3b080->makeSafe($V5f4dcc3b); 

if($login == '' || $V5f4dcc3b == '' || !is_numeric($groupID) ){
 die('login class function createLogin :: missing argument'); 
 }
                                                               //$this->Vabcf54f9 is login_group table
 if(!$this->V81c3b080->getSingle('SELECT login_groupid FROM '. $this->Vabcf54f9. " WHERE login_groupid = $groupID", false)){
 die('login class function createLogin :: id dosnt exist'); 
 }
//returns false if login exists                         //$this->V76b16438 is login table //column login is the scga#
 if($this->V81c3b080->getSingle('SELECT loginid FROM '. $this->V76b16438. " WHERE login = '$login'", false)){
 return false; 
 } 
 
 $Vd05b6ed7 = array('login', 'password', 'login_groupid'); 
 
 $Vf09cc7ee = array($login, md5($login.$V5f4dcc3b), $groupID);
 
$this->V81c3b080->insert($this->V76b16438, $Vd05b6ed7, $Vf09cc7ee); 

return mysql_insert_id(); 

} 

function deleteLogin($login){
 $login = $this->V81c3b080->makeSafe(trim(strtolower($login))); $this->V81c3b080->delete($this->V76b16438, "login = '$login'");
} 

function resetPass($login){ 
$login = $this->V81c3b080->makeSafe(trim(strtolower($login)));

 $V4db8adea = $this->V81c3b080->getSingle('SELECT loginid FROM '. $this->V76b16438. " WHERE login = '$login'", false);
 
if(!$login){
	 return false; 
	 } 
	 
	 $V34d1c350 = md5(rand(100, 1000000).time()); $V739a42ed=''; 
	 
	 for($V865c0c0b=0; $V865c0c0b<8; $V865c0c0b++){
		 
 $V739a42ed .= $V34d1c350[$V865c0c0b]; 
 
 } 
 
 $this->V81c3b080->update($this->V76b16438, 'password', md5($login.$V739a42ed), "loginid = ".$V4db8adea['loginid']);
 
return $V739a42ed; 

} 

function updatePass($login, $Vc9b34d4c, $Vc50b29e7){ 

$login = $this->V81c3b080->makeSafe(trim(strtolower($login)));

$V5f4dcc3b = $this->V81c3b080->makeSafe($V5f4dcc3b); 

 $Ve8418d1d = $this->V81c3b080->getSingle('SELECT loginid '. $this->V76b16438. " WHERE login = '$login' AND password = '".md5($login.$Vc50b29e7)."'", false);
 
if(!$Ve8418d1d){ 
return false; 
} 

$this->V81c3b080->update($this->V76b16438, 'password', md5($login.$Vc9b34d4c), "loginid = ".$Ve8418d1d['loginid']);
return true; 
} 
} ?>