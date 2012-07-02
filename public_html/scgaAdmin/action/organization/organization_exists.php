<?
$_mysql->makeInputsSafe();

$id = $_mysql->getSingle('SELECT organizationid FROM organization WHERE organizationid = "' . $_GET['id'] . '"');

if ($id) { // id exists

	if ($_GET['edit'] == '1') { //editing
		if ($_GET['id'] == $_GET['oldID']) { //no change to id then ok
			$name = $_mysql->getSingle('SELECT name, organizationid FROM organization WHERE name = "' . $_GET['name'] . '"');
			if ($name) { //if name exists
				if ($_GET['oldID'] == $name['organizationid']) { //if no change to name, then ok
					die('false');
				}
				else { //if there is an change to the name then it is a duplicate
					die ('This name already exists');
				}
			}
			else { //if no exsisting name exists then ok
				die('false');
			}
		}
		else { //if there is a change to the id and that id already exsists then it is a duplicate
			die ('This ID already exists');
		}
	}
	else { //if adding new organization and the id already exists then it is a duplicate
		die ('This ID already exists');
	}
}
else{

	$name = $_mysql->getSingle('SELECT name, organizationid FROM organization WHERE name = "' . $_GET['name'] . '"');
	
	if ($name) { // name exists
		
		if ($_GET['edit'] == '1') {
			if ($_GET['oldID'] == $name['organizationid']) { //if no change to the name then ok
				die('false');
			}
			else {
				die ('This name already exists'); //if there is an change to the name then it is a duplicate
			}
		}
		else {
			die('This name already exists');
		}
	} //end if
	//all checks are good
	else {
		die ('false');
	}
} //end else
?>