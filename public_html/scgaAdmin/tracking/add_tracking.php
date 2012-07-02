<div class="pop_container">
	<? 
    if($edit == 1){
        ?>
        <h1>Edit Tracking Record</h1>
        <?
    }
    else{
        ?>
        <h1>Add Tracking Record</h1>
        <?
    }
    ?>
    <label for="all_facility" class="customTitleClick"><strong>Facility</strong></label>
    <input type="text" maxlength="<?= MAXLENA ?>" id="all_facility" name="all_facility" onclick="setCurrentScgaIndex(0)"/>
    <div class="fleft">
        <a href="javascript:sel('<?= CLIENTROOT ?>/ajax/tracking/facility-select/?fieldid=all_facility')" class="customTitle" title="Select a Facility.">
        <img src="<?= CLIENTROOT ?>/images/icons/24-columns.png" alt="Select a Facility." />
        </a>
    </div>
    <br />
    <label>&nbsp;</label>
    <input type="checkbox" id="populate_all_facility" onclick="populate_all('facility', '<?= $_GET['number'] ?>'); setCurrentScgaIndex(0);" class="checkbox" />
    <label for="populate_all_facility">Populate Facilities</label>
    <br /><br />
    
    <label class="customTitleClick"><strong>Types:</strong></label>
    <input type="checkbox" id="populate_all_range" onclick="javascript:check_all('range', '<?= $_GET['number'] ?>', this.checked); setCurrentScgaIndex(0);" class="checkbox" />
    <label for="populate_all_range">Check All Range</label>
    <br />
    <label>&nbsp;</label>
    <input type="checkbox" id="populate_all_course" onclick="javascript:check_all('course', '<?= $_GET['number'] ?>', this.checked); setCurrentScgaIndex(0);" class="checkbox" />
    <label for="populate_all_course">Check All Course</label>
    <br /><br />	
    
    <label for="all_date" class="customTitleClick"><strong>Date</strong></label>
    <input type="text" maxlength="10" id="all_date" name="all_date" onclick="setCurrentScgaIndex(0)" />
    <div class="fleft">
        <a href="javascript:sel('<?= CLIENTROOT ?>/ajax/calendar/?fieldid=all_date')" class="customTitle" title="Calendar">
        <img src="<?= CLIENTROOT ?>/images/icons/24-columns.png" alt="Calendar" />
        </a>
    </div>
    <br />
    <label>&nbsp;</label>
    <input type="checkbox" id="populate_all_date" onclick="populate_all('date', '<?= $_GET['number'] ?>'); setCurrentScgaIndex(0);" class="checkbox" />
    <label for="populate_all_date">Populate Dates</label>
    <br /><br />
    
    <iframe class="hide" name="form_addTrackingTarget" src="#"></iframe>
    <div id="form_addTrackingError" class="hide"></div>
    <form id="select_tracking_form" action="<?= CLIENTROOT ?>/action/tracking/save-tracking/" method="post" target="form_addTrackingTarget">
    <input type="hidden" id="edit" name="edit" value="<?= $edit ?>" />
    <br />
    <input id="form_addTrackingSubmit" type="submit" value="Submit" />
    <table class="add">
        <tr>
        	<?
			if ($edit != '1') {
				?>
        		<th></th>
                <?
			}
			?>
            <th>#</th>
            <th>Date</th>
            <th></th>
            <th>SCGA Mem. #</th>
            <th>Facility</th>
            <th></th>
            <th colspan="4">Type</th>
        </tr>
        <? 
        for($i = 0; $i < $_GET['number']; $i++){
            ?>
        <tr>
        	<?
			if ($edit != '1') {
				?>
        		<td class="clear-row"><a onclick="clearTrackingRow(<?= $i ?>); return false;">Clear</a></td>
                <?
			}
			?>
            <td class="number"><?= $i + 1 ?>.</td>
            <td><div id="select_tracking_calPop<?= $i ?>" class="calendar_pop"></div>
                <label for="date<?= $i ?>" class="hide">Date <?= $i ?></label>
                <input type="text" id="date<?= $i ?>" name="date[]" class="<? if ($edit == '1'){ ?>val_req <? } ?>"  maxlength="10" <? if(isset($trackingRecordList)){ ?>value="<?= date("m/d/Y", strtotime($trackingRecordList[$i]['date'])) ?>" <? } ?> onclick="setCurrentScgaIndex(<?= $i ?>)"/>
            </td>
            <td>
                <? 
                if($trackingRecordList){ 
                    $dateStr = '&year=' . date("Y", strtotime($trackingRecordList[$i]['date'])) . '&month=' . date("m", strtotime($trackingRecordList[$i]['date'])); 
                } 
                ?>
                
                <a href="javascript:sel('<?= CLIENTROOT ?>/ajax/calendar/?fieldid=date<?= $i ?><?= $dateStr ?>')" class="customTitle" title="Calendar">
                <img src="<?= CLIENTROOT ?>/images/icons/24-columns.png" alt="Calendar" /></a>
            </td>
            <td><label for="scga<?= $i ?>" class="hide">SCGA <?= $i ?></label>
            <input type="text" id="scga<?= $i ?>" name="scga[]" class="val_skipifis date<?= $i ?> <? if ($edit == '1'){ ?>val_req <? } ?>" maxlength="<?= MAXLENA ?>" value="<?= $trackingRecordList[$i]['scga'] ?>" onclick="updateCurrentScgaIndex(<?= $i ?>)"/>
            <input type="hidden" id="oldScga<?= $i ?>" name="oldScga[]" <? if(isset($trackingRecordList)){ ?>value="<?= $trackingRecordList[$i]['scga'] ?>" <? } else { ?> value="0" <? } ?> />
            
            <input type="hidden" id="trackingid<?= $i ?>" name="trackingid[]" <? if(isset($trackingRecordList)){ ?>value="<?= $trackingRecordList[$i]['trackingid'] ?>" <? } else { ?> value="0" <? } ?> />
            
            
            </td>
            <td><label for="facility<?= $i ?>" class="hide customTitleClick">Facility <?= $i ?></label>
            <input type="text" maxlength="<?= MAXLENA ?>" id="facility<?= $i ?>" name="facility[]" class="val_skipifis date<?= $i ?> <? if ($edit == '1'){ ?>val_req <? } ?>" value="<?= $trackingRecordList[$i]['name'] ?>" onclick="updateCurrentScgaIndex(<?= $i ?>)"/>
            <input type="hidden" id="oldFacilityName<?= $i ?>" name="oldFacilityName[]" <? if(isset($trackingRecordList)){ ?>value="<?= $trackingRecordList[$i]['name'] ?>" <? } else { ?> value="0" <? } ?> />
            </td>
            <td>
                <a href="javascript:sel('<?= CLIENTROOT ?>/ajax/tracking/facility-select/?fieldid=facility<?= $i ?>')" class="customTitle" title="Select a Facility.">
                <img src="<?= CLIENTROOT ?>/images/icons/24-columns.png" alt="Select a Facility." /></a>
            </td>
            <? 
			if($edit != '1'){
				?>
                <td><input type="checkbox" name="range<?= $i ?>" id="range<?= $i ?>" value="1" <? if($trackingRecordList[$i]['type'] == 'Range'){?> checked="checked"<? } ?> onclick="updateCurrentScgaIndex(<?= $i ?>)"/></td>
                <td><label for="range<?= $i ?>">Range</label></td>
                <td><input type="checkbox" name="course<?= $i ?>" id="course<?= $i ?>" value="1" <? if($trackingRecordList[$i]['type'] == 'Course'){?> checked="checked"<? } ?> onclick="updateCurrentScgaIndex(<?= $i ?>)"/></td>
                <td><label for="course<?= $i ?>">Course</label></td>
            	<?
			}
			else{
				?>
                <td><input type="radio" name="type<?= $i ?>" id="range<?= $i ?>" value="Range" <? if($trackingRecordList[$i]['type'] == 'Range'){?> checked="checked"<? } ?> onclick="updateCurrentScgaIndex(<?= $i ?>)"/></td>
                <td><label for="range<?= $i ?>">Range</label></td>
                <td><input type="radio" name="type<?= $i ?>" id="course<?= $i ?>" value="Course" <? if($trackingRecordList[$i]['type'] == 'Course'){?> checked="checked"<? } ?> onclick="updateCurrentScgaIndex(<?= $i ?>)"/></td>
                <td><label for="course<?= $i ?>">Course</label></td>
                <?
			}
			?>
            </tr>
            <?
        }
        ?>
    </table>
    <br /><br />
    <input id="form_addTrackingSubmit" type="submit" value="Submit" />
    </form>
</div>