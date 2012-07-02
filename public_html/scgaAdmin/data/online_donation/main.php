<?
if( $_login->groupID==1){
	$_isAdmin=true;
}
if(!$_isAdmin){
	$_SESSION[PREFIX.'error'] = $_p." You do not have permission to view this page.";
	died(CLIENTROOT.'/error/');
}

$_title = 'Online Donations';
//save users action into session

userActionHistory(array('p'), 'online_donation');

//
//for exporting to excel

$_excel_cols = array(
	'fname'=>'First Name',
	'lname'=>'Last Name',
	'phone'=>'Phone',
	'email'=>'Email',
	'date'=>'Date',
	'amount'=>'Amount',
	'trans_num'=>'Transaction #',
	'billing_address'=>'Billing Address',
	'billing_city'=>'Billing City',
	'billing_state'=> 'Billing State',
	'billing_zip'=>'Billing Zip',
	'memorial_donation'=>'Memorial Donation',
	'memorial_donation_name'=>'Memorial Donation Name',
	'tax_deductible'=>'Tax Deductible',
	'recurring'=>'Recurring',
	'recur_every'=>'Recur Every'
	);

$donationTab = "online_donation";
$getStr = "$donationTab.online_donationid,$donationTab.fname, $donationTab.lname,$donationTab.phone, $donationTab.email,$donationTab.date,$donationTab.amount";
$tableStr = "$donationTab";
if($_GET['search']){ // get event purchase based on search
	
	$whereList = array(1);
	$dateMin = $_mysql->makeSafe(trim($_GET['donation_min_date']));
	$dateMax = $_mysql->makeSafe(trim($_GET['donation_max_date']));
	//validate string lengths
	if(isset($dateMin[10]) || isset($dateMax[10])){
		$_SESSION[PREFIX.'error'] = "Invalid date";
		died(CLIENTROOT.'/online_donation/main/');
	}
	if($dateMin!= ''){
		$dateMin = changeDateFormat($dateMin); 
		array_push($whereList, "$donationTab.date >= '$dateMin'");
	} 
	
	if($dateMax!= ''){
		$dateMax = changeDateFormat($dateMax); 
		array_push($whereList, "$donationTab.date <= '$dateMax'");
	} 
	
	unset($fieldList);
	
	if(isset($whereList[0])){
		$where = implode(' AND ', $whereList);
	}
	$countInfo = $_mysql->get("SELECT count($donationTab.online_donationid) AS donationCnt FROM $tableStr WHERE $where");

	$numOfItem =  $countInfo[0]['donationCnt'];
}	
else{
	$where = 1;
	$countInfo = $_mysql->get("SELECT count($donationTab.online_donationid) AS donationCnt FROM $tableStr");
	$numOfItem =  $countInfo[0]['donationCnt'];
}

$_pl = new pageLinks(10, $numOfItem);

$orderStr = 'ORDER BY online_donationid DESC';
$descStr = '';

$sortList = array('online_donation.fname','online_donation.lname', 'online_donation.email','online_donation.date','online_donation.amount');
if(in_array($_GET['sort_field'], $sortList)){
	$orderStr = 'ORDER BY '.$_GET['sort_field'];
}
if($_GET['sort_desc'] == 1){
	$descStr = ' DESC';
}

// querys for exporting
$queryGetStr = "$donationTab.*";
$_query = "SELECT $queryGetStr FROM $tableStr WHERE $where $orderStr".$descStr;

$_donations = $_mysql->get("SELECT $getStr FROM $tableStr WHERE $where $orderStr".$descStr." LIMIT ".$_pl->limit);

unset($getStr, $tableStr, $where, $orderStr, $descStr);

?>