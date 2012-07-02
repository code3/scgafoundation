<?
require ('parts/update_alert.php');
?>


<?
$_mysql = new mysql();
$_mysql->makeInputsSafe();
//print_r($_kid);

$_games = $_mysql->get('SELECT * FROM game');

$_mysql->close();

?>






<h1>Kid: <?=$_kid['fname']?> <?=$_kid['lname']?></h1>

<?php if ($_quizzes['handicap']) { ?>
<div style='padding-bottom: 15px;'>
  <strong>Handicap Quiz Score:</strong> <?php echo $_quizzes['handicapPercent'] . '%'; ?>
</div>
<?php } ?>

<label for="age">Age:</label>

<?
if ($_kid['dob'] != '0000-00-00') {
  ?>
  <?= $_kid['kidAge'] ?>
<?
}
?>
<br/>
<iframe name="form_editKidsTarget" class="hide" src="#"></iframe>
<div id="form_editKidsError" class="hide"></div>
<form id="select_kids_form" action="<?= CLIENTROOT ?>/action/kids/save-kids/" method="post"
      target="form_editKidsTarget">
  <div class="details-col">
    <input type="hidden" id="edit" name="edit" value="1"/>
    <input type="hidden" name="details_form" value="1"/>
    <label for="scga">SCGA:</label>
    <input <? if (!$_isAdmin) { ?>disabled="disabled"<? } ?> type="text" id="scga" name="scga[]" class="val_req text"
                                                             maxlength="<?= MAXLENA ?>" value="<?=$_kid['scga']?>"/>
    <input type="hidden" id="oldScga" name="oldScga[]" value="<?=$_kid['scga']?>"/>

    <br/>
    <label for="fname">First Name:</label>
    <input <? if (!$_isAdmin) { ?>disabled="disabled"<? } ?> type="text" maxlength="<?= MAXLENA ?>" id="fname"
                                                             name="fname[]" class="val_req text"
                                                             value="<?=$_kid['fname']?>"/>
    <br/>
    <label for="lname">Last Name:</label>
    <input <? if (!$_isAdmin) { ?>disabled="disabled"<? } ?> type="text" maxlength="<?= MAXLENA ?>" id="lname"
                                                             name="lname[]" class="val_req text"
                                                             value="<?=$_kid['lname']?>"/>
    <br/>
    <label for="phone">Phone:</label>
    <input <? if (!$_isAdmin) { ?>disabled="disabled"<? } ?> type="text" maxlength="<?= MAXLENA ?>" id="phone"
                                                             name="phone[]" class="val_req text"
                                                             value="<?=$_kid['phone']?>"/>
    <br/>

    <label
        for="gender">Gender:</label><? htmlSel(array('M', 'F'), $disable . 'id="gender" name="gender[]" class="val_req" ', $_kid['gender'], false, 'Gender...'); ?>
    <br/>

    <label for="email">Email:</label>
    <input <? if (!$_isAdmin) { ?>disabled="disabled"<? } ?> type="text" maxlength="<?= MAXLENA ?>" id="email"
                                                             name="email[]" class="val_req text"
                                                             value="<?=$_kid['email']?>"/> <br/>

    <label for="parentEmail">Parent/Guardian Email:</label>
    <input <? if (!$_isAdmin) { ?>disabled="disabled"<? } ?> type="text" maxlength="<?= MAXLENA ?>" id="email_from_guardian"
                                                             name="email_from_guardian[]" class="val_req text"
                                                             value="<?=$_kid['email_from_guardian']?>"/> <br/>

    <label for="address">Address:</label>
    <input <? if (!$_isAdmin) { ?>disabled="disabled"<? } ?> type="text" maxlength="<?= MAXLENA ?>" id="address"
                                                             name="address[]" class="val_req text"
                                                             value="<?=$_kid['address']?>"/>
    <br/>
    <label for="address2"></label>
    <input <? if (!$_isAdmin) { ?>disabled="disabled"<? } ?> type="text" maxlength="<?= MAXLENA ?>" id="address2"
                                                             name="address2[]" value="<?=$_kid['address2']?>"
                                                             class="text"/>
    <br/>
    <label for="city">City:</label>
    <input <? if (!$_isAdmin) { ?>disabled="disabled"<? } ?> type="text" maxlength="<?= MAXLENA ?>" id="city"
                                                             name="city[]" class="val_req text"
                                                             value="<?=$_kid['city']?>"/>
    <br/>

    <label
        for="state">State:</label><? htmlSel($_states, $disable . 'id="state" name="state[]" class="val_req" ', $_kid['state'], true, 'State...'); ?>
    <br/>

    <label for="zip">Zip:</label>
    <input <? if (!$_isAdmin) { ?>disabled="disabled"<? } ?> type="text" maxlength="<?= MAXLENA ?>" id="zip"
                                                             name="zip[]" class="val_req val_num"
                                                             value="<?=$_kid['zip']?>"/>
    <br/>
  </div>
  <div class="details-col">
    <div id="select_kids_calPop" class="calendar_pop"></div>
    <label for="dob">DOB:</label><input <?= (!$_isAdmin) ? ' disabled="disabled"' : '' ?> type="text" id="dob"
                                                                                          name="dob[]" class="text"
                                                                                          maxlength="10" <? if ($_kid['dob'] != '0000-00-00' && $_kid['dob'] != '') { ?>value="<?=date("m/d/Y", strtotime($_kid['dob']))?>" <?
  }
  else {
    ?> value="" <? } ?>/>

    <a href="javascript: setupCalPopUp('select_kids_calPop', 'select_kids_cal_link', $('dob'));"
       id="select_kids_cal_link" class="customTitle" title="Open Calendar"><img
        src="<?= CLIENTROOT ?>/images/icons/24-columns.png"/></a><br/>

    <label for="enrolled">Enrolled:</label><input <? if (!$_isAdmin) { ?>disabled="disabled"<? } ?> type="text"
                                                                                                    id="enrolled"
                                                                                                    name="enrolled[]"
                                                                                                    class="val_req text"
                                                                                                    maxlength="10" <? if ($_kid['enrolled'] != '0000-00-00') { ?>value="<?=date("m/d/Y", strtotime($_kid['enrolled']))?>" <?
  }
  else {
    ?> value="00/00/0000" <? } ?> />

    <a href="javascript: setupCalPopUp('select_kids_calPop', 'select_kids_cal_link2', $('enrolled'));"
       id="select_kids_cal_link2" class="customTitle" title="Open Calendar"><img
        src="<?= CLIENTROOT ?>/images/icons/24-columns.png"/></a>
    <br/>
    <label
        for="ethnicity">Ethnicity:</label><? htmlSel(array('African American', 'Asian/Pacific Islander', 'Caucasian', 'Hispanic', 'Multiracial', 'Native American', 'Other', 'Prefer not to answer'), $disable . 'id="ethnicity" name="ethnicity[]" class="val_req" ', $_kid['ethnicity'], false, 'Ethnicity...'); ?>
    <br/>
    <label for="handicap">Handicap Index:</label>
    <input <? if (!$_isAdmin) { ?>disabled="disabled"<? } ?> type="text" maxlength="<?= MAXLENA ?>" id="handicap"
                                                             name="handicap[]" class="text"
                                                             value="<?=$_kid['handicap']?>"/>
    <br/>

    <label for="classification">YOC
      Classification:</label><? htmlSel(array('Supervised', 'Unsupervised', 'Unclassified'), $disable . 'id="classification" name="classification[]" class="val_req" ', $_kid['yoc_classification'], false, 'YOC Classification...'); ?>
    <br/>
    <label for="organization">Organization:</label>
    <input <? if (!$_isAdmin) { ?>disabled="disabled"<? } ?> type="text" maxlength="<?= MAXLENA ?>" id="organization"
                                                             name="organization[]" class="val_req text"
                                                             value="<?=$_kid['name']?>"/>
    <?
    if ($_isAdmin) {
      ?>
      <a href="javascript:sel('<?= CLIENTROOT ?>/ajax/kids/organization-select/?fieldid=organization')"
         class="customTitle" title="Select an Organization."><img src="<?= CLIENTROOT ?>/images/icons/24-columns.png"
                                                                  alt="Select an Organization."/></a>
      <?
    }
    ?>
    <br/>
    <label
        for="grade">Grade:</label><? htmlSel(array('5', '6', '7', '8', '9', '10', '11', '12'), $disable . 'id="grade" name="grade[]" class="val_req" ', $_kid['grade'], false, 'Grade...'); ?>
    <br/>

    <label
            for="highschool">Highschool:</label><? htmlSel(array(1=>'Yes', 0=>'No'), $disable . 'id="grade" name="highschool[]" class="val_req" ', $_kid['highschool'], true, '...'); ?>
        <br/>

    <div class="column">
      <input type="checkbox" id="golf_certified0" name="golf_certified0" value="1" <?= $_kid['golf_certified'] == 1
          ? ' checked="checked"' : '' ?> class="checkbox"/>
      <label for="golf_certified0">Golf Certified</label>
      <br/>
      <input type="checkbox" id="game_club0" name="game_club0" value="1" <?= $_kid['game_club'] == 1
          ? ' checked="checked"' : '' ?> class="checkbox"/>
      <label for="game_club0">Game Club</label>
    </div>
    <br/>
    <?
    if ($_quizzes['etiquettePercent'] != '') {
      ?>
      <label for="etiquette">Etiquette Grade:</label> <?= $_quizzes['etiquettePercent'] ?>
      <br/>
      <?
    }
    if ($_quizzes['rulesPercent'] != '') {
      ?>
      <label for="rules">Rules Grade:</label><?= $_quizzes['rulesPercent'] ?>
      <br/>
      <?
    }
    ?>

    <?php if ($_quizzes['handicapPercent'] != '') { ?>
    <label for="handicap">Handicap Grade:</label><?= $_quizzes['handicapPercent'] ?> <br>
    <?php } ?>

    <label for="lifeSkills">Life Skills:</label>
    <? htmlSel(array('Pending', 'Under Review', 'Passed', 'Revise'), $disable . ' id="lifeSkills" name="lifeSkills[]" class="val_req" ', $_quizzes['lifeSkillsStatus'], false, 'Grade...'); ?>
    <a onclick="emailLifeSkillsStatus('<?=$_kid['scga']?>', '<?=$_quizzes['lifeSkillsStatus']?>');" class="customTitle"
       title="Email Life Skills Email"><img src="<?= CLIENTROOT ?>/images/icons/24-email-forward.png"
                                            alt="Email Life Skills Email"/></a>
    <a onclick="javascript:showLifeSkills('<?=$_kid['scga']?>');" class="customTitle" title="View Answers"><img
        src="<?= CLIENTROOT ?>/images/icons/24-zoom.png" alt="View Answers"/></a>
    <br/>
    <label for="resetPassword">Password:</label>
    <a onclick="emailTempLogin('<?=$_kid['scga']?>');" class="customTitle" title="Email Temp Login"><img
        src="<?= CLIENTROOT ?>/images/icons/24-email-forward.png" alt="Email Temp Login"/></a>
  </div>
  <br/>
  <label>&nbsp;</label>
  <input type="button" onclick="javascript:history.back()" class="button" value="Back"/>
  <input <? if (!$_isAdmin) { ?>style="display:none;" disabled="disabled"<? } ?> class="submit-button" type="submit"
                                                      value="Update"/>
