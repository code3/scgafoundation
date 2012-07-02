<script language="javascript" type="text/javascript" src="<?= CLIENTROOT ?>/js/add_note.js"></script>
<script language="javascript" type="text/javascript" src="<?= CLIENTROOT ?>/js/add_contact.js"></script>
<script type="text/javascript">
<!--
function checkFacilityExist(edit){
	
	valForm.stopSubmit=true;
	var nameField = $('facility_name');
	var oldNameField = $('oldName');
	var idField = $('facilityid');
	//alert(nameField.value+', '+oldNameField.value);
	var submitForm = $('select_facility_form');
	var url = window.CLIENTROOT+"/action/facility/facility-exists/?k="+Math.round(100000*Math.random())+"&name="+urlencode(nameField.value)+"&oldName="+urlencode(oldNameField.value)+"&edit="+edit+"&facilityid="+idField.value;
	//alert(url);
	new Ajax.Request(url, { method: 'get',  onSuccess: function(checkFacilityExist2) {
		   if(checkFacilityExist2.responseText == 'false'){
				submitForm.submit();
			}
			else{
				var formMsg = $('add_facility_msg');
				//idField.value = oldIdField.value;
				formMsg.style.display = 'block';
				formMsg.innerHTML = checkFacilityExist2.responseText;
				return false;
			}
		}//end function
	}); 
		
}

//-->
</script>


