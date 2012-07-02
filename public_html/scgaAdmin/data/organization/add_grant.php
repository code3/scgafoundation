<?
if(!isset($_GET['organizationid'])){
	$_SESSION[PREFIX . 'error'] = $_p . ' - data/add_grant';
	died(CLIENTROOT . '/error/');
}

$_organization = $_mysql->getSingle('SELECT name FROM organization WHERE organizationid = \'' . $_GET['organizationid'] . '\'');
if (!$_organization){
	$_SESSION[PREFIX . 'error'] = $_p . ' - data/add_grant';
	died(CLIENTROOT . '/error/');
}
?>