<?
if(!is_numeric($_GET['contactid'])){
	$_SESSION[PREFIX.'error'] = $_p.' -contact id not numeric';
	died(CLIENTROOT.'/error/');
}

$_contacts = $_mysql->get('SELECT * FROM contact WHERE contactid = '.$_GET['contactid'].' ORDER BY lname, fname');
?>