</form>
<script type="text/javascript">
  <!--
  valForm.init($('select_kids_form'));
  //-->
</script>


<br/><br/>
<h1>Kid Certifications</h1>

<? //testing git repo
if ($_certifications) {

  if ($_isAdmin) { //start delete form
    ?>
		<form id="certification_del_form" action="<?= CLIENTROOT ?>/action/kids/delete_certification/" method="post">
		<?
  }
  ?>
  <table class="listing">
    <?
    if ($_isAdmin) {
      ?>
      <th></th>
      <th></th>
      <?
    }
    ?>
    <th>#</th>
    <th>Year</th>
    <th>Status</th>
    <?
    $rowCount = 1;
    $i = 0;
    foreach ($_certifications as $certification) {
      ?>
      <tr <? if ($i % 2 == 1) { ?> class="bg"<? } ?>>
        <?
        if ($_isAdmin) { //add delete checkboxes, edit, and delete button
          ?>
          <td><input type="checkbox" id="checkBox_<?= $certification['certificationid'] ?>"
                     value="<?= $certification['certificationid'] ?>" name="checked_certification[]"/></td>
          <td>
            <a href="javascript:$('checkBox_<?= $certification['certificationid'] ?>').checked = true; showAdd('certification2','<?=$certification['certificationid']?>');"
               class="customTitle" title="Edit"><img src="<?= CLIENTROOT ?>/images/icons/24-pencil.png" alt="Edit"/></a>
            <a onclick="confirm2(event, 'Delete Certification?', '$(\'checkBox_<?= $certification['certificationid']  ?>\').checked = true; $(\'certification_del_form\').submit()')"
               class="customTitle" title="Delete"><img src="<?= CLIENTROOT ?>/images/icons/24-em-cross.png"
                                                       alt="Delete"/></a></td>
          <?
        }
        ?>
        <td><?=$rowCount?></td>
        <td><?=$certification['year']?></td>
        <td><?=$certification['certification_status']?></td>
      </tr>
      <?
      $i++;
      $rowCount++;
    }
    ?>
  </table>
  <? if ($_isAdmin) { //add check all, delete all and edit button ?></form><?
  } //end the form
  ?><?
}
?>


