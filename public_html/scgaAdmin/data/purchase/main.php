<?
if( $_login->groupID==1){
	$_isAdmin=true;
}
$_title = 'Online Purchases';
//save users action into session

userActionHistory(array('p'), 'purchase');
// get all the event titles
$eventTitles = $_mysql->get('SELECT DISTINCT(event_name) FROM event_purchase ORDER BY event_name');
$_eventTitles = array();
if($eventTitles){
	foreach($eventTitles as $eventTitle){
		array_push($_eventTitles,$eventTitle['event_name']);
	}
}

//
//for exporting to excel
$_excel_cols = array(
	'event_name'=>'Event Name',
	'trans_num'=>'Trans #',
	'quantity'=>'Quantity',
	'date'=>'Purchase Date',
	'total_purchase'=>'Total Purchase',
	'shipping_name'=>'Shipping Name',
	'shipping_address'=>'Shipping Address',
	'shipping_city'=>'Shipping City',
	'shipping_state'=>'Shipping State',
	'shipping_country'=> 'Shipping Country',
	'shipping_zip'=>'Shipping Zip',
	'ticket_status'=>'Ticket Status',
	'ticket_ship_date'=>'Ticket Ship Date',
	'email'=>'Email',
	'phone'=>'Phone Number'
	);

$eventTab = "event_purchase";
$getStr = "$eventTab.event_purchaseid,$eventTab.event_name, $eventTab.trans_num,$eventTab.quantity, $eventTab.date,$eventTab.total_purchase,$eventTab.ticket_status,$eventTab.ticket_ship_date";
$tableStr = "$eventTab";
if(is_numeric($_GET['event_purchaseid'])){// get single event purchase
	$where = "$eventTab.event_purchaseid = ".$_GET['event_purchaseid']; 
	$numOfItem = 1;
}
else if($_GET['search']){ // get event purchase based on search
	
	$whereList = array(1);
	$ticketStatus = $_GET['ticket_status'];
	$dateMin = $_mysql->makeSafe(trim($_GET['purchase_min_date']));
	$dateMax = $_mysql->makeSafe(trim($_GET['purchase_max_date']));
	$eventSearchName = $_GET['event_search_name'];
	//validate string lengths
	if(isset($dateMin[10]) || isset($dateMax[10])){
		$_SESSION[PREFIX]['error'] = "Invalid date";
		died(CLIENTROOT.'/purchase/main');
	}
	if($ticketStatus!= ''){
		array_push($whereList, "$eventTab.ticket_status = '$ticketStatus'");
	}
	if($eventSearchName!= ''){
		array_push($whereList, "$eventTab.event_name = \"$eventSearchName\"");
	}
	if($dateMin!= ''){
		$dateMin = changeDateFormat($dateMin); 
		array_push($whereList, "$eventTab.date >= '$dateMin'");
	} 
	
	if($dateMax!= ''){
		$dateMax = changeDateFormat($dateMax); 
		array_push($whereList, "$eventTab.date <= '$dateMax'");
	} 
	
	unset($fieldList);
	
	if(isset($whereList[0])){
		$where = implode(' AND ', $whereList);
	}
	$countInfo = $_mysql->get("SELECT count($eventTab.event_purchaseid) AS purchaseCnt FROM $tableStr WHERE $where");

	$numOfItem =  $countInfo[0]['purchaseCnt'];
}	
else{
	$where = 1;
	$countInfo = $_mysql->get("SELECT count($eventTab.event_purchaseid) AS purchaseCnt FROM $tableStr");
	$numOfItem =  $countInfo[0]['purchaseCnt'];
}

$_pl = new pageLinks(10, $numOfItem);

$orderStr = 'ORDER BY event_purchaseid DESC';
$descStr = '';

$sortList = array('event_purchase.event_name','event_purchase.quantity', 'event_purchase.date', 'event_purchase.total_purchase','event_purchase.ticket_status','event_purchase.ticket_ship_date');
if(in_array($_GET['sort_field'], $sortList)){
	$orderStr = 'ORDER BY '.$_GET['sort_field'];
}
if($_GET['sort_desc'] == 1){
	$descStr = ' DESC';
}

// querys for exporting
$queryGetStr = "$eventTab.*";
$_query = "SELECT $queryGetStr FROM $tableStr WHERE $where $orderStr".$descStr;

$_purchases = $_mysql->get("SELECT $getStr FROM $tableStr WHERE $where $orderStr".$descStr." LIMIT ".$_pl->limit);

unset($getStr, $tableStr, $where, $orderStr, $descStr);

?>