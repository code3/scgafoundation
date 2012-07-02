<?php

$_mysql->makeInputsSafe();

require_once($_SERVER['DOCUMENT_ROOT'] . "/scgaAdmin/library/php/login_v2.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/scgaAdmin/library/php/email.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/scgaAdmin/php/formatted_emails.php");
include($_SERVER['DOCUMENT_ROOT'] . '/../zend/application/modules/scga/models/UrlLocator.php');

$urlLocatorObj = new Scga_Model_UrlLocator();
$urlToMain = $urlLocatorObj->getUrlProtocol() . '://' . $_SERVER['SERVER_NAME'] . '/scgaAdmin/yoc_membership/main';

if (!empty($_POST['yoc_id']) && !empty($_POST['scga_ghin']) && !empty($_POST['yoc_organization_id'])) {

  // check if there is a duplicate of the scga provided
  // redirect if there is 
  $sql = "SELECT scga FROM kids WHERE scga = '" . $_POST['scga_ghin'] . "'"; // check the kids table
  $check = $_mysql->getSingle($sql);

  if ($check['scga'] != '') {
    $_SESSION['error_type'] = 'The scga number you provided already exists.';
    die( header('Location:' . $urlToMain) );
  }
  

  $yocFields = array(
    'scga_ghin_number',
    'activation_status'
  );

  $yocFieldsvalues = array(
    $_POST['scga_ghin'],
    $_POST['activation_status']
  );

  $_mysql->update('yoc_membership', $yocFields, $yocFieldsvalues, 'yoc_id = "' . $_POST['yoc_id'] . '"');

  // create login for this membership
  // will allow login to the youthpanel where they can take the certification quizzes

  if ($loginID = $_login->createLogin($_mysql->makeSafe(trim($_POST['scga_ghin'])), 'password', 4)) {

    $addressFields = array(
      'address',
      'address2',
      'city',
      'state',
      'zip'
    );

    $addressValues = array(
      $_POST['address'],
      '',
      $_POST['city'],
      $_POST['state'],
      $_POST['zip']
    );

    $_mysql->insert('address', $addressFields, $addressValues);
    // ADDRESS BEFORE KIDS, KIDS RECEIVES ADDRESSID

    $addID = mysql_insert_id();

    //date formats for db
    $dob = changeDateFormat($_POST['dob']);
    $enrolled = changeDateFormat($_POST['enrolled']);

    $kidsFields = array(
      'scga',
      'loginid',
      'fname',
      'lname',
      'phone',
      'gender',
      'email',
      'addressid',
      'dob',
      'enrolled',
      'ethnicity',
      'handicap',
      'yoc_classification',
      'organizationid',
      'grade',
      'golf_certified',
      'game_club'
    );

    $kidsValues = array(
      $_POST['scga_ghin'],
      $loginID, //create login returned its login id
      ucwords(strtolower($_POST['fname'])),
      ucwords(strtolower($_POST['lname'])),
      $_POST['phone'],
      $_POST['gender'],
      $_POST['email'],
      $addID, //address table id provided by mysql_insert_id
      $dob,
      $enrolled,
      $_POST['ethnicity'],
      $_POST['handicap'],
      $_POST['classification'], //provided as a hidden field
      $_POST['yoc_organization_id'], //provided as a hidden field
      $_POST['grade'],
      $_POST['golf_certified'],
      $_POST['game_club']
    );

    //organization_id needs to be added to kids $_POST['yoc_organization_id']
    $_mysql->insert('kids', $kidsFields, $kidsValues);
    $_mysql->insert('quiz', array('scga'), array($_POST['scga_ghin']));

    // $dateCert = (date('Y') + 1);
    $dateCert = CERTIFICATION_YEAR;

    $_mysql->insert(
      'certification',
      array('scga', 'year', 'certification_status'),
      array($_POST['scga_ghin'], $dateCert, 'Not certified')
    );

    $newKid = $_mysql->getSingle('SELECT kids.scga, kids.fname, kids.lname, kids.email, organization.name, organization.scga_club FROM kids INNER JOIN organization ON kids.organizationid = organization.organizationid WHERE kids.scga = "' . $_POST['scga_ghin'] . '"');
    if (!$newKid) {
      echo 'Error selecting query line 164';
    }

    sendNotCertifiedEmail($newKid);
  }
  else {
    echo 'Create login attempt error - process.php. Either account already exists or database query did not go through';
  }

  die(header('Location:' . $urlToMain));
  // echo $urlLocatorObj->getRedirector($urlToMain);
}
else {
  $_SESSION['error_type'] = 1;
  die(header('Location:' . $urlToMain));
}
?>