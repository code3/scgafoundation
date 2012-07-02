<?php
if($_login->groupID == 1){
	$_isAdmin = true;
}
$users = $_mysql->get('SELECT login.login, login_group.name, login.loginid 
					  FROM login 
					  	INNER JOIN login_group ON login.login_groupid=login_group.login_groupid 
					  WHERE login.login_groupid != 4 ORDER BY login');
?>