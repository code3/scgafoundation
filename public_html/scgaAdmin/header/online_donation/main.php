<script language="javascript" type="text/javascript" src="<?= CLIENTROOT ?>/library/js/select.js"></script>
<script language="javascript" type="text/javascript" src="<?= CLIENTROOT ?>/js/export_csv.js"></script>
<script type="text/javascript">
<!--
function viewOnlineDonationDetails(online_donationid){
	var url = window.CLIENTROOT+"/ajax/online_donation/details/?online_donationid="+online_donationid+"&k="+ Math.round(100000*Math.random());
	curtain.load();
	new Ajax.Request(url, { method: 'get', onSuccess: function(viewDetails) {
		curtain.content(viewDetails.responseText);
		setTimeout("customTitle.init('curtain_contentLayer"+curtain.index+"')" , 100);	//set input, css, js, events handling 
		} 
	}); 
}
//-->
</script>