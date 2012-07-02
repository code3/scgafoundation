<script language="javascript" type="text/javascript" src="<?= CLIENTROOT ?>/library/js/select.js"></script>
<script language="javascript" type="text/javascript" src="<?= CLIENTROOT ?>/js/export_csv.js"></script>
<script type="text/javascript">
<!--
function checkOrganizationExist(){
	
	valForm.stopSubmit	= true;
	var idField 		= $('new_organizationid');	
	var nameField 		= $('organization_name');
	
	var submitForm 		= $('select_organization_form');
	var url 			= window.CLIENTROOT + "/action/organization/organization-exists/?k=" + Math.round(100000*Math.random()) + "&id=" + urlencode(idField.value) + "&name=" + urlencode(nameField.value) + "&edit=0";
	
	new Ajax.Request(url, { method: 'get',  onSuccess: function(checkOrganizationExist2) {
		   if(checkOrganizationExist2.responseText == 'false'){
				submitForm.submit();
			}
			else{
				var formMsg 			= $('add_organization_msg');
				formMsg.style.display 	= 'block';
				formMsg.innerHTML 	= checkOrganizationExist2.responseText;
				return false;
			}
		}//end function checkOrganizationExist2
	}); 
		
}

//-->
</script>