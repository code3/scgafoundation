<div class="pop_container">
    <h1><?= $_title ?> <?= $_kid['fname'] ?></h1>
    <form id="select_certification<?= $_extra ?>_form" action="<?= CLIENTROOT ?>/action/kids/save-certification" method="post">
        <input type="hidden" name="scga" value="<?= $_GET['scga'] ?>" />
        <input type="hidden" name="certificationid" value="<?= $_GET['certificationid'] ?>" />
        <input type="hidden" name="edit" value="<?= $_edit ?>" />
        <label for="certification_year">Year:</label>
        <input type="text" id="certification_year" name="year" class="val_req val_numeric" maxlength="4" value="<?=$_year ?>" />
        <br />
        <label for="certification_status">Certification Status</label>
        <? htmlSel(array('Certified by Program','Certified (Online)','Not certified','Online Quizzes Submitted'), 'id="certification_status" name="certification_status" multiple="multiple" class="val_req"', $_status, false, ''); ?>
        <br />
        <?
        if (!empty($_cert) && $_certDate != '') { 
            $dateStr = '&year=' . date('Y', strtotime($_certDate)) . '&month=' . date('m', strtotime($_certDate));
        }
        ?>
        <label for="date_certified">Date Certified</label>
        <input type="text" id="date_certified" name="date_certified" maxlength="10" value="<?= $_certDate ?>" />
        <a href="javascript:sel('<?= CLIENTROOT ?>/ajax/calendar/?fieldid=date_certified<?= $dateStr ?>')" class="customTitle" title="Calendar"><img src="<?= CLIENTROOT ?>/images/icons/24-columns.png" alt="Calendar" /></a>
        <br />
        <label>&nbsp;</label>
        <input type="submit" value="Submit" />
    </form>
</div>