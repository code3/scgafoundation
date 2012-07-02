<?
if( $_login->groupID==1){
	$_isAdmin=true;
}
if(!$_isAdmin){
	$_SESSION[PREFIX.'error'] = $_p." You do not have permission to view this page.";
	died(CLIENTROOT.'/error/');
}
if(!is_numeric($_GET['online_donationid'])){
	$_SESSION[PREFIX.'error'] = $_p." online purchase id is not numeric.";
	died(CLIENTROOT.'/error/');
}
$_online_donation = $_mysql->getSingle('SELECT online_donation.* FROM online_donation WHERE online_donationid='.$_GET['online_donationid']);
if(!$_online_donation){
	$_SESSION[PREFIX.'error'] = $_p." record does not exsist";
	died(CLIENTROOT.'/error/');
}
$_online_donation['date'] = changeDateFormat($_online_donation['date']);
$_online_donation['amount'] = '$'.$_online_donation['amount'];

$_onlineDonationFields = array( "fname" => "First Name",
								"lname" => "Last Name",
								"phone" => "Phone",
								"email" => "Email",
								"date" => "Date",
								"amount" => "Amount",
								"trans_num" => "Transaction #",
								"billing_address" => "Billing Address",
								"billing_city" => "Billing City",
								"billing_state" => "Billing State",
								"billing_zip" => "Billing Zip",
								"memorial_donation" => "Memorial Donation");
if($_online_donation['tax_deductible']){
	$_online_donation['tax_deductible'] = "Yes";
}
else{
	$_online_donation['tax_deductible'] = "No";
}

if($_online_donation['memorial_donation']){
	$_online_donation['memorial_donation'] = "Yes";
	$_onlineDonationFields['memorial_donation_name'] = 'Memorial Donation Name';
}
else{
	$_online_donation['memorial_donation'] = "No";
}

$_onlineDonationFields['tax_deductible'] = 'Tax Deductible';
$_onlineDonationFields['recurring'] = 'Recurring';

if($_online_donation['recurring']){
	$_online_donation['recurring']= "Yes";
	$_onlineDonationFields['recur_every'] = "Recur Every";
}
else{
	$_online_donation['recurring']= "No";
}
?>