<?
chdir('../');
session_start();
require('config/define.php');
require('config/config.php');
require('library/php/mysql_v6.php');
require('library/php/emg.php');
require('library/php/pl_v2.php');
require('library/php/login_v2.php');
httpsOn();


//content
$_p = str_replace('-', '_', $_GET['p']); //if url does not exist then it probably a route where it gets broken up
if(!file_exists($_p)){
	$_SESSION[PREFIX.'error'] = $_p;
	died(CLIENTROOT.'/error/');
}



$_mysql = new mysql();

//login

$_login = new login($_mysql);
if( !$_login->protect(array(1,2,3)) ){
	die('<div>Not Logged In.</div>');
}
else{
	$_username = $_login->login;
}

//data
if(file_exists('data/'.$_p)){  
	include 'data/'.$_p;
}

$_mysql->close();
unset($_mysql);
require_once($_p) 

?>