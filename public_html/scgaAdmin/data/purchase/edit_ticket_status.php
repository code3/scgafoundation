<?
if( $_login->groupID==1){
	$_isAdmin=true;
}
if(!$_isAdmin){
	$_SESSION[PREFIX.'error'] = $_p." You do not have permission to view this page.";
	died(CLIENTROOT.'/error/');
}
// get all the event titles
$eventTitles = $_mysql->get('SELECT DISTINCT(event_name) FROM event_purchase ORDER BY event_name');
$_eventTitles = array();
if($eventTitles){
	foreach($eventTitles as $eventTitle){
		array_push($_eventTitles,$eventTitle['event_name']);
	}
}
require ('library/php/states.php');
require ('library/php/countries.php');
if(!is_numeric($_GET['event_purchaseid'])){
	$_SESSION[PREFIX.'error'] = $_p.': event_purchaseid is not numeric';
	died(CLIENTROOT.'/error/');
}
if($_GET['event_purchaseid'] != 0){// if adding new
	$_purchase = $_mysql->getSingle('SELECT event_purchase.* FROM event_purchase WHERE event_purchaseid='.$_GET['event_purchaseid']);
	if(!$_purchase){
		$_SESSION[PREFIX.'error'] = $_p.': event_purchase does not exist: with event_purchaseid='.$_GET['event_purchaseid'];
		died(CLIENTROOT.'/error/');
	}
	if($_purchase['ticket_ship_date'] == '0000-00-00'){
		$shipDate='';
	}
	else{
		$shipDate = changeDateFormat($_purchase['ticket_ship_date']);
	}
	$_shippingCountry=$_purchase['shipping_country'];
}
else{
	$shipDate='';
	$_shippingCountry='US';
}

?>