<script language="javascript" type="text/javascript" src="<?= CLIENTROOT ?>/library/js/select.js"></script>
<script language="javascript" type="text/javascript" src="<?= CLIENTROOT ?>/js/export_csv.js"></script>
<script language="javascript" type="text/javascript" src="<?= CLIENTROOT ?>/js/add.js"></script>
<script type="text/javascript">
<!--
function addKidsErrorHandler(error, value,row){
	$('form_addKidsSubmit').disabled = false; //val form disables it
	switch(error){
		case 0:
			window.location = window.CLIENTROOT+'/kids/main/';
			break;
		case 1:
			$('form_addKidsError').innerHTML = 'Organization '+value+' does not exist on row '+row;
			$('form_addKidsError').style.display = 'block';
		break;
		case 2:
			$('form_addKidsError').innerHTML = 'An entry already exists for '+value+' on row '+row;
			$('form_addKidsError').style.display = 'block';
		break;
		
	}
	
}

function addYear(){
	window.location=window.CLIENTROOT+'/action/reset_statuses';
}

//-->
</script>
