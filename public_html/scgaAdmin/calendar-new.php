<div class="pop_container">
    <?
	// 1:49 PM 5/6/2010
	?>
	<h1>Calendar</h1>
	
	<div class="emg-form calendar">
		<fieldset class="no-legend columns">
			<label for="year">Year:</label>
			<? htmlSel($_selYears, 'name="year" id="year" class="php-cal-year" onchange="javascript:sel(\'/scgaAdmin/ajax/calendar/?fieldid='.$_GET['fieldid'].'&year=\'+$(\'year\').value+\'&month=\'+$(\'month\').value,true)"', $_year) ?>
			<br />
			<label for="month">Month:</label>
			<? htmlSel($_selMonths, 'name="month" id="month" class="php-cal-month" onchange="javascript:sel(\'/scgaAdmin/ajax/calendar/?fieldid='.$_GET['fieldid'].'&month=\'+$(\'month\').value+\'&year=\'+$(\'year\').value,true)"', $_month, true) ?>
		</fieldset>
	</div>
	
	<table id="calendar">
		<thead>
			<tr class="month">
				<th class="previous"><a href="javascript:sel('<?=CLIENTROOT?>/ajax/calendar/?fieldid=<?=$_GET['fieldid']?><?= getPrevNextMonth(0, $_month, $_year) ?>',true)">&laquo; <span class="tip">Previous Month</span></a></th>
				<th colspan="5"><strong><?= $_monthNames[$_month-1].' '.$_year ?></strong></th>
				<th class="next"><a href="javascript:sel('<?=CLIENTROOT?>/ajax/calendar/?fieldid=<?=$_GET['fieldid']?><?= getPrevNextMonth(1, $_month, $_year) ?>',true)">&raquo; <span class="tip">Next Month</span></a></th>
			</tr>
			<tr class="weekdays">
				<?
				foreach ($_dayNames as $day) {
					?>
					<th scope="col"><?= substr($day, 0, 3) ?></th>
					<?
				}
				?>
			</tr>
		</thead>
		<tbody>
			<tr class="days">
				<?
				$dayNum = 1;
				$today = date('d');
				for ($i = 0; $i < 42; $i++) {
					
					if ($i % 7 == 0 && $i != 0) {
						?>
						</tr>
						<tr class="days">
						<?
					}
					if ($i >= $_firstDay && $i < $_interval) {
						$date = $_year . '-' . $_month . '-';
						if ($dayNum < 10) {
							$date .= '0';
							$dayNum = '0' . $dayNum;
						}
						$date .= $dayNum;
						?>
						<td<?= $dayNum == $today ? ' class="today"' : '' ?>>
							<a onclick="sel2('<?= $_month?>/<?=$dayNum ?>/<?=$_year?>', '<?= $_GET['fieldid']; ?>' );">
								<span class="day"><?= $dayNum ?></span>
								<?
								/*
								<span class="event"></span>
								*/
								?>
							</a>
						</td>
						<?
						$dayNum++;
					}
					else {
						?>
						<td class="no-day"></td>
						<?
					}
				}
				?>
			</tr>
		</tbody>
	</table>
	
	
	<p class="reset-calendar">
    	<a href="javascript:sel('<?=CLIENTROOT?>/ajax/calendar/?fieldid=<?=$_GET['fieldid']?>&amp;year=<?= date('Y') ?>&amp;month=<?= date('m') ?>',true)">Reset Calendar</a>
	</p>
	
	<p>Select a date relative to today:</p>
	<ol class="nav-calendar">
		<li><a href="#" onclick="sel2('<?= $_last2Week ?>', '<?= $_GET['fieldid'] ?>' ); return false;">-2 Week</a></li>
		<li><a href="#" onclick="sel2('<?= $_lastWeek ?>', '<?= $_GET['fieldid'] ?>' );  return false;">-1 Week</a></li>
		<li><a href="#" onclick="sel2('<?= $_yesterday ?>', '<?= $_GET['fieldid'] ?>' );  return false;">Yesterday</a></li>
		<li><a href="#" onclick="sel2('<?= $_today ?>', '<?= $_GET['fieldid'] ?>' );  return false;">Today</a></li>
		<li><a href="#" onclick="sel2('<?= $_tomorrow ?>', '<?= $_GET['fieldid'] ?>' );  return false;">Tomorrow</a></li>
		<li><a href="#" onclick="sel2('<?= $_nextWeek ?>', '<?= $_GET['fieldid'] ?>' );  return false;">+1 Week</a></li>
		<li><a href="#" onclick="sel2('<?= $_next2Week ?>', '<?= $_GET['fieldid'] ?>' );  return false;">+2 Weeks</a></li>
		<li class="last"><a href="#" onclick="sel2('<?= $_nextMonth ?>', '<?= $_GET['fieldid'] ?>' );  return false;">+30 Days</a></li>
	</ol>
</div>