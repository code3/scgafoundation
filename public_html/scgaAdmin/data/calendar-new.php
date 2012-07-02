<?php
// 5:20 PM 4/7/2010

$_year = $_GET['year'];
$_month = $_GET['month'];

if(!is_numeric($_month) || $_month < 1 || $_month > 12){ // if no month specified, default to last selected month
	$_month = is_numeric($_SESSION[CLIENTROOT]['calendar-month']) &&
				$_SESSION[CLIENTROOT]['calendar-month'] >= 1 &&
				$_SESSION[CLIENTROOT]['calendar-month'] <= 12 ? $_SESSION[CLIENTROOT]['calendar-month'] : date('m');
}

if(!is_numeric($_year) || $_year < 1900 || $_year > 2100){ // if no year specified, default to last selected year
	$_year = is_numeric($_SESSION[CLIENTROOT]['calendar-year']) &&
				$_SESSION[CLIENTROOT]['calendar-year'] >= 1900 &&
				$_SESSION[CLIENTROOT]['calendar-year'] <= 2100 ? $_SESSION[CLIENTROOT]['calendar-year'] : date('Y');
}

$_timeSelectStr = !empty($_GET['time']) ? ' + \' \' + $(\'#hour\')[0].value + \':\' + $(\'#minute\')[0].value + \' \' + $(\'#ampm\')[0].value' : '';

// update the last selected month/year
$_SESSION[CLIENTROOT]['calendar-month'] = $_month;
$_SESSION[CLIENTROOT]['calendar-year'] = $_year;

$_firstDay =  date("w", mktime(0, 0, 0, $_month, 1, $_year));
$_lastDay = strftime("%d", mktime(0, 0, 0, $_month + 1, 0, $_year));
$_interval = $_lastDay + $_firstDay;

$_dayNames = array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'); 
$_monthNames = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');

function getPrevNextMonth($next, $month, $year) {
	if (!$next) {
		if ($month == 1) {
			$prevYear = $year - 1;
			return '&year='.($year - 1).'&month=12';	
		}
		$newmonth = $month - 1;
		if($newmonth < 10){
			$newmonth = '0'.$newmonth;
		}
		return '&year='.$year.'&month='.$newmonth;
		$prevMonth = $newmonth;
	}
	else {
		if ($month == 12) {
			$nextYear = $year + 1;
			return '&year='.($year + 1).'&month=01';	
		}
		$newmonth = $month + 1;
		if($newmonth < 10){
			$newmonth = '0'.$newmonth;
		}
		return '&year='.$year.'&month='.$newmonth;
		$nextMonth = $newmonth;
	}
}


$curYr = date('Y');
$maxYear = $curYr + 10;
$minYear = 1900;

$_selYears = array();
for($i = $minYear; $i <= $maxYear; $i++){
	array_push($_selYears, $i);
}
$_selMonths = array('01' => 'Jan', '02' => 'Feb', '03' => 'Mar', '04' => 'Apr', '05' => 'May', '06' => 'Jun', '07' => 'Jul', '08' => 'Aug', '09' => 'Sep', '10' => 'Oct', '11' => 'Nov', '12' => 'Dec');
$_today = date('m/d/Y');
$_tomorrow = date('m/d/Y', strtotime('+1 day'));
$_yesterday = date('m/d/Y', strtotime('-1 day'));
$_lastWeek = date('m/d/Y', strtotime('-1 week'));
$_last2Week = date('m/d/Y', strtotime('-2 week'));
$_nextWeek = date('m/d/Y', strtotime('+1 week'));
$_next2Week = date('m/d/Y', strtotime('+2 week'));
$_nextMonth = date('m/d/Y', strtotime('+30 day'));

$_hours = array('01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12');
$_minutes = array('00', '05', '10', '15', '20', '25', '30', '35', '40', '45', '50', '55');
$_allMinutes = array('00','01', '02','03','04','05','06','07','08','09', '10','11','12','13','14', '15','16','17','18','19', '20','21','22','23','24', '25','26','27','28','29', '30','31','32','33','34', '35','36','37','38','39', '40','41','42','43','44', '45','46','47','48','49', '50','51','52','53','54', '55','56','57','58','59','60');
$_ampm = array('am', 'pm');

?>