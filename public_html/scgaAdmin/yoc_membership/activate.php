<?php
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
  $id = $_GET['id'];
  $row = $_mysql->getSingle("SELECT * from yoc_membership WHERE yoc_id = '" . $_GET['id'] . "'");
}
?>

<div id="edit-yoc-membership-page">

  <a href="<?php echo CLIENTROOT ?>/yoc_membership/main">< Back</a> <br><br>

  <h1>Activate YOC Membership</h1>

  <form action="<?php echo CLIENTROOT ?>/action/yoc_membership/activate" method="post">
    <label for="fname">First Name:</label> <?php echo $row['first_name'] ?> <br>
    <label for="lname">Last Name:</label> <?php echo $row['last_name'] ?> <br>
    <label for="email">E-mail:</label> <?php echo $row['email'] ?> <br>

    <!-- make the scga number uneditable it was provided by the new member -->
    <label for="scga">SCGA#</label>
    <input type="text" name='scga_ghin' value='<?php echo $row['scga_ghin_number']; ?>'/> <br><br>
    
    <input type="hidden" name="activation_status" value="1"/>
    <input type="hidden" name="fname" value="<?php echo $row['first_name']  ?>"/>
    <input type="hidden" name="lname" value="<?php echo $row['last_name']  ?>"/>
    <input type="hidden" name="email" value="<?php echo $row['email']  ?>"/>
    <input type="hidden" name="phone" value="<?php echo $row['phone_number']  ?>"/>
    <input type="hidden" name="gender" value="<?php echo strtoupper(substr($row['gender'], 0, 1)) ?>"/>
    <input type="hidden" name="dob" value="<?php echo $row['dob']  ?>"/>
    <input type="hidden" name="golf_certified" value="1"/>
    <input type="hidden" name="ethnicity" value="<?php echo $row['ethnicity']  ?>"/>
    <input type="hidden" name="enrolled" value="<?php echo date('m/d/Y')  ?>"/>
    <input type="hidden" name="handicap" value=""/>
    <input type="hidden" name="classification" value="Supervised"/>
    <input type="hidden" name="grade" value="5"/>
    <input type="hidden" name="game_club" value=""/>
    <input type="hidden" name="address" value="<?php echo $row['address_1']  ?>"/>
    <input type="hidden" name="city" value="<?php echo $row['city']  ?>"/>
    <input type="hidden" name="state" value="<?php echo $row['state']  ?>"/>
    <input type="hidden" name="zip" value="<?php echo $row['zip_code']  ?>"/>

    <input type="hidden" name="yoc_organization_id" value="<?php echo $row['organization_id']  ?>"/>
    <input type="hidden" name="yoc_id" value="<?php echo $row['yoc_id']  ?>"/>

    <!--<input type="hidden" name="return_url" id="return_url" value="<?php /*echo $urlLocatorObj->getEntireUrlAddress()  */?>"/>-->

    <input type="submit" value='Activate'>
  </form>

</div>