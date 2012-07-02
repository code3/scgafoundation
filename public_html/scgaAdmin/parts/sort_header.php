<tr class="head">
	<?
	$i=1;
	$len = count($_sortFields);
	for($i=0; $i<$len; $i++){
		if($_sortFields[$i] == ''){
			?>
			<th class="<?= $_headerClasses[$i+1] ?>"><?= $_sortTitles[$i] ?></th>
			<?
			continue;
		}
		?><th class="<?= $_headerClasses[$i+1] ?>"><a href="javascript: $('sort_field').value='<?= $_sortFields[$i] ?>'; $('sort_desc').value='<? 
		if($_GET['sort_desc'] == '1'){ 
			echo '0'; 
		}
		else{
			echo '1';
		} 
		?>'; $('<?= $_sortForm ?>').submit();" class="customTitle pointer" title="Sort By <?= $_sortTitles[$i] ?>"><? 
		if ($_GET['sort_field'] == $_sortFields[$i]) {
			if ($_GET['sort_desc'] == '0') {
				?><img src="<?= CLIENTROOT ?>/images/icons/12-em-up.png" alt="Ascending Order" /><?
			}
			else{
				?><img src="<?= CLIENTROOT ?>/images/icons/12-em-down.png" alt="Descending Order" /><?
			}
		}
		echo $_sortTitles[$i]; 
		?></a></th><?
	}
	?></tr>