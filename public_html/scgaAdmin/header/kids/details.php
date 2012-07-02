<script language="javascript" type="text/javascript" src="<?= CLIENTROOT ?>/library/js/select.js"></script>
<script language="javascript" type="text/javascript" src="<?= CLIENTROOT ?>/js/add_note.js"></script>
<script language="javascript" type="text/javascript" src="<?= CLIENTROOT ?>/js/add.js"></script>
<script language="javascript" type="text/javascript" src="<?= CLIENTROOT ?>/js/send_email.js"></script>
<script type="text/javascript">
<!--
function addKidsErrorHandler(error,value,scga){
	
	$('select_kids_form').disabled = false; //val form disables it
	switch(error){
		case 0:
			window.location = window.CLIENTROOT+'/kids/details/?scga='+scga;
			break;
		case 1:
			$('form_editKidsError').innerHTML = 'Organization '+value+' does not exist';
			$('form_editKidsError').style.display = 'block';
		break;
		case 2:
			$('form_editKidsError').innerHTML = 'An entry already exists for '+value;
			$('form_editKidsError').style.display = 'block';
		break;
		
	}
	
}
	
function emailLifeSkillsStatus(scga, status){
	curtain.load();
	var url = "<?= CLIENTROOT ?>/ajax/email-lifeSkills-status/?k="+ Math.round(100000*Math.random()) +"&scga="+scga+"&status="+status;
	new Ajax.Request(url, { method: 'get', onSuccess: function(emailLifeSkillsStatus2) {
			curtain.content(emailLifeSkillsStatus2.responseText);
			setTimeout("valForm.init('email_form'); customTitle.init('curtain_contentLayer"+curtain.index+"')" , 100);
		}
	}); 
}

function emailTempLogin(scga){
	curtain.load();
	var url = "<?= CLIENTROOT ?>/ajax/email-temp-login/?k="+ Math.round(100000*Math.random()) +"&scga="+scga;
	new Ajax.Request(url, { method: 'get', onSuccess: function(emailTempLogin2) {
			curtain.content(emailTempLogin2.responseText);
			setTimeout("valForm.init('email_form'); customTitle.init('curtain_contentLayer"+curtain.index+"')" , 100);
		}
	}); 
}

function showLifeSkills(scga){
	curtain.load();
	var url = "<?= CLIENTROOT ?>/ajax/life_skills/view_answers/?k="+ Math.round(100000*Math.random()) +"&scga="+scga;
	new Ajax.Request(url, { method: 'get', onSuccess: function(showLifeSkills2) {
			curtain.content(showLifeSkills2.responseText);
			//setTimeout("valForm.init('email_form'); customTitle.init('curtain_contentLayer"+curtain.index+"')" , 100);
		}
	}); 
}

//-->
</script>