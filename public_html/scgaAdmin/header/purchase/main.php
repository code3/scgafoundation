<script language="javascript" type="text/javascript" src="<?= CLIENTROOT ?>/library/js/select.js"></script>
<script language="javascript" type="text/javascript" src="<?= CLIENTROOT ?>/js/export_csv.js"></script>
<script language="javascript" type="text/javascript" src="<?= CLIENTROOT ?>/library/js/country_select.js"></script>
<script type="text/javascript">
<!--
function editTicketStatus(event_purchaseid){
	var url = window.CLIENTROOT+"/ajax/purchase/edit-ticket-status/?event_purchaseid="+event_purchaseid+"&k="+ Math.round(100000*Math.random());
	curtain.load();
	new Ajax.Request(url, { method: 'get', onSuccess: function(editTicketStatus2) {
		curtain.content(editTicketStatus2.responseText);
		setTimeout("valForm.init('edit_ticket_status_form'); customTitle.init('curtain_contentLayer"+curtain.index+"')" , 100);	//set input, css, js, events handling 
		} 
	}); 
}

function toggleShipDate(){
	var statusField = $('edit_ticket_status');
	if(statusField.value=='Shipped'){
		$('ticket_ship_date_div').style.display = 'block';
	}
	else{
		$('ticket_ship_date_div').style.display = 'none';
	}
}
//-->
</script>