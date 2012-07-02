<?php //DROP-DOWN FOR STATUS - ACTIVE OR INACTIVE ** 'cause by default the column is active when value is empty so when adding a kid it will become 'active' since there is no selection in the add kids form but will become 'inactive' when resetting and renewal payment will make 'active' again 
//echo $_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
?>
<div class="pop_container" >
	<h1><?= !empty($kidsList) ? 'Edit' : 'Add' ?> Kids</h1>
	<label for="all_organization" class="customTitleClick"><strong>Organization:</strong></label>
	<input type="text" maxlength="<?= MAXLENA ?>" id="all_organization" name="all_organization" />
	<div class="fleft">
		<a href="javascript:sel('<?= CLIENTROOT ?>/ajax/kids/organization-select/?fieldid=all_organization')" class="customTitle" title="Select an Organization."><img src="<?= CLIENTROOT ?>/images/icons/24-columns.png" alt="Select an Organization." /></a>
	</div>
	<br />
	<label>&nbsp;</label>
    <input type="checkbox" id="populate_all_organization" onclick="javascript:populate_all('organization', '<?=$_GET['number']?>');" class="checkbox" /><label class="checkbox" for="populate_all_organization">Populate Organizations</label>
	<br />
	<label for="all_state" class="customTitleClick"><strong>State:</strong></label>
	<? htmlSel($_states, 'id="all_state" name="all_state"', '', true, 'State...'); ?>
	<br />
	<label>&nbsp;</label>
    <input type="checkbox" id="populate_all_state" onclick="javascript:populate_all('state', '<?=$_GET['number']?>');" class="checkbox" /><label class="checkbox" for="populate_all_state">Populate States</label>
	<br /><br />

	<iframe name="form_addKidsTarget" class="hide" src="#"></iframe>
	<div id="form_addKidsError" class="hide"></div>
	<form id="select_kids_form" action="<?= CLIENTROOT ?>/action/kids/save-kids" method="post" target="form_addKidsTarget">
		<input type="hidden" id="edit" name="edit" value="<?= $edit ?>" />
		<table class="add">
        	<tbody>
			<?
			for ($i = 0; $i < $_GET['number']; $i++) {
				?>
				<tr class="new-row">
					<th>#</td>
					<th>SCGA Mem. #</th>
					<th>First Name</th>
					<th colspan="2">Last Name</th>
                    <th colspan="2">Phone</th>
					<th>Gender</th>
					<th>Email</th>
					<th>Address</th>
					<th>Address 2</th>
					<th>City</th>
				</tr>
				<tr>
					<td class="number"><?= $i + 1 ?>.</td>
					<td>
                    	<label for="scga<?= $i ?>" class="hide">SCGA <?= $i ?></label>
						<input type="text" id="scga<?= $i ?>" name="scga[]" class="<? if ($edit == '1'){ ?>val_req <? } ?>" maxlength="<?= MAXLENA ?>" value="<?=$kidsList[$i]['scga']?>"/>
						<input type="hidden" id="oldScga<?= $i ?>" name="oldScga[]" <? if(isset($kidsList)){ ?>value="<?=$kidsList[$i]['scga']?>" <? } else { ?> value="0" <? } ?> />
					</td>
					<td>
                    	<label for="fname<?= $i ?>" class="hide customTitleClick">First Name <?= $i ?></label>
						<input type="text" maxlength="<?= MAXLENA ?>" id="fname<?= $i ?>" name="fname[]" class="<? if ($edit == '1'){ ?>val_req <? } ?>" value="<?=$kidsList[$i]['fname']?>"/>
					</td>
					<td colspan="2">
                    	<label for="lname<?= $i ?>" class="hide customTitleClick">Last Name <?= $i ?></label>
						<input type="text" maxlength="<?= MAXLENA ?>" id="lname<?= $i ?>" name="lname[]" class="<? if ($edit == '1'){ ?>val_req <? } ?>" value="<?=$kidsList[$i]['lname']?>"/>
					</td>
					<td colspan="2">
                    	<label for="phone<?= $i ?>" class="hide customTitleClick">Phone <?= $i ?></label>
						<input type="text" maxlength="<?= MAXLENA ?>" id="phone<?= $i ?>" name="phone[]" class="<? if ($edit == '1'){ ?>val_req <? } ?>" value="<?=$kidsList[$i]['phone']?>"/>
					</td>
                    
					<?
                    if ($edit == '1') {
						?>
						<td>
                        	<label for="gender<?= $i ?>" class="hide">Gender <?= $i ?> </label>
							<? htmlSel(array('M', 'F'), 'id="gender' . $i . '" name="gender[]" class="val_req gender" multiple="multiple" ', $kidsList[$i]['gender'], false, ''); ?>
						</td> 
						<?
					} 
					else {
						?>
						<td>
                        	<label for="gender<?= $i ?>" class="hide">Gender <?= $i ?> </label>
							<? htmlSel(array('M', 'F'), 'id="gender' . $i . '" name="gender[]" class="gender val_skipifis scga' . $i . '" multiple="multiple" ', $kidsList[$i]['gender'], false, ''); ?>
						</td>
						<?
					}
					?>

					<td>
                    	<label for="email<?= $i ?>" class="hide customTitleClick">Email <?= $i ?></label>
						<input type="text" maxlength="<?= MAXLENA ?>" id="email<?= $i ?>" name="email[]" class="<? if ($edit == '1'){ ?>val_req <? } ?>" value="<?=$kidsList[$i]['email']?>"/>
					</td>
					<td>
                    	<label for="address<?= $i ?>" class="hide customTitleClick">Address <?= $i ?></label>
						<input type="text" maxlength="<?= MAXLENA ?>" id="address<?= $i ?>" name="address[]" class="<? if ($edit == '1'){ ?>val_req <? } ?>" value="<?=$kidsList[$i]['address']?>"/>
					</td>
					<td>
                    	<label for="address2<?= $i ?>" class="hide customTitleClick">Address2 <?= $i ?></label>
						<input type="text" maxlength="<?= MAXLENA ?>" id="address2<?= $i ?>" name="address2[]" value="<?=$kidsList[$i]['address2']?>"/>
					</td>
					<td>
                    	<label for="city<?= $i ?>" class="hide customTitleClick">City <?= $i ?></label>
						<input type="text" maxlength="<?= MAXLENA ?>" id="city<?= $i ?>" name="city[]" class="<? if ($edit == '1'){ ?>val_req <? } ?>" value="<?=$kidsList[$i]['city']?>"/>
					</td>
				</tr>
				<tr>
					<td></td>
                    <th>State</th>
					<th>Zip</th>
					<th colspan="2">DOB</th>
					<th colspan="2"></th>
					<th>Enrolled</th>
					<th></th>
					<th>Ethnicity</th>
					<th>Handicap Index</th>
					<th>YOC Classification</th>
				</tr>
				<tr>
					<td></td>
                    <? 
					if ($edit == '1') {
						?>
						<td>
                        	<label for="state<?= $i ?>" class="hide">State <?= $i ?> </label>
							<? htmlSel($_states, 'id="state' . $i . '" name="state[]" class="val_skipifis scga' . $i . ' val_req" ', $kidsList[$i]['state'], true, ''); ?>
						</td> 
						<? 
					} 
					else { 
						?>
						<td>
                        	<label for="state<?= $i ?>" class="hide">State <?= $i ?></label>
							<? htmlSel($_states, 'id="state' . $i . '" name="state[]" class="val_skipifis scga' . $i . '" ', $kidsList[$i]['state'], true, 'State...'); ?>
						</td>
						<? 
					} 
					?>
					<td>
                    	<label for="zip<?= $i ?>" class="hide customTitleClick">Zip <?= $i ?></label>
						<input type="text" maxlength="<?= MAXLENA ?>" id="zip<?= $i ?>" name="zip[]" class="val_skipifis scga<?= $i ?> <? if ($edit == '1'){ ?>val_req <? } ?>" value="<?=$kidsList[$i]['zip']?>"/>
					</td>
					<td colspan="2">
                    	<div id="select_kids_calPop<?= $i ?>" class="calendar_pop"></div>
						<label for="dob<?= $i ?>" class="hide">DOB <?= $i ?></label>
                        <input type="text" id="dob<?= $i ?>" name="dob[]" class="<? if ($edit == '1'){ ?>val_req <? } ?>"  maxlength="10" <? if(isset($kidsList)){ ?>value="<?= $kidsList[$i]['dob'] != '0000-00-00' && $kidsList[$i]['dob'] != '' ? date("m/d/Y",strtotime($kidsList[$i]['dob'])) : '' ?>" <? } ?>/>
					</td>
					<td colspan="2">
						<?
                        if($kidsList){ 
							$dateStr = '&year='.date("Y",strtotime($kidsList[$i]['dob'])).'&month='.date("m",strtotime($kidsList[$i]['dob'])); 
						}
						?>
						<a href="javascript:sel('<?= CLIENTROOT ?>/ajax/calendar/?fieldid=dob<?= $i ?><?=$dateStr?>')" class="customTitle" title="Calendar"><img src="<?= CLIENTROOT ?>/images/icons/24-columns.png" alt="Calendar" /></a>
					</td>
					<td>
                    	<label for="enrolled<?= $i ?>" class="hide">Enrolled <?= $i ?></label>
                        <input type="text" id="enrolled<?= $i ?>" name="enrolled[]" class="<? if ($edit == '1'){ ?>val_req <? } ?>"  maxlength="10" <? if(isset($kidsList)){ ?>value="<?=date("m/d/Y",strtotime($kidsList[$i]['enrolled']))?>" <? } else{ ?>value="<?=date('m/d/Y')?>" <? } ?> />
					</td>
					<td>
						<?
                        if ($kidsList) {
							$dateStr = '&year=' . date("Y",strtotime($kidsList[$i]['enrolled'])) . '&month=' . date("m",strtotime($kidsList[$i]['enrolled']));
						}
						?>
						<a href="javascript:sel('<?= CLIENTROOT ?>/ajax/calendar/?fieldid=enrolled<?= $i ?><?=$dateStr?>')" class="customTitle" title="Calendar"><img src="<?= CLIENTROOT ?>/images/icons/24-columns.png" alt="Calendar" /></a>
					</td>
					
					<? 
					if ($edit == '1') {
						?>
						<td>
                        	<label for="ethnicity<?= $i ?>" class="hide">Ethnicity <?= $i ?> </label>
							<? htmlSel(array('African American', 'Asian/Pacific Islander', 'Caucasian', 'Hispanic', 'Multiracial', 'Native American', 'Other', 'Prefer not to answer'), 'id="ethnicity' . $i . '" name="ethnicity[]" class="val_req"', $kidsList[$i]['ethnicity'], false, ''); ?>
						</td>
						<?
					} 
					else { 
						?>
						<td>
                        	<label for="ethnicity<?= $i ?>" class="hide">Ethnicity <?= $i ?></label>
							<? htmlSel(array('African American', 'Asian/Pacific Islander', 'Caucasian', 'Hispanic', 'Multiracial', 'Native American', 'Other', 'Prefer not to answer'), 'id="ethnicity' . $i . '" name="ethnicity[]" class="ethnicity val_skipifis scga' . $i . '"', 'Prefer not to answer', false, ''); ?>
						</td> 
						<?
					}
					?>
                    
					<td>
                    	<label for="handicap<?= $i ?>" class="hide customTitleClick">Current Handicap Index <?= $i ?></label>
						<input type="text" maxlength="<?= MAXLENA ?>" id="handicap<?= $i ?>" name="handicap[]" class="val_skipifis scga<?= $i ?> <? if ($edit == '1'){ ?> <? } ?>" value="<?=$kidsList[$i]['handicap']?>"/>
					</td>
                    
					<?
					if ($edit == '1') {
						?>
						<td>
                        	<label for="classification<?= $i ?>" class="hide">YOC Classification <?= $i ?> </label>
							<? htmlSel(array('Supervised', 'Unsupervised', 'Unclassified'), 'id="classification' . $i . '" name="classification[]" class="val_req" multiple="multiple" ', $kidsList[$i]['yoc_classification'], false, ''); ?>
						</td> 
						<?
					} 
					else {
						?>
						<td>
                        	<label for="classification<?= $i ?>" class="hide">YOC Classification <?= $i ?></label>
							<? htmlSel(array('Supervised', 'Unsupervised', 'Unclassified'), 'id="classification' . $i . '" name="classification[]" class="classification val_skipifis scga' . $i . '" multiple="multiple" ', 'Supervised', false, ''); ?>
						</td>
						<? 
					}
					?>
				</tr>
				<tr>
					<td></td>
					<th>Organization</th>
					<th>Grade</th>
                    <th colspan="2">Golf Certified</th>
                    <th colspan="2">Game Club</th>
					<th>Cert. Year</th>
					<th>Date Certified</th>
					<th></th>
					<th>Certification Status</th>
				</tr>
				<tr>
					<td></td>
					<td>
                    	<label for="organization<?= $i ?>" class="hide customTitleClick">Organization <?= $i ?></label>
						<input type="text" maxlength="<?= MAXLENA ?>" id="organization<?= $i ?>" name="organization[]" class=" val_skipifis scga<?= $i ?> <? if ($edit == '1'){ ?>val_req <? } ?>" value="<?=$kidsList[$i]['name']?>"/>
					
						<a href="javascript:sel('<?= CLIENTROOT ?>/ajax/kids/organization-select/?fieldid=organization<?= $i ?>')" class="customTitle" title="Select an Organization.">
                        <img src="<?= CLIENTROOT ?>/images/icons/24-columns.png" alt="Select an Organization." />
                        </a>
					</td>

					<? 
					if ($edit == '1') {
						?>
						<td>
                        	<label for="grade<?= $i ?>" class="hide">grade <?= $i ?> </label>
							<? htmlSel(array('5', '6','7', '8', '9', '10', '11','12'), 'id="grade' . $i . '" name="grade[]" class="val_req"', $kidsList[$i]['grade'], false, ''); ?>
						</td>
						<?
					} 
					else {
						?>
						<td>
                        <label for="grade<?= $i ?>" class="hide">grade <?= $i ?></label><? htmlSel(array('5', '6','7', '8', '9', '10', '11','12'), 'id="grade' . $i . '" name="grade[]" class="grade val_skipifis scga' . $i . '"', '5', false, ''); ?>
						</td>
						<?
					}
					?>
                    <td><input type="checkbox" id="golf_certified<?= $i ?>" name="golf_certified<?= $i ?>" value="1" <?= !empty($kidsList) && $kidsList[$i]['golf_certified'] == 0 ? '' : ' checked="checked"' ?> /></td>
					<td><label for="golf_certified<?= $i ?>" class="golf-certified">Golf Certified</label></td>
                    <td><input type="checkbox" id="game_club<?= $i ?>" name="game_club<?= $i ?>" value="1" <?= !empty($kidsList) && $kidsList[$i]['game_club'] == 1 ? ' checked="checked"' : '' ?> /></td>
					<td><label for="game_club<?= $i ?>" class="game-club">Game Club</label></td>
                    <?
					if ($edit == '1') {
						?>
						<td>
                        	<label for="ViewYear<?= $i ?>" class="hide customTitleClick">Certification Year <?= $i ?></label>
							<input disabled="disabled" type="text"id="ViewYear<?= $i ?>" name="ViewYear[]" value="<?=$kidsList[$i]['year']?>"/>
							<input type="hidden" id="year<?= $i ?>" name="year[]" value="<?=$kidsList[$i]['year']?>"/>
						</td>
						<td>
                        	<label for="date_certified<?= $i ?>" class="hide">Date Certified <?= $i ?></label>
                            <input type="text" id="date_certified<?= $i ?>" name="date_certified[]" maxlength="10" value="<?= $kidsList[$i]['date_certified'] ?>" />
						</td>
						<td>
							<?
							$certDateStr = '';
							if(!empty($kidsList) && $kidsList[$i]['date_certified'] != ''){ 
								$certDateStr = '&year=' . date('Y', strtotime($kidsList[$i]['date_certified'])) . '&month=' . date('m', strtotime($kidsList[$i]['date_certified']));
							}
							?>
							<a href="javascript:sel('<?= CLIENTROOT ?>/ajax/calendar/?fieldid=date_certified<?= $i ?><?=$certDateStr?>')" class="customTitle" title="Calendar"><img src="<?= CLIENTROOT ?>/images/icons/24-columns.png" alt="Calendar" /></a>
						</td>
						<td>
                        	<label for="certification_status<?= $i ?>" class="hide">Certification Status <?= $i ?> </label>
							<? htmlSel(array('Certified by Program','Certified (Online)','Not certified','Online Quizzes Submitted'), 'id="certification_status' . $i . '" name="certification_status[]" class="val_req certification-status" multiple="multiple" ', $kidsList[$i]['certification_status'], false, ''); ?>
						</td> 
						<? 
					} 
					else { 
						?>
						<td>
                        	<label for="year<?= $i ?>" class="hide customTitleClick">Certification Year <?= $i ?></label>
							<input type="text"  maxlength="4" id="year<?= $i ?>" name="year[]"  class="val_skipifis scga<?= $i ?>" value="<?=date('Y')?>"/>
						</td>
						<td>
                        	<label for="date_certified<?= $i ?>" class="hide">Date Certified <?= $i ?></label>
                            <input type="text" id="date_certified<?= $i ?>" name="date_certified[]" maxlength="10" />
						</td>
						<td>
							<?
							$certDateStr = '';
							if(!empty($kidsList) && $kidsList[$i]['date_certified'] != ''){ 
								$certDateStr = '&year=' . date('Y', strtotime($kidsList[$i]['date_certified'])) . '&month=' . date('m', strtotime($kidsList[$i]['date_certified']));
							}
							?>
							<a href="javascript:sel('<?= CLIENTROOT ?>/ajax/calendar/?fieldid=date_certified<?= $i ?><?=$certDateStr?>')" class="customTitle" title="Calendar"><img src="<?= CLIENTROOT ?>/images/icons/24-columns.png" alt="Calendar" /></a>
						</td>
						<td>
                        	<label for="certification_status<?= $i ?>" class="hide">Certification Status <?= $i ?> </label>
							<? htmlSel(array('Certified by Program', 'Not certified'), 'id="certification_status' . $i . '" name="certification_status[]" class="val_req certification-status" multiple="multiple" ', 'Not certified', false, ''); ?>
						</td> 
						<?
					}
					?>
                    
				</tr>
                
                <!--new segment-->
                
                
                <tr>
					<td></td>
					<th>Membership Status</th>
					<th></th>
                    <th colspan="2"></th>
                    <th colspan="2"></th>
					<th></th>
					<th></th>
					<th></th>
					<th></th>
				</tr>
				<tr>
					<td></td>
					 
                
                <? 
					if ($edit == '1') { echo $kidsList[$i]['status'];
						?>
						<td>
                        	<label for="status<?= $i ?>" class="hide">Status <?= $i ?> </label>
							<? htmlSel(array('active', 'inactive'), 'id="status' . $i . '" name="status[]" class="val_req"', $kidsList[$i]['status'], false, ''); ?>
						</td>
						<?
					} 
					else { 
						?>
						<td>
                        	<label for="status<?= $i ?>" class="hide">Status <?= $i ?></label>
							<? htmlSel(array('active', 'inactive'), 'id="status' . $i . '" name="status[]" class="status val_skipifis scga' . $i . '"', 'inactive', false, ''); ?>
						</td> 
						<?
					}
					?>
                    
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                
                </tr>
                
                <!--new segment-->
                
                
				<?
			} 
			?>
		</table>
        <br />
		<input id="form_addKidsSubmit" type="submit" value="Submit" />
	</form>
</div>