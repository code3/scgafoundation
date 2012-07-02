<div class="pop_container">
    <h1>Send Email </h1>
    <?
    if($sendTempEmail == 1){
        ?>
        <form id="email_form"  target="email_form_target" enctype="multipart/form-data" onsubmit="sendTempPasswordEmail();" method="post">
        <input type="hidden" name="scga" value="<?= $scga ?>" />
        <?
    }
    else{
        ?>
        <form id="email_form"  target="email_form_target" enctype="multipart/form-data" onsubmit="sendEmail();" method="post">
        <?
        }
    ?>
     
    <a href="javascript:showAdvanceHtmlEditor('email_body');" class="customTitle" title="Advance HTML Editor"  >Editor</a> | 
    <a href="javascript:sendTestEmail();" class="customTitle" title="Send yourself a test email to make sure it looks good.">Send Test Email</a>
    <br />
    <input type="hidden" name="section" value="<?= $_GET['section'] ?>" />
    <label for="to_name">To:</label><?
    if(is_numeric($_GET['number'])){ //batch
        echo $_GET['number'].' Recipiants';
    }
    else{ // single email
        ?>
        <input type="text" name="to" id="to_name" value="<?= $_GET['name'] ?>" class="val_req emailField" />
        <br />
        <label for="to_email">To Email:</label>
        <input type="text" name="to_email" id="to_email" value="<?= $_GET['email'] ?>" class="val_req val_email emailField" />
        <?
    } 
    ?>
    <br />
    <label for="cc_email">CC Email:</label>
    <input type="text" name="cc_email" id="cc_email" value="<?= $_ccEmail ?>" class="val_email emailField" />
    <br />
    <label for="email_test">Test Email:</label>
    <input type="text" name="email_test" id="email_test" value="" class="val_email emailField" />
    <br />
    <label for="email_from_name">From:</label>
    <input type="text" name="email_from_name" id="email_from_name" value="<?= $_emailFromName ?>" class="val_req val_alpha_space emailField" />
    <br />
    <label for="email_from">From Email:</label>
    <input type="text" name="email_from" id="email_from" value="<?= $_emailFrom ?>"  class="val_req val_email emailField" />
    <br />
    <label for="email_subject">Subject:</label>
    <input type="text" name="email_subject" id="email_subject" maxlength="" value="<?= $_subject ?>" class="val_req emailSubjectField" />
    <br />
    <label for="email_body">Text Body:</label>
    <textarea id="email_body" name="email_body" class="val_req big"><?= $_emailBody ?></textarea>
    <br />
    <label>&nbsp;</label>
    <?
    /*<input type="checkbox" name="html_email" id="html_email" value="1" <? if($_htmlDefault){?> checked="checked"<? } ?>/><strong>Send Email As HTML</strong> (if not checked, will send email as plain text)*/ ?>
    <input type="submit"  value="Send Email" />
    
    </form>
    <iframe name="email_form_target" class="hide"></iframe>
</div>