<br/>
<input <? if (!$_isAdmin) { ?>style="display:none;" disabled="disabled"<? } ?> type="button"
                                                    onclick="showAdd('certification','<?=$_kid['scga']?>')"
                                                    value="Add Certification"/>
<br/><br/>

<? if ($_kid['game_club'] == 1) { ?>

<h1>GAME Club</h1>
<?
  $totalpoints = 0;
  $balance = 0;
  if ($_games) {

    if ($_isAdmin) { //start delete form
      ?>
		<form id="game_del_form" action="<?= CLIENTROOT ?>/action/kids/delete-game/ " method="post">
		<?
    }
    ?>
    <table class="listing">
    	<?
    if ($_isAdmin) {
      ?>
      <th></th>
      <th></th>
      <?
    }
    ?>
    <th>#</th>
    <th>Date</th>
    <th>Amount of Points</th>
    <th>Description</th>
    <th>Type of Points</th>
    </tr>
    <?
    $rowCount = 1;
    $i = 0;
    foreach ($_games as $game) {
      if ($game['scga'] == $_kid['scga']) {
        if ($game['amount'] > 0) {
          $totalpoints = $totalpoints + $game['amount'];
        }
        $balance = $balance + $game['amount'];
        ?>
        <tr <? if ($i % 2 == 1) { ?> class="bg"<? } ?>>
          <?
          if ($_isAdmin) { //add delete checkboxes, edit, and delete button
            ?>
            <td><input type="checkbox" id="checkBox_<?= $game['gameid'] ?>" value="<?= $game['gameid'] ?>"
                       name="checked_game[]"/></td>
            <td><a
                onclick="confirm2(event, 'Delete Game?', '$(\'checkBox_<?= $game['gameid']  ?>\').checked = true; $(\'game_del_form\').submit()')"
                class="customTitle" title="Delete"><img src="<?= CLIENTROOT ?>/images/icons/24-em-cross.png"
                                                        alt="Delete"/></a></td><? } ?>
          <td><?=$rowCount?></td>
          <td><?=date("m/d/Y", strtotime($game['date']))?></td>
          <td><?=$game['amount']?></td>
          <td>
            <div style=" padding: 5px;"><?=$game['description']?></div>
          </td>
          <td>
            <div style=" padding: 5px;"><?=$game['vtype']?></div>
          </td>
        </tr>
        <?
        $i++;
        $rowCount++;
      }
      if ($_isAdmin) { //add check all, delete all and edit button
        ?>
        </form> 
		<?
      }//end the form
      ?>

    <?
    }
  }
  ?>
</table> <br/>
<input <? if (!$_isAdmin) { ?>style="display:none;" disabled="disabled"<? } ?> type="button"
                                                    onclick="showAdd('game','<?=$_kid['scga']?>')"
                                                    value="Add GAME Points"/>
<br/><br/>
<h1>ACCOUNT BALANCE: <?=$balance?></h1>
<h1>TOTAL POINTS EARNED: <?=$totalpoints?></h1>
<? } ?>

<h1>Kid Notes</h1>
<?
require('note.php'); ?> <br/>