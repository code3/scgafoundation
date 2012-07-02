<HTML>
    <HEAD>
        <TITLE>Click & Pledge API- PHP Example</TITLE>
    </HEAD
    ><BODY>
    <form action="<?php echo($_SERVER['PHP_SELF']); ?>" method="post">
		<!-- Copy & paste the XML request below  -->
        <p><textarea id="txtParam" name="txtParam" rows="5" cols="60"></textarea>
           <br />
           <input type="submit" value="Process Request" />
        </p>
    </form>
 </BODY>
</HTML>
<?php
$strParam = "";
try {
	if(isset($_POST['txtParam']))
		$strParam = $_POST["txtParam"];
}
catch(Exception $exp)
{	
}
	if ($strParam != "")
	{
	 	  
	   // also u can load the xml param from a file
	   //$xmldata  = simplexml_load_file('d:\api\Requestorder.xml'); 
	   //$strParam = $xmldata->asXML();
	   
	   $connect = array('soap_version' => SOAP_1_1, 'trace' => 1, 'exceptions' => 0);
	   $client = new SoapClient('https://paas.cloud.clickandpledge.com/paymentservice.svc?wsdl', $connect);
	
	   $params = array('instruction'=>$strParam); 
	   $response = $client->Operation($params);
	
	   var_dump($response); 
	   
	   // Note: This is just to give you a brief idea about the posting of your data to the Click & Pledge API Services, you can however handle/redirect the data in another page and change the functionality as needed.
	  
	}
?>