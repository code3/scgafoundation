<?php




	
	
	
 
//LEFT OFF HERE. I HAVE A LIST OF UNSUPERVISED WHICH NEED TO BE SET TO SUPERVISED. NEXT I NEED TO CREATE A BUTTON
//THAT LAUNCHES THE UPDATE TO SUPERVISED





//this function has to be overriden from current day and place the need to know date 1/1/12 so this date acts like its today
//and should tell us if they're 13 or not
function getAge( $p_strDate ) {
    list($Y,$m,$d)    = explode("-",$p_strDate);
    //return( date("md") < $m.$d ? date("Y")-$Y-1 : date("Y")-$Y );
	 $m2 = '01';//hard coded birthdate to compare with
	 $d2 = '01';
	 $Y2 = '2012';
	return( $m2.$d2 < $m.$d ? $Y2-$Y-1 : $Y2-$Y );
}




 

 
  


error_reporting(E_ALL);

require ('parts/update_alert.php');

require_once($_SERVER['DOCUMENT_ROOT'] . '/z_my_processes/includes/external-scripts.php');
//require('library/php/check_class_objects.php');

//echo $_SERVER['DOCUMENT_ROOT'];
 

$yocResults = $mysqlObj->get("select * from yoc_membership where scga_ghin_number = 'NA' or scga_ghin_number = ''");
$yocActiveResults = $mysqlObj->get("select * from yoc_membership where scga_ghin_number != 'NA'");
$getKidsRecords = $mysqlObj->get("select * from kids");
//print_r ($yocResult);
//$resultAmount = sizeof($yocResult);
 

$theVariable = ''; //make it true and it will update the status

 if (!empty($theVariable)){
	$dumpPath = $_SERVER['DOCUMENT_ROOT'] . '/z_my_processes/sql-dumps/supervised-status-by-age/';//13
backUpDBTable($host=MYSQLHOST,$user=MYSQLUSER,$pass=MYSQLPASS,$database=MYSQLDB, $tableName='kids', $dumpPath);
}
 

 
?>
<style type="text/css">
label{width:auto; margin-right:10px;}
input.text{ margin-right:10px; width:110px;}
input.scga-number{width:55px;}
input.email_tf{width:170px;}
div.spacer{height: 30px;}
.my-listing td{padding:8px;}
</style>
<h1>Yoc Classification Reset Panel (temporary) <!-- <span style="color:red; font-size:12px;">(in development please do not test)</span> --></h1>

<?php 

switch($_SESSION['error_type']){
	
	case 1:
	$error_message = 'SCGA/GHIN# cannot be empty';
	break;
	
	}
	
	echo $message_location = !empty($_SESSION['error_type']) ? '<div style="color:red; margin:10px;"><h2>'.$error_message.'</h2></div>' : '';
	
	unset($_SESSION['error_type']);

?>
    

   
  
    <div class="spacer"></div> 
    <table class="listing my-listing" style="width:650px;">
    <tbody>
    <tr class="head">
    <th>SCGA#</th>
    <th>DOB</th>
    <th>Age</th>
    <th>YOC Status</th> 
    <th>First Name</th>
    <th>E-mail</th>
   
     
    </tr>
 <?php   foreach ($getKidsRecords as $key){ 
 
 if(!empty($key['dob'])){

//if( ($key['yoc_classification'] != 'Supervised') && is_numeric($key['scga']) ){
	if( ($key['yoc_classification'] == 'Supervised') && is_numeric($key['scga']) ){

if( getAge($key['dob']) < 13 && getAge($key['dob']) > -1){
 
 ?>    

<tr class="bg">
<td><?php echo $key['scga'] ?></td>
<td><?php echo $key['dob'] ?></td>
<td><?php echo getAge($key['dob']) ?></td>
<td><?php echo $key['yoc_classification'] ?></td>
<td><?php echo $key['fname'] ?></td>
<td><a href="mailto:<?php echo $key['email'] ?>"><?php echo $key['email'] ?></a></td>
</tr>

<?php if (!empty($theVariable)){
	
	$fieldList= array('yoc_classification');
	$valueList = array('Supervised');
		  
	$tableStr = 'kids';
	
	 
    $whereStr = "scga = " . $key['scga'];  
    
	
		 
		 //$mysqlObj->update( $tableStr, $fieldList, $valueList, $whereStr );
	
}
	
	 ?>


<?php }}}} ?>
</tbody>
</table>
<br /><br />

 