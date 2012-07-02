<?php
require 'library/php/email.php';
require 'php/formatted_emails.php';
$_mysql->makeInputsSafe();


$addressFields = array(
  'address'
, 'address2'
, 'city'
, 'state'
, 'zip'
);

$number = sizeof($_POST['scga']);
$error = '0';
$j = 0;
for ($i = 0; $i < $number; $i++) {
  if ($_POST['scga'][$i] == '') {
    continue;
  }

  $_POST['dob'][$i] = changeDateFormat($_POST['dob'][$i]);
  $_POST['enrolled'][$i] = changeDateFormat($_POST['enrolled'][$i]);
  $_POST['golf_certified' . $i] = $_POST['golf_certified' . $i] == 1 ? 1 : 0;
  $_POST['game_club' . $i] = $_POST['game_club' . $i] == 1 ? 1 : 0;

  $organization = $_mysql->getSingle('SELECT organizationid, name FROM organization WHERE name = "' . $_POST['organization'][$i] . '"');
  if (!$organization) {
    $error = '1';
    $value = $_POST['organization'][$i];
    $row = $i + 1;
    continue;
  }

  $dupEntry = $_mysql->getSingle('SELECT login FROM login WHERE login = "' . $_POST['scga'][$i] . '"');
  if ($dupEntry) {
    if ($_POST['oldScga'] == '0') {
      $error = '2';
      $value = 'SCGA #' . $_POST['scga'][$i];
      $row = $i + 1;
      continue;
    }
    else {
      if ($_POST['oldScga'][$i] != $_POST['scga'][$i]) {
        $error = '2';
        $value = 'SCGA #' . $_POST['scga'][$i];
        $row = $i + 1;
        continue;
      }
    }
  }

  $j++;
}

