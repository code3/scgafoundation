<?
if(!is_numeric($_GET['contactid2'])){
	$_SESSION[PREFIX.'error'] = $p.' - in data/edit_contact.php';
	died(CLIENTROOT.'/error/');
}

$_contact = $_mysql->getSingle('SELECT * FROM contact WHERE contactid2 = '.$_GET['contactid2']);
?>