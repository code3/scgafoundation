<script language="javascript" type="text/javascript" src="<?= CLIENTROOT ?>/library/js/select.js"></script>
<script language="javascript" type="text/javascript" src="<?= CLIENTROOT ?>/js/export_csv.js"></script>
<script type="text/javascript">
<!--
function checkFacilityExist(){
	valForm.stopSubmit=true;
	var nameField = $('name');
	var submitForm = $('select_facility_form');
	var url = window.CLIENTROOT+"/action/facility/facility-exists/?k="+Math.round(100000*Math.random())+"&name="+urlencode(nameField.value);
	
	new Ajax.Request(url, { method: 'get',  onSuccess: function(checkFacilityExist2) {
		   if(checkFacilityExist2.responseText == 'false'){
				submitForm.submit();
			}
			else{
				var formMsg = $('add_facility_msg');
				formMsg.style.display = 'block';
				formMsg.innerHTML = 'This name already exists.';
				return false;
			}
		}//end function checkFacilityExist2
	}); 
		
}

//-->
</script>