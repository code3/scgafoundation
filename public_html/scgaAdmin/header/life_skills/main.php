<script language="javascript" type="text/javascript" src="<?= CLIENTROOT ?>/js/send_email.js"></script>
<script type="text/javascript">
<!--
function showLifeSkills(scga){
	curtain.load();
	var url = "<?= CLIENTROOT ?>/ajax/life_skills/view_answers/?k="+ Math.round(100000*Math.random()) +"&scga="+scga;
	new Ajax.Request(url, { method: 'get', onSuccess: function(showLifeSkills2) {
			curtain.content(showLifeSkills2.responseText);
			//setTimeout("valForm.init('email_form'); customTitle.init('curtain_contentLayer"+curtain.index+"')" , 100);
		}
	}); 
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
//-->
</script>