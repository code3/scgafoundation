<?php
//userActionHistory(array('p'), 'calender');

$_year = $_GET['year'];
$_month = $_GET['month'];

if(!is_numeric($_month) || $_month < 1 || $_month > 12){
	$_month = date('m');
} 
if(!is_numeric($_year) || $_year < 1900 || $_year > 2100){
	$_year = date('Y');
} 

$_firstDay =  date("w", mktime(0, 0, 0, $_month, 1, $_year));
$_lastDay = strftime("%d", mktime(0, 0, 0, $_month+1, 0, $_year));
$_interval = $_lastDay + $_firstDay;

$_dayNames = array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'); 
$_monthNames = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');

function getPrevNextMonth($next, $month, $year) {
	if (!$next) {
		if ($month == 1) {
			$prevYear = $year -1;
			return '&year=' . ($year - 1) . '&month=12';	
		}
		$newmonth = $month - 1;
		if($newmonth < 10){
			$newmonth = '0'.$newmonth;
		}
		return '&year=' . $year . '&month=' . $newmonth;
		$prevMonth = $newmonth;
	}
	else {
		if ($month == 12) {
			$nextYear = $year + 1;
			return '&year=' . ($year + 1) . '&month=01';	
		}
		$newmonth = $month + 1;
		if($newmonth < 10){
			$newmonth = '0'.$newmonth;
		}
		return '&year=' . $year . '&month=' . $newmonth;
		$nextMonth = $newmonth;
	}
}


//$dateLimits = $_mysql->getSingle("SELECT MAX(date) as maxDate, MIN(date) as minDate FROM event"); 
$maxYear = date('Y') + 2;
$minYear =  1980;

$_selYears = array();
for($i=$minYear; $i<=$maxYear; $i++){
	array_push($_selYears, $i);
}
$_selMonths = array('01'=>'Jan', '02'=>'Feb', '03'=>'Mar', '04'=>'Apr', '05'=>'May', '06'=>'Jun', '07'=>'Jul', '08'=>'Aug', '09'=>'Sep', '10'=>'Oct', '11'=>'Nov', '12'=>'Dec');


?>