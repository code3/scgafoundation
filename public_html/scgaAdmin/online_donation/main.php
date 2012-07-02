<h1>Online Donations</h1>
<form id="donation_search_form" name="donation_search_form" action="<?=CLIENTROOT?>/online_donation/main" method="get">
	<input type="hidden" name="sort_field" id="sort_field" value="<?= $_GET['sort_field'] ?>" />
	<input type="hidden" name="sort_desc" id="sort_desc" value="<?= $_GET['sort_desc'] ?>"/>
	<input type="hidden" name="search" id="search" value="1"/>
	<div id="disUp_calPop" class="calendar_pop"></div>
	<label for="donation_min_date">Donation Date Min:</label>
	<input type="text" name="donation_min_date" id="donation_min_date" value="<?= $_GET['donation_min_date'] ?>" class="dateText" maxlength="10"/>
	<a href="javascript: setupCalPopUp('disUp_calPop', 'cal_link', $('donation_min_date'));" id="cal_link" class="customTitle" title="Open Calendar"><img src="<?= CLIENTROOT ?>/images/icons/24-columns.png" /></a>
	<br />
	<label for="donation_max_date">Donation Date Max:</label>
	<input type="text" name="donation_max_date" id="donation_max_date" value="<?= $_GET['donation_max_date'] ?>" class="dateText" maxlength="10" />
	<a href="javascript: setupCalPopUp('disUp_calPop', 'cal_link2', $('donation_max_date'));" id="cal_link2" class="customTitle" title="Open Calendar"><img src="<?= CLIENTROOT ?>/images/icons/24-columns.png" /></a>
	<br />

<label>&nbsp;</label>
<input type="submit" value="Search" />
</form>
<?

if ($_donations) {
		?>
		<? require 'parts/csv_fields.php';?>
			<input type="button" onclick="exportCsv(new Array('<?= implode(array_keys($_excel_cols), "', '")?>'), 'online_donation');" value="Download CSV File" />
			<br />
		</div><br />
		
		 <?
}

if($_donations){
	$_pl->show();
	?> 
	
	<table class="listing">
	<?
	
	$_headerClasses = array();
	$_sortFields = array('','online_donation.fname','online_donation.lname','','online_donation.email', 'online_donation.amount','online_donation.date','');
	$_sortTitles = array('#','First Name','Last Name', 'Phone','Email', 'Amount','Date','View Details');
	$_sortForm = 'donation_search_form';
	require 'parts/sort_header.php';
	$i=0;
	$rowCount = 1;
	
	foreach($_donations as $donation){
		?><tr <? if ($i % 2 == 1) { ?> class="bg"<? } ?>>
		<td><?=$_pl->offset + $rowCount?></td>
		<td><?= $donation['fname'] ?></td>
		<td><?= $donation['lname'] ?></td>
		<td><?= $donation['phone'] ?></td>
		<td><?= $donation['email'] ?></td>
		<td>$<?= number_format($donation['amount'],2) ?></td>
		<td><?= changeDateFormat($donation['date']) ?></td>
		<td><a href="javascript:viewOnlineDonationDetails('<?=$donation['online_donationid']?>');" class="customTitle" title="View Details"><img src="<?= CLIENTROOT ?>/images/icons/24-pencil.png" alt="View Details" /></a></td>
			
	</tr><?
	$i++;
	$rowCount++;
	}
	?></table>
	<br />
	
<?
}
else{
	?><br /><br />No Donations Found<?
}
?>
