<?
if(!$_isAdmin){
	die('No permission to view this page');
}

/*
if($_username != 'rebekah'){
	?>
	<h1>Upload CSV File: (import kids)</h1>
	<form action="<?= CLIENTROOT ?>/action/kids/upload-csv" method="post" ENCTYPE="multipart/form-data">
		<label for="file1">File:</label>
		<input name="file1" id="file1" type="file" />
		<br />
		<label>&nbsp;</label>
		<input type="submit" name="submit" id="submit" value="Upload File" class="submit-button"/>
	</form>
    <?
}
else{
	*/
    ?>
    <h1>Upload CSV File: (import kids)</h1>
    <p><strong>For new kids:</strong>
        <ul class="upload-information">
            <li>Default YoC Classification to "Supervised"</li>
            <li>Sets "Enrollment Date" to todays date (<?= date('m/d/Y') ?>)</li>
            <li>Sets "Date Certified" to todays date (<?= date('m/d/Y') ?>)</li>
            <li>Sends out "Certified By Program" / "Not Certified" emails</li>
        </ul>
    </p>
    <p><strong>For kids already in database:</strong>
        <ul class="upload-information">
            <li>Only updates fields in csv file</li>
            <li>Does not change YoC Classification</li>
            <li>Does not change Enrollment date</li>
            <li>Does not change Certification</li>
        </ul>
    </p>
    <p><strong>Please upload a CSV in the following format:</strong></p>
    
    <table class="listing">
        <thead>
            <tr>
                <th>Column</th>
                <th>Name</th>
            </tr>
        <tbody>
        <?
        for($i = 0; $i < $_numCols; $i++){
            ?>
            <tr<?= $i % 2 == 1 ? ' class="bg"' : '' ?>>
                <td><?= $_letters[$i] ?>:</td><td><?= $_colummNames[$i] ?></td>
            </tr>
           <?
        }
        ?>
        </tbody>
    </table>
    
    <br />
    
    <form action="<?= CLIENTROOT ?>/action/kids/new_upload_csv" method="post" enctype="multipart/form-data">
        <label for="cert_year">Certification Year:</label>
        <input type="text" maxlength="4" id="cert_year" name="cert_year" class="val_req" value="2012"/>
        <br />
        <label for="certification_status">Certification Status:</label>
        <? htmlSel($_certStatuses, 'id="certification_status" name="certification_status" multiple="multiple"', 'Not certified', false, ''); ?>
        <br />
        <label for="filedata">File:</label>
        <input name="filedata" id="filedata" type="file" />
        <br />
        <label>&nbsp;</label>
        <input type="submit" name="submit" id="submit" value="Upload File" class="submit-button"/>
    </form>
    <?
	/*
}
*/
?>