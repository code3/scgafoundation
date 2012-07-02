<?php
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
  $id = $_GET['id'];
  $row = $_mysql->getSingle("SELECT * from yoc_membership WHERE yoc_id = '" . $id . "'");

  if($row['scga_ghin_number'] != '' ) {
    $kidsql = "SELECT scga FROM kids WHERE scga = '".$row['scga_ghin_number']."'";
    $kidrow = $_mysql->getSingle($kidsql);
  }
}


$ethnicityOptions = array(
  "African American",
  "Asian/Pacific Islander",
  "Caucasian",
  "Hispanic",
  "Multiracial",
  "Native American",
  "Other",
  "Prefer not to answer"
);

$yocTypeOptions = array(
  '007380320001' => 'Youth on Course West',
  '007380340001' => 'Youth on Course North',
  '007380350001' => 'Youth on Course East',
  '007380360001' => 'Youth on Course South'
);

$genderOptions = array(
  'M' => 'male',
  'F' => 'female'
);

$scgaMemberOptions = array(
  'yes',
  'no'
);

$underageOptions = array(
  'yes',
  'no'
);
?>

<style type="text/css">
  fieldset input {
    margin-bottom : 15px;
  }

  fieldset#main {
    float        : left;
    margin-right : 35px;
  }

  fieldset#scondary {
    float  : right;
    border : 1px solid red;
  }

  #button-area {
    clear    : both;
    overflow : auto;
    float    : left;
  }
</style>

<div id="edit-yoc-membership-page">
  <p style='color: green; font-weight: bold; margin-bottom: 15px;'>
    <?php echo ($_SESSION['yoc_edit_message']) ? $_SESSION['yoc_edit_message'] . "<br />"
      : ''; unset($_SESSION['yoc_edit_message']); ?>
  </p>

  <a href="<?php echo CLIENTROOT ?>/yoc_membership/main">< Back</a> <br><br>

  <h1>Edit YOC Membership</h1>

  <form action="<?php echo CLIENTROOT ?>/action/yoc_membership/edit" method="post">

    <input type="hidden" name='yoc_id' value='<?php echo $id ?>'>
    <input type="hidden" name='current_scga' value='<?php echo $row['scga_ghin_number'] ?>'>

    <fieldset id='main'>

      <!-- will be disabled if the current membership is already active -->
      <?php if ($row['scga_ghin_number'] != '') { ?>
      <label for="scga">SCGA:</label>
      <input type="text" name="scga" value="<?php echo $row['scga_ghin_number'] ?>" /><br>
      <!--<input type="hidden" name="scga" value="<?php /*echo $row['scga_ghin_number'] */?>"/><br>-->
      <?php } else { ?>
      <p style='color: red;'><em>Not yet activated.</em></p> <br>
      <?php } ?>
      
      <label for="fname">First Name:</label>
      <input type="text" name="fname" value="<?php echo $row['first_name']  ?>"/><br>

      <label for="lname">Last Name:</label>
      <input type="text" name="lname" value="<?php echo $row['last_name']  ?>"/><br>

      <label for="email">Email:</label>
      <input type="text" name="email" value="<?php echo $row['email']  ?>"/> <br>

      <!-- coumpound form element-->
      <label for="dob">Date of Birth:</label>
      <div id="calendarHolder" class="calendar_pop"></div>
      <input type="text" name="dob" id='dobInput' value="<?php echo date("m/d/Y", strtotime($row['dob'])) ?>"/>
      <a href="javascript: setupCalPopUp('calendarHolder', 'dobLink', $('dobInput'));"
         id="dobLink" class="customTitle" title="Open Calendar"><img
          src="<?= CLIENTROOT ?>/images/icons/24-columns.png"/></a><br/>

      <!-- address -->
      <label for="address_1">Address:</label>
      <input type="text" name="address" value="<?php echo $row['address_1']  ?>"/><br>

      <label for="city">City:</label>
      <input type="text" name="city" value="<?php echo $row['city']  ?>"/><br>

      <label for="state">State:</label>
      <input type="text" name="state" value="<?php echo $row['state']  ?>"/><br>

      <label for="zip">Zip:</label>
      <input type="text" name="zip" value="<?php echo $row['zip_code']  ?>"/><br>
      <!-- /address -->

      <label for="phone">Phone:</label>
      <input type="text" name="phone" value="<?php echo $row['phone_number']  ?>"/><br>

    </fieldset>

    <fieldset id='secondary'>

      <label for="ethnicity">Ethnicity</label>
      <?php htmlSel($ethnicityOptions, "name='ethnicity'", $row['ethnicity'], false, 'Ethnicity...'); ?>
      <br>

      <label for="gender">Gender:</label>
      <?php htmlSel($genderOptions, "name='gender'", $row['gender'], false, false); ?> <br>

      <label for="email_from_guardian">Email from guardian:</label>
      <input type="text" name="email_from_guardian" value="<?php echo $row['email_from_guardian']  ?>"/> <br>

      <label for="scga_member">SCGA Member:</label>
      <?php htmlSel($scgaMemberOptions, "name='scga_member'", $row['scga_member'], false, false); ?> <br>

      <label for="underage">Underage:</label>
      <?php htmlSel($underageOptions, "name='under_age'", $row['under_age'], false, false); ?> <br>

      <label for="years_playing_golf">Years playing golf:</label>
      <input type="text" name="years_playing_golf" value="<?php echo $row['years_playing_golf']  ?>"/><br>

      <label for="highschool">Highschool:</label>
      <input type="text" name="high_school_name" value="<?php echo $row['high_school_name'] ?>"/><br>

      <!--<label for="activation_status">Activation Status:</label>
      <input type="text" name="activation_note" value="<?php /*echo $row['activation_status'] */?>"/><br>-->

      <label for="yoc_type">YOC Type:</label>
      <?php htmlSel($yocTypeOptions, "name='yoc_type'", $row['yoc_type'], true, false); ?>
      <br>

      <label for="activation_note">Activation Note:</label>
      <textarea name="activation_note"
                style='height: 50px; width: 300px;'><?php echo $row['activation_note'] ?></textarea>

    </fieldset>

    <!-- the checkbox should only appear when the membership is active-->
    <?php if ($kidrow['scga'] != '') { ?>
    <div style='padding: 20px 0; float: left; clear: both;'>
      <!-- if checked, the record will sync with the record with the same scga number in the kids table-->
      <input type="checkbox" name='overwrite_kid' value='1'/> &nbsp; Sync with kid record with the same scga number.
      <br>
    </div>
    <?php } ?>

    <div id='button-area' style='padding: 20px 0;'><input type="submit" value='Save Changes'></div>

  </form>

</div>