if ($error == '0') {

  for ($i = 0; $i < $j; $i++) {
    //this will only matter when you edit a single kid. the $row is set to the scga # and passed to the javascript function
    $row = $_POST['scga'][$i];

    $organization = $_mysql->getSingle('SELECT organizationid FROM organization WHERE name = "' . $_POST['organization'][$i] . '"');
    $addressValues = array(
      $_POST['address'][$i]
    , $_POST['address2'][$i]
    , $_POST['city'][$i]
    , $_POST['state'][$i]
    , $_POST['zip'][$i]
    );

    if ($_POST['edit'] == '1') { // editing kids
      //update address
      $addID = $_mysql->getSingle('SELECT addressid FROM kids WHERE scga = "' . $_POST['oldScga'][$i] . '"');
      $_mysql->update('address', $addressFields, $addressValues, 'addressid = ' . $addID['addressid']);

      //update kids
      $kidsFields = array(
        'scga'
      , 'fname'
      , 'lname'
      , 'phone'
      , 'gender'
      , 'email'
      , 'email_from_guardian'
      , 'dob'
      , 'enrolled'
      , 'ethnicity'
      , 'handicap'
      , 'yoc_classification'
      , 'organizationid'
      , 'grade'
      , 'highschool'
      , 'golf_certified'
      , 'game_club'
      , 'status'
      );

      $kidsValues = array(
        $_POST['scga'][$i]
      , ucwords(strtolower($_POST['fname'][$i]))
      , ucwords(strtolower($_POST['lname'][$i]))
      , $_POST['phone'][$i]
      , $_POST['gender'][$i]
      , $_POST['email'][$i]
      , $_POST['email_from_guardian'][$i]
      , $_POST['dob'][$i]
      , $_POST['enrolled'][$i]
      , $_POST['ethnicity'][$i]
      , $_POST['handicap'][$i]
      , $_POST['classification'][$i]
      , $organization['organizationid']
      , $_POST['grade'][$i]
      , $_POST['highschool'][$i]
      , $_POST['golf_certified' . $i]
      , $_POST['game_club' . $i]
      , $_POST['status'][$i]
      );

      $_mysql->update('kids', $kidsFields, $kidsValues, 'scga = "' . $_POST['oldScga'][$i] . '"');

      // need to update password
      if ($_POST['scga'][$i] != $_POST['oldScga'][$i]) {
        $_mysql->update('login', array('login', 'password'), array($_POST['scga'][$i], md5($_POST['scga'][$i] . 'password')), 'login = "' . $_POST['oldScga'][$i] . '"');

        // send email
        if ($_POST['email'][$i] != '') {
          $newPasswordEmailBody = $_POST['fname'][$i] . ",\n\n";
          $newPasswordEmailBody .= "Your temporary password is: 'password'\n\n";
          $newPasswordEmailBody .= "Once you log in, you will be required to update your password.\n\n";
          $newPasswordEmailBody .= "The SCGA Foundation";
          email('SCGA Foundation', 'foundation@scga.org', $_POST['fname'][$i] . ' ' . $_POST['lname'][$i], $_POST['email'][$i], 'SCGA Foundation Password Reset for Youth on Course', nl2br($newPasswordEmailBody), $newPasswordEmailBody);
        }
      }

      // Update certification status
      if ($_POST['details_form'] != '1') {
        if ($_POST['date_certified'][$i] != '') {
          $_POST['date_certified'][$i] = changeDateFormat($_POST['date_certified'][$i]);
          $_mysql->update('certification', array('certification_status', 'date_certified'), array($_POST['certification_status'][$i], $_POST['date_certified'][$i]), 'scga = "' . $_POST['oldScga'][$i] . '" AND year = ' . $_POST['year'][$i]);
        }
        else {
          $_mysql->update('certification', array('certification_status'), array($_POST['certification_status'][$i]), 'scga = "' . $_POST['oldScga'][$i] . '" AND year = ' . $_POST['year'][$i]);
          // set date certified to null if blank
          $_mysql->query('UPDATE certification SET date_certified = NULL WHERE scga = "' . $_POST['oldScga'][$i] . '" AND year = ' . $_POST['year'][$i], 'Custom');
        }
      }

      // update life skills status
      if ($_POST['lifeSkills'][$i] != '') {
        $_mysql->update('quiz', array('lifeSkillsStatus'), array($_POST['lifeSkills'][$i]), 'scga = "' . $_POST['oldScga'][$i] . '"');
      }

      // update certification status
      $_maxYear = $_mysql->getSingle('SELECT MAX(year) AS maxYear FROM certification WHERE scga = "' . $_POST['oldScga'][$i] . '"');
      $quizGrades = $_mysql->getSingle('SELECT etiquettePercent, rulesPercent, handicapPercent, lifeSkillsStatus FROM quiz WHERE scga = "' . $_POST['oldScga'][$i] . '"');
      if ($quizGrades['etiquettePercent'] == '100'
          && $quizGrades['rulesPercent'] >= '80'
          && $quizGrades['lifeSkillsStatus'] == 'Passed'
          && $quizGrades['handicapPercent'] == '100'
      ) {
        // echo $_maxYear['maxYear'] . ' < ' . CERTIFICATION_YEAR; die;
        // if the kid does not have a certification associated with him/her
        // with the year the system is currently handing out, create one
        // ie: if the latest cert year a kid has is 2010 give her a 2012 certificate
        if ((int)$_maxYear['maxYear'] < (int)CERTIFICATION_YEAR) {
          $_mysql->insert(
            'certification',
            array('certification_status', 'date_certified', 'year', 'scga'),
            array('Certified (Online)', date('Y-m-d'), CERTIFICATION_YEAR, $_POST['scga'][$i])
          );
        }
        else {
          $_mysql->update(
            'certification',
            array('certification_status', 'date_certified'),
            array('Certified (Online)', date('Y-m-d')),
              'year = ' . $_maxYear['maxYear'] . ' AND scga = "' . $_POST['oldScga'][$i] . '" AND (certification_status != "Certified (Online)" OR date_certified IS NULL)'
          );
        }
      }

      //update places where the scga is
      if ($_POST['oldScga'][$i] != $_POST['scga'][$i]) {
        $_mysql->update('tracking', array('scga'), array($_POST['scga'][$i]), 'scga = "' . $_POST['oldScga'][$i] . '"');
        $_mysql->update('certification', array('scga'), array($_POST['scga'][$i]), 'scga = "' . $_POST['oldScga'][$i] . '"');

        //update the quiz section
        $_mysql->update('quiz', array('scga'), array($_POST['scga'][$i]), 'scga = "' . $_POST['oldScga'][$i] . '"');
      }

      // set dob to null if blank
      if ($_POST['dob'][$i] == '') {
        $_mysql->query('UPDATE kids SET dob = NULL WHERE scga = "' . $_POST['scga'][$i] . '"', 'Custom');
      }

       $_SESSION['updated'] = "Kids Updated";
    }
    else { //new kids
      $kidsFields = array(
        'scga'
      , 'loginid'
      , 'fname'
      , 'lname'
      , 'phone'
      , 'gender'
      , 'email'
      , 'addressid'
      , 'dob'
      , 'enrolled'
      , 'ethnicity'
      , 'handicap'
      , 'yoc_classification'
      , 'organizationid'
      , 'grade'
      , 'golf_certified'
      , 'game_club'
      , 'status'
      );

      // insert address
      $_mysql->insert('address', $addressFields, $addressValues);
      $addID = mysql_insert_id();

      // create login
      $loginID = $_login->createLogin($_POST['scga'][$i], 'password', 4); //4 is the login group id

      // insert kid
      $kidsValues = array(
        $_POST['scga'][$i]
      , $loginID
      , ucwords(strtolower($_POST['fname'][$i]))
      , ucwords(strtolower($_POST['lname'][$i]))
      , $_POST['phone'][$i]
      , $_POST['gender'][$i]
      , $_POST['email'][$i]
      , $addID
      , $_POST['dob'][$i]
      , $_POST['enrolled'][$i]
      , $_POST['ethnicity'][$i]
      , $_POST['handicap'][$i]
      , $_POST['classification'][$i]
      , $organization['organizationid']
      , $_POST['grade'][$i]
      , $_POST['golf_certified' . $i]
      , $_POST['game_club' . $i]
      , $_POST['status'][$i]
      );

      $_mysql->insert('kids', $kidsFields, $kidsValues);

      // set dob to null if blank
      if ($_POST['dob'][$i] == '') {
        $_mysql->query('UPDATE kids SET dob = NULL WHERE scga = "' . $_POST['scga'][$i] . '"', 'Custom');
      }


      // add certification
      if ($_POST['year'][$i] != '') {
        if ($_POST['date_certified'][$i] != '') {
          $_POST['date_certified'][$i] = changeDateFormat($_POST['date_certified'][$i]);
          $_mysql->insert('certification', array('scga', 'year', 'certification_status', 'date_certified'), array($_POST['scga'][$i], $_POST['year'][$i], $_POST['certification_status'][$i], $_POST['date_certified'][$i]));
        }
        else {
          $_mysql->insert('certification', array('scga', 'year', 'certification_status'), array($_POST['scga'][$i], $_POST['year'][$i], $_POST['certification_status'][$i]));
        }
      }

      //add entry in quiz table
      $_mysql->insert('quiz', array('scga'), array($_POST['scga'][$i]));

      //send the kid an email based on their certification status
      $newKid = $_mysql->getSingle('SELECT kids.scga, kids.fname, kids.lname, kids.email, organization.name, organization.scga_club FROM kids INNER JOIN organization ON kids.organizationid = organization.organizationid WHERE kids.scga = "' . $_POST['scga'][$i] . '"');
      if (!$newKid) {
        died(CLIENTROOT . '/error');
      }

      if ($_POST['certification_status'][$i] == 'Certified by Program') {
        sendCertifiedByProgramEmail($newKid);
      }
      else if ($_POST['certification_status'][$i] == 'Not certified') {
        sendNotCertifiedEmail($newKid);
      }

      $_SESSION['updated'] = 'Kids Added';
    }
  }
}

?>
<script type="text/javascript">
  <!--
  parent.addKidsErrorHandler(<?= $error ?>, '<?=$value?>', '<?=$row?>');
  //-->
</script>