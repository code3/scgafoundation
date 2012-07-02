<?
$_mysql->makeInputsSafe();

if($_FILES['file1']['tmp_name'] ==''){
	died(CLIENTROOT.'/user/main');
}
if(isset($_POST['submit'])){
	move_uploaded_file($_FILES['file1']['tmp_name'], './1');
	$rows = array();
	$handle = @fopen("./1", "r");
	if ($handle) {
		while (!feof($handle)) {
			$line = preg_replace( "/\r/", "", preg_replace( "/\n/", "", fgets($handle, 4096) ) );
			$parts = explode(',', $line);
			/*
			$parts[0] = organizationid
			$parts[1] = yoc_classification
			$parts[2] = scga
			$parts[3] = fname
			$parts[4] = lname
			$parts[5] = address
			$parts[6] = city
			$parts[7] = state
			$parts[8] = zip
			$parts[9] = email
			$parts[10] = gender
			*/
			//////////////===============ADD KID========================//////////////////
			if($parts[0] != '' && $parts[0] != 'Organization ID' && $parts[0] != 'Org ID'){
				$addressFields = array('address', 'address2', 'city', 'state', 'zip');
				$addressValues = array($_mysql->makeSafe(trim($parts[5])), '', $_mysql->makeSafe(trim($parts[6])), $_mysql->makeSafe(trim($parts[7])), $_mysql->makeSafe(trim($parts[8])));
				$_mysql->insert('address', $addressFields, $addressValues);
				$addID = mysql_insert_id();
				
				$loginID = $_login->createLogin($_mysql->makeSafe(trim($parts[2])), 'password', 4);
				//print_r($parts);
				//die();
				$kidsFields=array('scga', 'loginid', 'fname', 'lname','gender','email','addressid','dob','enrolled','ethnicity','handicap','yoc_classification','organizationid','grade');
				
				$kidsValues = array($_mysql->makeSafe(trim($parts[2])),$loginID,$_mysql->makeSafe(trim(ucwords(strtolower($parts[3])))),$_mysql->makeSafe(trim(ucwords(strtolower($parts[4])))),$_mysql->makeSafe(trim($parts[10])),$_mysql->makeSafe(trim($parts[9])),$addID,'0000-00-00',date('Y-m-d'),'Prefer not to answer','',$_mysql->makeSafe(trim($parts[1])),$_mysql->makeSafe(trim($parts[0])),NULL);
				
				$_mysql->insert('kids', $kidsFields, $kidsValues);
				
				$_mysql->insert('certification', array('scga','year','certification_status'), array($_mysql->makeSafe(trim($parts[2])),date('Y'),'Not certified'));
							
				$_mysql->insert('quiz', array('scga'), array($_mysql->makeSafe(trim($parts[2]))));
			}
			//////////=================END ADD KID==========================/////////////
			
			unset($parts);
		}
		fclose($handle);
	}
	unlink("./1");
}
$_SESSION['updated']="Kids from file saved";
died(CLIENTROOT.'/user/main/');
?>