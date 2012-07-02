<?
if (!is_array($_POST['checked_members'])) {
	died(CLIENTROOT . '/yoc_membership/main');
}
$fieldValues = array(
    'hidden' => true, // varchar 100 / vc 50
  );

  $fields = array_keys($fieldValues);
  $values = array_values($fieldValues);
foreach ($_POST['checked_members'] as $yoc_id) {
	$_mysql->update('yoc_membership' , $fields,$values,'yoc_id = "' . $yoc_id . '"');
}

$_SESSION['updated'] = 'Member deleted';
died(CLIENTROOT . '/yoc_membership/main');
?>