<?
require ('parts/update_alert.php');
?>
<h1>Online Purchases</h1>
<form id="purchase_search_form" name="purchase_search_form" action="<?=CLIENTROOT?>/purchase/main" method="get">
	<input type="hidden" name="sort_field" id="sort_field" value="<?= $_GET['sort_field'] ?>" />
	<input type="hidden" name="sort_desc" id="sort_desc" value="<?= $_GET['sort_desc'] ?>"/>
	<input type="hidden" name="search" id="search" value="1"/>
	<label for="ticket_status">Ticket Status:</label>
	<? htmlSel(array('Ordered', 'Shipped'), 'id="ticket_status" name="ticket_status"',$_GET['ticket_status'], false, 'Status...'); ?>
	<br />
	<label for="event_search_name">Event Name:</label>
	<? htmlSel($_eventTitles, 'id="event_search_name" name="event_search_name"',$_GET['event_search_name'], false, 'Event Name...'); ?>
	<br />
	<div id="disUp_calPop" class="calendar_pop"></div>
	<label for="purchase_min_date">Purchase Date Min:</label>
	<input type="text" name="purchase_min_date" id="purchase_min_date" value="<?= $_GET['purchase_min_date'] ?>" class="dateText" maxlength="10"/>
	<a href="javascript: setupCalPopUp('disUp_calPop', 'cal_link', $('purchase_min_date'));" id="cal_link" class="customTitle" title="Open Calendar"><img src="<?= CLIENTROOT ?>/images/icons/24-columns.png" /></a>
	<br />
	<label for="purchase_max_date">Purchase Date Max:</label>
	<input type="text" name="purchase_max_date" id="purchase_max_date" value="<?= $_GET['purchase_max_date'] ?>" class="dateText" maxlength="10" />
	<a href="javascript: setupCalPopUp('disUp_calPop', 'cal_link2', $('purchase_max_date'));" id="cal_link2" class="customTitle" title="Open Calendar"><img src="<?= CLIENTROOT ?>/images/icons/24-columns.png" /></a>
	<br />

<label>&nbsp;</label>
<input type="submit" value="Search" class="submit-button" /><? if($_isAdmin){ ?><input type="button" onclick="editTicketStatus('0')" value="Add Ticket Purchase" class="submit-button" /><? } ?>
</form>
<? /**
<input type="button" onclick="window.location='<?=CLIENTROOT?>/action/access_northern_trust_open'" value="Test Northern Trust Open" class="submit-button" />*/ ?>
<?

if ($_purchases) {
		?>
		<? require 'parts/csv_fields.php';?>
			<input type="button" onclick="exportCsv(new Array('<?= implode(array_keys($_excel_cols), "', '")?>'), 'purchase');" value="Download CSV File" />
			<br />
		</div><br />
		
		 <?
}

if($_purchases){
	$_pl->show();
	?> 
	
	<table class="listing">
	<?
	
	$_headerClasses = array();
	$_sortFields = array('','event_purchase.event_name','','event_purchase.date', 'event_purchase.quantity','event_purchase.total_purchase','event_purchase.ticket_status','event_purchase.ticket_ship_date','');
	$_sortTitles = array('#','Event Name','Trans #', 'Purchase Date','Qty', 'Total Purchase','Ticket Status', 'Ticket Ship Date','');
	$_sortForm = 'purchase_search_form';
	require 'parts/sort_header.php';
	$i=0;
	$rowCount = 1;
	
	foreach($_purchases as $purchase){
		?><tr <? if ($i % 2 == 1) { ?> class="bg"<? } ?>>
		
		<td><?=$_pl->offset + $rowCount?></td>
		<td><?= $purchase['event_name'] ?></td>
		<td><?= $purchase['trans_num'] ?></td>
		<td><?= changeDateFormat($purchase['date']) ?></td>
		<td><?= $purchase['quantity'] ?></td>
		<td>$<?=number_format($purchase['total_purchase'],2)?></td>
		<td><?= $purchase['ticket_status']?></td>
		<? if ($purchase['ticket_ship_date'] =='0000-00-00'){?>
			<td></td>
		<?  } else{?>
			<td><?=changeDateFormat($purchase['ticket_ship_date'])?></td>
		<? } ?>
		<td><? if($_isAdmin){?><a href="javascript:editTicketStatus('<?=$purchase['event_purchaseid']?>');" class="customTitle" title="Update Ticket Status"><img src="<?= CLIENTROOT ?>/images/icons/24-pencil.png" alt="Update Ticket Status" /></a><? } ?></td>
			
	</tr><?
	$i++;
	$rowCount++;
	}
	?></table>
	<br />
	
<?
}
else{
	?><br /><br />No Purchases Found<?
}
?>
