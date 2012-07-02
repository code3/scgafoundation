<script language="javascript" type="text/javascript" src="<?= CLIENTROOT ?>/js/add.js"></script>
<script type="text/javascript">
<!--
function checkUserExist(){
	valForm.stopSubmit=true;
	var nameField = $('login');	
	var submitForm = $('select_user_form');
	
	var url = window.CLIENTROOT+"/action/user/user_exists/?k="+Math.round(100000*Math.random())+"&login="+urlencode(nameField.value);
	
	new Ajax.Request(url, { method: 'get',  onSuccess: function(checkUserExist2) {
		   if(checkUserExist2.responseText == 'false'){
				submitForm.submit();
			}
			else{
				var formMsg = $('add_user_msg');
				formMsg.style.display = 'block';
				formMsg.innerHTML = 'This username already exists, please choose another.';
				return false;
			}
		}//end function checkUserExist2
	}); 
		
}
/*function addYear(year,email){ // don't need to send email anymore
	window.location=window.CLIENTROOT+'/action/reset_statuses/?year='+year+'&email='+email;
}
*/

function addYear(year){
	window.location = window.CLIENTROOT + '/action/reset_statuses?year=' + year;
}

//-->
</script>
<link rel="stylesheet" type="text/css" href="<?= CLIENTROOT ?>/css/admin-options.css" />