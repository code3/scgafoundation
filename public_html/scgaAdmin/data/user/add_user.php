<?
$groups = $_mysql->get('SELECT * FROM login_group');
//drop down menu for groups
$_groupSelect=array();
foreach ($groups as $group) {
	$_groupSelect[$group['login_groupid']]=$group['name'];
}

?>