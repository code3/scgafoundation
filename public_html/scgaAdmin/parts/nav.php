<div id="logo-nav">
	<div id="logo">
		<img src="<?= CLIENTROOT ?>/images/scgaf_logo2.jpg" alt="SCGA Foundation" title="SCGA Foundation"/>
	</div>
	
	<ul id="nav">
		<?
		$navs = array("Kids" => "/kids/main/",
					  "Life Skills" =>"/life_skills/main/",
						"Facilities" => "/facility/main/",
						"Organizations" => "/organization/main/",
						"YOC Tracking" => "/tracking/main/",
						"YOC Membership" => "/yoc_membership/main/",
						"YOC Classification" => "/status_by_birthdate/main/",
						"Quizzes" => "/quizzes/main/",
						"Admin" =>"/user/main/",
						"Online Purchases" =>"/purchase/main",
						"Logout" => "/action/logout/"
					);
		foreach ($navs as $text => $link) {
			?>
			<li><a href="<?= CLIENTROOT ?><?= $link ?>"<? if (strtolower($_page) == strtolower($text)) { echo ' class="current"'; } ?>><?= $text ?></a></li>
			<?
		}
		?>
	</ul>
	<div id="admin-panel">
		<h1>&nbsp;&nbsp;&nbsp;SCGA Foundation Admin Panel</h1>
	</div>
</div>
