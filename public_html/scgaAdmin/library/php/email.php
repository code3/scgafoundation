<? 
/*02/12/08*/
/*
Copyright © 2008 Eckx Media Group, LLC. All rights reserved.
Eckx Media Group respects the intellectual property of others, and we ask others to do the same.
*/

//echo ' inside email func ggsss'; exit;
//email($from, $fromEmail, $to, $toEmail, $subject, $htmlBody, $textBody);

function email($Vd98a07f8, $V1469975c, $V01b6e203, $V942c996e, $Vb5e3374e, $V80e5e9ae, $Vc6dead34='', $Ve7351766='', $V808ab866='', $Vda2fd532 = array(), $Vda831c56 = array(), $V752a7b6d=''){
 $V95fe7446 = "\n"; $Vb162fca3 = '0-786207910-'.time().'=:75000'; $V614c43f0 = '1-786207910-'.time().'=:75000';
 $Vfd44f674 = count($Vda2fd532); 
 $V4340fd73 = 'From: ' . $Vd98a07f8 . ' <' . $V1469975c . '>' . $V95fe7446;
if($V752a7b6d!='') { $V4340fd73 .= 'Reply-To: ' . $V752a7b6d . $V95fe7446; } else { $V4340fd73 .= 'Reply-To: ' . $Vd98a07f8 . ' <' . $V1469975c . '>' . $V95fe7446;
} if($Ve7351766 != ''){ $V4340fd73 .= 'Cc: '.$Ve7351766.$V95fe7446; } if($V60147eb0 != ''){ $V4340fd73 .= 'Bcc: '.$V808ab866.$V95fe7446;
} $V4340fd73 .= 'MIME-Version: 1.0' . $V95fe7446; if($Vfd44f674 > 0){ $Vc1150763 = 'multipart/mixed';
} else{ $Vc1150763 = 'multipart/alternative'; } $V4340fd73 .= 'Content-Type: '.$Vc1150763.'; boundary="'.$Vb162fca3.'"'.$V95fe7446;
$V4340fd73 .= 'Content-Transfer-Encoding: 8bit'.$V95fe7446; $V4340fd73 .= 'Message-ID: <'.time().'.'.$V1469975c.'>'.$V95fe7446;
$V4340fd73 .= 'X-Mailer: PHP/'.phpversion(); $V78e73102 = '--'.$Vb162fca3.$V95fe7446; if($Vfd44f674 > 0){ 
 $V78e73102 .= 'Content-Type: multipart/alternative; boundary="'.$V614c43f0.'"'.$V95fe7446.$V95fe7446; 
 $V78e73102 .= '--'.$V614c43f0.$V95fe7446; } 
 if($Vc6dead34 != ''){ $V78e73102 .= 'Content-Type: text/plain; charset=iso-8859-1'.$V95fe7446;
$V78e73102 .= 'Content-Transfer-Encoding: 8bit'.$V95fe7446.$V95fe7446; $V78e73102 .= $Vc6dead34; $V78e73102 .= $V95fe7446; 
 } 
 if($V80e5e9ae != ''){ if($Vfd44f674 > 0){ $V78e73102 .= '--'.$V614c43f0.$V95fe7446; } else{
 $V78e73102 .= '--'.$Vb162fca3.$V95fe7446; } $V78e73102 .= 'Content-Type: text/html; charset=iso-8859-1'.$V95fe7446;
$V78e73102 .= 'Content-Transfer-Encoding: 8bit'.$V95fe7446.$V95fe7446; $V78e73102 .= $V80e5e9ae; $V78e73102 .= $V95fe7446; 
 } if($Vfd44f674 > 0){ $V78e73102 .= '--'.$V614c43f0.'--'.$V95fe7446; } 
 for($V865c0c0b=0; $V865c0c0b < $Vfd44f674; $V865c0c0b++){
 if (is_file($Vda2fd532[$V865c0c0b])){ 
 $V5b063e27 = substr($Vda2fd532[$V865c0c0b], (strrpos($Vda2fd532[$V865c0c0b], '/')+1));
$Vf809d736 = chunk_split(base64_encode(file_get_contents($Vda2fd532[$V865c0c0b]))); 
 $V78e73102 .= "--".$Vb162fca3.$V95fe7446;
$V78e73102 .= 'Content-Type: '.$Vda831c56[$V865c0c0b].'; name='.$V5b063e27.$V95fe7446; $V78e73102 .= 'Content-Transfer-Encoding: base64'.$V95fe7446;
$V78e73102 .= 'Content-Description: '.$V5b063e27.$V95fe7446; $V78e73102 .= 'Content-Disposition: attachment; filename='.$V5b063e27.$V95fe7446.$V95fe7446; 
 $V78e73102 .= $Vf809d736.$V95fe7446.$V95fe7446; } else{ die('email: '.$Vda2fd532[$V865c0c0b] .' dosnt exist');
} } $V78e73102 .= "--".$Vb162fca3.'--'; if($V01b6e203 != ''){ $V942c996e = $V01b6e203.'<'.$V942c996e.'>';
} mail($V942c996e, $Vb5e3374e, $V78e73102, $V4340fd73);}// or die('unable to email');} ?>