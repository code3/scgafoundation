<div class="pop_container" id="edit_ticket_container">
	<form id="edit_ticket_status_form" action="<?= CLIENTROOT ?>/action/purchase/save-ticket-status/" method="post">
	<input type="hidden" name="event_purchaseid" value="<?= $_GET['event_purchaseid'] ?>" />
	<h1>Purchase Details</h1>
	<label for="event_name">Event Name:</label>
	<? htmlSel($_eventTitles, 'id="event_name" name="event_name" class="val_req"',$_purchase['event_name'], false, 'Select Event...'); ?>
	<br />
	<label for="purchase_date">Purchase Date:</label>
	<input type="text" id="purchase_date" name="purchase_date" class="val_len 10 dateText" value="<?=changeDateFormat($_purchase['date'])?>"/>	
	<a href="javascript:sel('<?= CLIENTROOT ?>/ajax/calendar/?fieldid=purchase_date')" class="customTitle" title="Calendar">
	<img src="<?= CLIENTROOT ?>/images/icons/24-columns.png" alt="Calendar" />
	</a>
	<br />
	<label for="trans_num">Transaction #:</label>
	<input type="text"  name="trans_num" id="trans_num" class="val_req" value="<?= $_purchase['trans_num'] ?>" />
	<br />
    <label for="event_note">Note:</label>
	<textarea name="event_note" id="event_note" class="val_max <?= MAXLEND ?>"><?= $_purchase['note'] ?></textarea>
	<br />
	<h1>Ticket Status</h1>
	<label for="edit_ticket_status">Ticket Status:</label>
	<? htmlSel(array('Ordered', 'Shipped'), 'id="edit_ticket_status" name="edit_ticket_status" onChange="toggleShipDate();"',$_purchase['ticket_status'], false, ''); ?>
	<br />
	<div id="ticket_ship_date_div" <? if($_purchase['ticket_status']=='Shipped'){?><? }else{?>class="hide"<? } ?>>
		<label for="ticket_ship_date">Ticket Ship Date:</label>
		<input type="text" id="ticket_ship_date" name="ticket_ship_date" class="val_len 10 dateText" value="<?=$shipDate?>"/>	
		<a href="javascript:sel('<?= CLIENTROOT ?>/ajax/calendar/?fieldid=ticket_ship_date')" class="customTitle" title="Calendar">
		<img src="<?= CLIENTROOT ?>/images/icons/24-columns.png" alt="Calendar" />
		</a>
		<br />
		<label for="ticket_nums">Ticket Numbers</label>
		<textarea name="ticket_nums" id="ticket_nums" class="small-area"><?= $_purchase['ticket_nums'] ?></textarea>
		<br />
	</div>
	<label for="ticket_qty">Ticket Quantity:</label>
	<input type="text"  name="ticket_qty" id="ticket_qty" class="val_req val_num dateText" value="<?= $_purchase['quantity'] ?>" />
	<br />
	<label for="total_purchase">Total Purchase:</label>
	<input type="text"  name="total_purchase" id="total_purchase" class="val_req val_money dateText" value="<?= $_purchase['total_purchase'] ?>" />
	<br />
	<h1>Shipping Info</h1>
	<label for="shipping_name">Shipping Name:</label>
	<input type="text" name="shipping_name" id="shipping_name" class="val_req" value="<?=$_purchase['shipping_name']?>" />
	<br />
	<label for="shipping_address">Shipping Address:</label>
	<input type="text" name="shipping_address" id="shipping_address" class="val_req" value="<?=$_purchase['shipping_address']?>"/>
	<br />
	<label for="shipping_city">Shipping City:</label>
	<input type="text" name="shipping_city" id="shipping_city" class="val_req" value="<?=$_purchase['shipping_city']?>"/>
	<br />
	
	<div id="shipping_state_container" <? if (isset($_shippingCountry) && $_shippingCountry !='US'){?>class="hide"<? }?>>
		<label for="shipping_state">Shipping State:</label>
		<? htmlSel($_states, 'name="shipping_state" id="shipping_state" class=""', $_purchase['shipping_state'], true, 'Please Select...') ?>
		<br />
	</div>
	<div <? if(isset($_shippingCountry) && $_shippingCountry =='US'){?> class="hide"<? } ?> id="shipping_province_container">
		<label for="shipping_province">Shipping Province:</label>
		<input type="text"  name="shipping_province" id="shipping_province" class="" value="<?= $_purchase['shipping_state'] ?>" />
		<br />
	</div>
	<div>
		<label for="shipping_country">Shipping Country:</label>
		<? htmlSel($_countryA, 'name="shipping_country" id="shipping_country" class="val_req" onchange="countrySelect(this.value, \'shipping_state_container\', \'shipping_province_container\', \'shipping_state\', \'shipping_province\' )" ', $_shippingCountry, true, 'Please Select...') ?>
		<br />
	</div>
	<label for="shipping_zip">Shipping Zip:</label>
	<input type="text" name="shipping_zip" id="shipping_zip" class="val_req dateText" value="<?=$_purchase['shipping_zip']?>"/>
	<br />
	<label for="email">Email:</label>
	<input type="text" maxlength="100" name="email" id="email" class="val_req val_email" value="<?=$_purchase['email']?>" />
	<br />
	<label for="phone">Phone Number:</label>
	<input type="text" maxlength="50" name="phone" id="phone" class="val_req" value="<?=$_purchase['phone']?>" />
	<br />
	<label>&nbsp;</label>
	<input type="submit" value="Submit" />
	</form>
</div>
