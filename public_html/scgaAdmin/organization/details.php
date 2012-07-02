<?
require ('parts/update_alert.php');
?>
<h1>Organization: <?= $_organization['name'] ?></h1>
<form id="select_organization_form" action="<?= CLIENTROOT ?>/action/organization/save-organization/" method="post" onsubmit="checkEditOrganizationExist('1');" >
	<div class="details-col">
        <div id="add_organization_msg"></div>
        <div id="select_organization_calPop" class="calendar_pop"></div>
        <input type="hidden" id="organizationid" name="organizationid" value="<?= $_GET['organizationid'] ?>" />
        <input type="hidden" id="oldName" name="oldName" value="<?= $_organization['name'] ?>" />
        <label for="new_organizationid">Organization ID:</label>
        <input <?= $disable ?> type="text" id="new_organizationid" name="new_organizationid" class="val_req text" maxlength="12" value="<?= $_organization['organizationid'] ?>" />
        <br />
    
        <label for="organization_name">Name:</label>
        <input <?= $disable ?> type="text" id="organization_name" name="name" class="val_req text" maxlength="<?= MAXLENA ?>" value="<?= $_organization['name'] ?>" />
        <br />
        
        <label for="organization_legal_name">Legal Name:</label>
        <input <?= $disable ?> type="text" id="organization_legal_name" name="legal_name" class="val_req text" maxlength="<?= MAXLENA ?>" value="<?= $_organization['legal_name'] ?>" />
        <br />	
        
        <label for="address">Address:</label>
        <input <?= $disable ?> type="text" id="address" name="address" class="val_req text" maxlength="<?= MAXLENA ?>" value="<?= $_organization['address'] ?>" />
        <br />
        
        <label for="address2"></label>
        <input <?= $disable ?> type="text" id="address2" name="address2" maxlength="<?= MAXLENA ?>" value="<?= $_organization['address2'] ?>" class="text" />
        <br />
        
        <label for="city">City:</label>
        <input <?= $disable ?> type="text" id="city" name="city" class="val_req text" maxlength="<?= MAXLENA ?>" value="<?= $_organization['city'] ?>" />
        <br />
        
		<?
        if(!$_isAdmin){
			?>
            <label for="state">State:</label>
            <? htmlSel($_states, 'disabled="disabled" id="state" name="state" class="val_req"',$_organization['state'] , true, 'State...'); ?>
            <br />
        	<? 
		} 
		else{ 
			?>
            <label for="state">State:</label>
        	<? htmlSel($_states, 'id="state" name="state" class="val_req"',$_organization['state'] , true, 'State...'); ?>
        <br />
        	<? 
		} 
		?>
        
        <label for="zip">Zip:</label><input <?= $disable ?> name="zip" id="zip" maxlength="<?= MAXLENA ?>" class="val_req text" value="<?= $_organization['zip'] ?>" type="text" />
        <br />
        
        <label for="organization_phone">Phone:</label>
        <input <?= $disable ?> type="text" id="organization_phone" name="phone" class="val_req text" value="<?= $_organization['phone'] ?>" maxlength="<?= MAXLENA ?>"/>
        
        <br />
        <label for="organization_fax">Fax:</label>
        <input <?= $disable ?> type="text" id="organization_fax" name="fax" class="val_req text" value="<?= $_organization['fax'] ?>" maxlength="<?= MAXLENA ?>"/>
        <br />
    </div>
	<div class="details-col">
        <label for="organization_scga_club">SCGA Club Name:</label>
        <input <?= $disable ?> type="text" id="organization_scga_club" name="scga_club" class="val_req text" maxlength="<?= MAXLENA ?>" value="<?= $_organization['scga_club'] ?>" />
        <br />
        
        <label for="organization_scga_club_code">SCGA Club Code:</label>
        <input <?= $disable ?> type="text" id="organization_scga_club_code" name="scga_club_code" class="val_req text" maxlength="7" value="<?= $_organization['scga_club_code'] ?>" />
        <br />
        
        <label for="organization_agreement_date">YOC Agreement Date:</label>
        <input <?= $disable ?> type="text" id="organization_agreement_date" name="yoc_agreement"  class="val_req val_len 10 text" value="<?= $_organization['yoc_agreement'] ?>" />
        
        <a href="javascript: setupCalPopUp('select_organization_calPop', 'select_organization_cal_link', $('organization_agreement_date'));" id="select_organization_cal_link" class="customTitle" title="Open Calendar"><img src="<?= CLIENTROOT ?>/images/icons/24-columns.png" /></a>
        <br />
        
        <label for="handicap_chairman_date">Handicap Chairman Date:</label>
        <input <?= $disable ?> type="text" id="handicap_chairman_date" name="handicap_chairman"  class="val_req val_len 10 text" value="<?= $_organization['handicap_chairman'] ?>" />
        
        <a href="javascript: setupCalPopUp('select_organization_calPop', 'select_organization_cal_link2', $('handicap_chairman_date'));" id="select_organization_cal_link2" class="customTitle" title="Open Calendar"><img src="<?= CLIENTROOT ?>/images/icons/24-columns.png" /></a>
        <br />
        <label for="web">Web Address:</label>
        <input <?= $disable ?> type="text" id="web" name="web" value="<?= $_organization['web'] ?>" class="text" maxlength="<?= MAXLENC ?>"/>
        <br />
	</div>
	<br />
    <label>&nbsp;</label>
	<input type="button" onclick="javascript:history.back()" class="button" value="Back" />
	<input <? if(!$_isAdmin){ ?>style="display:none;" disabled="disabled"<? } ?> class="submit-button" type="submit" value="Update" />
