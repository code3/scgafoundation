<script language="javascript" type="text/javascript" src="<?= CLIENTROOT ?>/js/add_note.js"></script>
<script language="javascript" type="text/javascript" src="<?= CLIENTROOT ?>/js/add_contact.js"></script>
<script language="javascript" type="text/javascript" src="<?= CLIENTROOT ?>/library/js/select.js"></script>
<script type="text/javascript">
<!--
function checkEditOrganizationExist(edit){
	
	valForm.stopSubmit	= true;
	var oldIdField 		= $('organizationid');
	var idField 		= $('new_organizationid');	
	var nameField 		= $('organization_name');
	var oldNameField 	= $('oldName');
	
	var submitForm 		= $('select_organization_form');
	var url = window.CLIENTROOT + "/action/organization/organization-exists/?k=" + Math.round(100000*Math.random()) + "&id=" + urlencode(idField.value) + "&oldID=" + urlencode(oldIdField.value) + "&name=" + urlencode(nameField.value) + "&oldName=" + urlencode(oldNameField.value) + "&edit=" + edit;
	//alert(url);
	new Ajax.Request(url, { method: 'get',  onSuccess: function(checkOrganizationExist2) {
		   if(checkOrganizationExist2.responseText == 'false'){
				submitForm.submit();
			}
			else{
				var formMsg 			= $('add_organization_msg');
				//idField.value 		= oldIdField.value;
				formMsg.style.display 	= 'block';
				formMsg.innerHTML 		= checkOrganizationExist2.responseText;
				return false;
			}
		}//end function checkOrganizationExist2
	}); 
		
}

//-->
</script>