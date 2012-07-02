<?
$_isAdmin = false;
if($_login->groupID == 1){
	$_isAdmin = true;
}

$_letters = range('A', 'N');
$_colummNames = array('Handicap #'
					  , 'FName'
					  , 'LName'
					  , 'Home Phone'
					  , 'Gender'
					  , 'E-mail'
					  , 'Current Addr1'
					  , 'Current Addr2'
					  , 'Current City'
					  , 'Current State'
					  , 'Current Zip'
					  , 'DOB'
					  , 'Handicap Index'
					  , 'Handicap Vendor Key'
					  );


$_numCols = count($_colummNames);
$_certStatuses = array('Certified by Program', 'Not certified');
?>