</form>
<script type="text/javascript">
<!--
valForm.init($('select_organization_form'));
//-->
</script>
<br /><br />
<h1>Organization Contacts</h1>  
<?
require('contact.php'); ?>
<br />
<h1>Organization Grants</h1>
<?
if($_grants){
	if($_isAdmin){ //start delete form?>
		<form id="grant_donation_del_form" action="<?= CLIENTROOT ?>/action/organization/delete-grant-donation/?subsection=grant" method="post">
		<? 
	}
	?>
    <table class="listing">
        <tr>
            <? 
			if($_isAdmin){
				?> 
            	<th></th>
           		<th></th>
				<? 
			} 
			?>
            <th>#</th>
            <th>Year</th>
            <th>Amount</th>
            <th>Note</th>
        </tr>	
        <?
        $rowCount 	= 1;
        $i			= 0;
        foreach ($_grants as $grant){
           ?>
           <tr <? if ($i % 2 == 1) { ?> class="bg"<? } ?>>
           <? 
		   if($_isAdmin){ //add delete checkboxes, edit, and delete button
		   		?>
                <td><input type="checkbox" id="checkBox_<?= $grant['grantid'] ?>" value="<?= $grant['grantid'] ?>" name="checked_grant[]" /></td>
                <td><a onclick="confirm2(event, 'Delete Grant?', '$(\'checkBox_<?= $grant['grantid']  ?>\').checked = true; $(\'grant_donation_del_form\').submit()')" class="customTitle" title="Delete"><img src="<?= CLIENTROOT ?>/images/icons/24-em-cross.png" alt="Delete" /></a></td><? } ?>
                <td><?=$rowCount?></td>
                <td><?=$grant['year']?></td>
                <td>$<?=$grant['amount']?></td>
                <td><div style="width: 200px; height: 60px; overflow: auto; padding: 5px;"><?=$grant['note']?></div></td>
            </tr>
            <?
            $i++;
            $rowCount++;
        }
        ?>
        </table> 
	<?
    if($_isAdmin){//add check all, delete all and edit button
		?>
        </form>
		<?
    }//end the form
}
?>
<br />
<input <? if(!$_isAdmin){ ?>style="display:none;" disabled="disabled"<? } ?> type="button" onclick="showAdd('grant','<?=$_GET['organizationid']?>')" value="Add Grant" />
<br /><br />

<h1>Organization Donations</h1>
<?
if($_donations){
	if($_isAdmin){ //start delete form
		?>
        <form id="grant_donation_del_form2" action="<?= CLIENTROOT ?>/action/organization/delete-grant-donation/?subsection=donation" method="post">
		<? 
	}
	?>
    <table class="listing">
        <tr>
            <?
            if($_isAdmin){
				?>
            	<th></th>
            	<th></th>
				<? 
			}
			?>
            <th>#</th>
            <th>Date</th>
            <th>Item</th>
            <th>Quantity</th>
            <th>Value</th>
            <th>Note</th>
        </tr>
        <?
        $rowCount 	= 1;
        $i			= 0;
        foreach ($_donations as $donation){
         	?>
         	<tr<? if ($i % 2 == 1) { ?> class="bg"<? } ?>>
          	<? 
			if($_isAdmin){ //add delete checkboxes, edit, and delete button
				?>
                <td><input type="checkbox" id="checkBox_<?= $donation['donationid'] ?>" value="<?= $donation['donationid'] ?>" name="checked_donation[]" /></td>
                <td><a onclick="confirm2(event, 'Delete Donation?', '$(\'checkBox_<?= $donation['donationid']  ?>\').checked = true; $(\'grant_donation_del_form2\').submit()')" class="customTitle" title="Delete"><img src="<?= CLIENTROOT ?>/images/icons/24-em-cross.png" alt="Delete" /></a></td>
				<?
            }
			?>
                <td><?=$rowCount?></td>
                <td><?=date("m/d/Y",strtotime($donation['date']))?></td>
                <td><?=$donation['item']?></td>
                <td><?=$donation['quantity']?></td>
                <td><?=$donation['value']?></td>
                <td><div style="width: 200px; height: 60px; overflow: auto; padding: 5px;"><?=$donation['note']?></div></td>
            </tr>
			<?
            $i++;
            $rowCount++;
        }// end foreach
        ?>
    </table>
	<? 
    if($_isAdmin){ //add check all, delete all and edit button 
        ?>
        </form>
        <?
    }//end the form
}
?>
<br />			
<input <? if(!$_isAdmin){ ?>style="display:none;" disabled="disabled"<? } ?> type="button" onclick="showAdd('donation','<?= $_GET['organizationid'] ?>')" value="Add Donation" />	


<br /><br />
<h1>Organization Notes</h1>
<? require('note.php'); ?> <br />