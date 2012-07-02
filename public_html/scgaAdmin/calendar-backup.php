<div class="pop_container">
<h1>Calendar</h1>
	<label>Year:</label><? htmlSel($_selYears, 'name="year" id="year" class="php-cal-year" onchange="javascript:sel(\'/scgaAdmin/ajax/calendar/?fieldid='.$_GET['fieldid'].'&year=\'+$(\'year\').value+\'&month=\'+$(\'month\').value,true)"', $_year) ?><a onclick="sel2('<?=date('m')?>/<?=date('d')?>/<?=date('Y')?>', '<?=$_GET['fieldid']?>' );">Today</a>
	<br /><? $tomorrow = mktime(0, 0, 0, date("m"), date("d")+1, date("y")); ?>
	<label>Month:</label><? htmlSel($_selMonths, 'name="month" id="month" class="php-cal-month" onchange="javascript:sel(\'/scgaAdmin/ajax/calendar/?fieldid='.$_GET['fieldid'].'&month=\'+$(\'month\').value+\'&year=\'+$(\'year\').value,true)"', $_month, true) ?> <a onclick="sel2('<?=date('m',$tomorrow)?>/<?=date('d',$tomorrow)?>/<?=date('Y',$tomorrow)?>', '<?=$_GET['fieldid']?>' );">Tomorrow</a>
	<br />



<br /><br />

<div id="calendar_container">
<table id="calendar">
	<tr>
		<th class="month prevnext"><a href="javascript:sel('<?=CLIENTROOT?>/ajax/calendar/?fieldid=<?=$_GET['fieldid']?><?= getPrevNextMonth(0, $_month, $_year) ?>',true)">&laquo;</a></th>
		<th colspan="5" class="month"><?= $_monthNames[$_month-1].' '.$_year ?></th>
		<th class="month prevnext"><a href="javascript:sel('<?=CLIENTROOT?>/ajax/calendar/?fieldid=<?=$_GET['fieldid']?><?= getPrevNextMonth(1, $_month, $_year) ?>',true)">&raquo;</a></th>
	</tr>
	<tr>
	<? 
	foreach($_dayNames as $day){
		?><th><?= $day ?></th><?
	}
	?>
	</tr>
	<tr>
	<?
	$dayNum = 1;
	for($i=0; $i<42; $i++){
		
		if($i%7 == 0 && $i!=0){
			?></tr><tr><?
		}
		if($i >= $_firstDay && $i < $_interval){
			$date = $_year.'-'.$_month.'-';
			if($dayNum < 10){
				$date .= '0';
				$dayNum = '0'.$dayNum;
			}
			$date .= $dayNum;
			?><td class="day"><a onclick="sel2('<?= $_month?>/<?=$dayNum ?>/<?=$_year?>', '<?= $_GET['fieldid']; ?>' );"><?= $dayNum ?><br />		
			<div class="event">
				
			</div>
			</a>
			</td><?
			$dayNum++;
		}
		else{
			?><td class="noday"></td><?
		}
	}
	?>
	</tr>
</table>
</div>
</div>
