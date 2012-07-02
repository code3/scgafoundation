<title>SCGA Foundation Admin Panel - <?= $_title ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<style type="text/css" media="all">@import "<?= CLIENTROOT ?>/css/global.css";</style>
<link rel="stylesheet" type="text/css" href="<?= CLIENTROOT ?>/library/css/curtain_v2.css" />
<link rel="stylesheet" type="text/css" href="<?= CLIENTROOT ?>/library/css/cal_pop.css" />
<link rel="stylesheet" type="text/css" href="<?= CLIENTROOT ?>/css/pop_container.css" />
<link rel="stylesheet" type="text/css" href="<?= CLIENTROOT ?>/library/css/emg.css" />
<link rel="stylesheet" type="text/css" href="<?= CLIENTROOT ?>/library/css/cust_title.css" />
<link rel="stylesheet" type="text/css" href="<?= CLIENTROOT ?>/library/css/pageLinks.css" />
<link rel="stylesheet" type="text/css" href="<?= CLIENTROOT ?>/css/main.css" />
<link rel="stylesheet" type="text/css" href="<?= CLIENTROOT ?>/css/nav.css" />
<link rel="stylesheet" type="text/css" href="<?= CLIENTROOT ?>/css/calendar.css" />
<script type="text/javascript" src="https://www.google.com/jsapi"></script>

<script type="text/javascript">

	<!--
	google.load("prototype", "1");
	//-->

</script>
<? 
/*
<script language="javascript" type="text/javascript" src="<?= CLIENTROOT ?>/library/js/prototype.js"></script>
*/
?>
<script language="javascript" type="text/javascript" src="<?= CLIENTROOT ?>/library/js/emg.js"></script>
<script language="javascript" type="text/javascript" src="<?= CLIENTROOT ?>/library/js/curtain_v2.js"></script>
<script language="javascript" type="text/javascript" src="<?= CLIENTROOT ?>/library/js/cust_title.js"></script>
<script language="javascript" type="text/javascript" src="<?= CLIENTROOT ?>/library/js/val_form.js"></script>
<script language="javascript" type="text/javascript" src="<?= CLIENTROOT ?>/library/js/cal_pop.js"></script>
<script language="javascript" type="text/javascript" src="<?= CLIENTROOT ?>/library/js/rewrite_pgl.js"></script>
<script language="javascript" type="text/javascript" src="<?= CLIENTROOT ?>/js/misc.js"></script>
<script language="javascript" type="text/javascript" src="<?= CLIENTROOT ?>/js/add.js"></script>
<script type="text/javascript">
<!--
setInterval("disableTimeout()", 600000 );

function disableTimeout(){
 	// (do something here)
	var url = window.CLIENTROOT + "/action/disable_timeout/?k=" + Math.round(100000*Math.random());
	new Ajax.Request(url, { method: 'get', onSuccess: function(disableTimeout2) {
		} 
	}); 
}

//-->
</script>
