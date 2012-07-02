<?
$_mysql->makeInputsSafe();
if (!is_numeric($_POST['event_purchaseid'])) {
	$_SESSION[PREFIX . 'error'] = $_p . ': event_purchaseid is not numeric';
	died(CLIENTROOT . '/error');
}

if ($_POST['edit_ticket_status'] == 'Shipped') {
	$shipDate = trim(changeDateFormat($_POST['ticket_ship_date']));
}
else {
	$shipDate = '0000-00-00';
}

if ($_POST['shipping_country'] =='US') {
	$shippingState = $_POST['shipping_state'];
}
else {
	$shippingState = trim($_POST['shipping_province']);
}

$purchaseDate = trim(changeDateFormat($_POST['purchase_date']));
$fields = array('event_name',
				'trans_num',
				'quantity',
				'note',
				'date',
				'total_purchase',
				'shipping_name',
				'shipping_address',
				'shipping_city',
				'shipping_state',
				'shipping_country',
				'shipping_zip',
				'ticket_status',
				'ticket_ship_date',
				'ticket_nums',
				'phone',
				'email');
$values = array(trim($_POST['event_name']),
				trim($_POST['trans_num']),
				trim($_POST['ticket_qty']),
				trim($_POST['event_note']),
				$purchaseDate,
				trim($_POST['total_purchase']),
				trim($_POST['shipping_name']),
				trim($_POST['shipping_address']),
				trim($_POST['shipping_city']),
				$shippingState,
				$_POST['shipping_country'],
				trim($_POST['shipping_zip']),
				$_POST['edit_ticket_status'],
				$shipDate,
				$_POST['ticket_nums'],
				$_POST['phone'],
				$_POST['email']);
if ($_POST['event_purchaseid'] != 0) { //editing				
	$_mysql->update('event_purchase', 
			$fields,
			$values,
			'event_purchaseid = '.$_POST['event_purchaseid']);
	$_SESSION['updated'] = 'Purchase updated successfully';
}
else {
	$_mysql->insert('event_purchase', 
			$fields,
			$values);
	$_SESSION['updated'] = 'Purchase added successfully';
}

died(CLIENTROOT . '/purchase/main');
?>