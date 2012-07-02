<?php

$_mysql->makeInputsSafe();

if ($_POST['scga'] != '') { // the scga will not be empty if the member is active

  if ($_POST['scga'] != $_POST['current_scga']) { // don't bother checking if the scga provided is the same
    // redirect if scga already exists that's not the current scga
    $sql = "SELECT scga FROM kids WHERE scga = '" . $_POST['scga'] . "' AND scga != '" . $_POST['current_scga'] . "'";
    $check = $_mysql->getSingle($sql);
    if ($check['scga'] != '') {
      $_SESSION['yoc_edit_message'] = 'The scga number you provided already exists.';
      $url = "http://" . $_SERVER['SERVER_NAME'] . CLIENTROOT . "/yoc_membership/edit?id=" . $_POST['yoc_id'];
      header('Location:' . $url);
    }

    // update the scga of kid if scga
    $whereStr = "scga = '" . $_POST['current_scga'] . "'";
    $_mysql->update('kids', 'scga', $_POST['scga'], $whereStr);
  }
}
$orgSql = "SELECT * FROM organization WHERE organizationid = '" .$_POST['yoc_type']."'";
$organization = $_mysql->getSingle($orgSql);

$yocFieldValuePairArr = array(
  'scga_ghin_number' => $_POST['scga'], // varchar 100
  'first_name' => ucwords(strtolower($_POST['fname'])), // vc 50
  'last_name' => ucwords(strtolower($_POST['lname'])), // vc 50
  'email' => $_POST['email'], // vc 100
  'dob' => $_POST['dob'], // vc 30
  'address_1' => $_POST['address'], // vc 200
  'city' => $_POST['city'], // vc 100
  'state' => $_POST['state'], // vc 100
  'zip_code' => $_POST['zip'], // vc 10
  'phone_number' => $_POST['phone'], // vc 30
  'ethnicity' => $_POST['ethnicity'], // vc 100
  'gender' => $_POST['gender'], // vc 30 - male or female
  'email_from_guardian' => $_POST['email_from_guardian'], // vc 100
  'scga_member' => $_POST['scga_member'], // vc 5 - yes or no
  'under_age' => $_POST['under_age'], // vc 30
  'years_playing_golf' => $_POST['years_playing_golf'], // vc 5
  'organization_id' => $_POST['yoc_type'], // org id
  'yoc_type' => $organization['name'], // org name
  'activation_note' => $_POST['activation_note'],
  'high_school_name' => $_POST['high_school_name']
);

$yocFields = array_keys($yocFieldValuePairArr);
$yocFieldValues = array_values($yocFieldValuePairArr);
$whereStr = "yoc_id = '" . $_POST['yoc_id'] . "'";
$_mysql->update('yoc_membership', $yocFields, $yocFieldValues, $whereStr);


if ($_POST['overwrite_kid'] == 1) {

  $kid = $_mysql->getSingle("SELECT k.addressid FROM address a INNER JOIN kids k ON a.addressid = k.addressid WHERE k.scga = '" . $_POST['scga'] . "'");

  // insert the address of the kid
  $kidsFieldValuePairArr = array(
    'address' => $_POST['address'], // vc 50
    'city' => $_POST['city'], // vc 50
    'state' => $_POST['state'], // c 2
    'country' => 'US',
    'zip' => $_POST['zip'], // vc 50
  );
  $addressFields = array_keys($kidsFieldValuePairArr);
  $addressFieldValues = array_values($kidsFieldValuePairArr);
  $addressWherestr = "addressid = '" . $kid['addressid'] . "'";
  $_mysql->update('address', $addressFields, $addressFieldValues, $addressWherestr);

  // update similar fields 
  $kidsFieldValuePairArr = array(
    'scga' => $_POST['scga'], // varchar 100 / vc 50
    'fname' => ucwords(strtolower($_POST['fname'])), // vc 50
    'lname' => ucwords(strtolower($_POST['lname'])), // vc 50
    'email' => $_POST['email'], // vc 100 / vc 50
    'dob' => changeDateFormat($_POST['dob']), // vc 30 / date
    'phone' => $_POST['phone'], // vc 50
    'ethnicity' => $_POST['ethnicity'], // vc 100 / enum
    'gender' => $_POST['gender'], // vc 30 - male or female / enum
  );

  $kidsFields = array_keys($kidsFieldValuePairArr);
  $kidsFieldValues = array_values($kidsFieldValuePairArr);
  $kidsWherestr = "scga = '" . $_POST['scga'] . "'";
  $_mysql->update('kids', $kidsFields, $kidsFieldValues, $kidsWherestr);

}

$_SESSION['yoc_edit_message'] = 'Changes successfully saved.';

$url = "http://" . $_SERVER['SERVER_NAME'] . CLIENTROOT . "/yoc_membership/edit?id=" . $_POST['yoc_id'];
header('Location:' . $url);