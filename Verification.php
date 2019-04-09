<?php
session_start();
//error_reporting(E_ALL & ~ E_NOTICE);
require('Unifonic/Autoload.php');
use \Unifonic\API\Client;
class Verification
{
    function __construct() 
	{
        $this->processMobileVerification();
		//function to send Verification message//
    }
    function processMobileVerification()
    {
        $mobile_number = strip_tags($_POST['phone']);
        //rand four digit (it will send to mon=bile)
		$rand_code = rand(1000, 9999);
		// saved in session to compare it after submit//
        $_SESSION['verification_code'] = $rand_code;
		// send sms//
		$sms_response = $this->sendSms($mobile_number, $rand_code);
		// pass json to ajax func//
		if($sms_response == 0)
		{
			echo json_encode(array("type"=>"error"));
		}
		else
		{
			echo json_encode(array("type"=>"success"));
		}			
    }
	function sendSms($number,$code)
	{
		// from Unifonic API//
		$client = new Client();
		try {
				$response = $client->Messages->Send($number,$code,'test sender'); // send regular massage
				// return 1 if send the message or 0 if Exception or any other error 
				if($response->Status == 'Queued')
				{
					return 1 ;
				}
				else
				{
					return 0;
				}
			}
			catch (Exception $e) 
			{
				//echo $e->getCode();
				//error number from [01-41] in Unifonic documentation -- used to find the error //
				return 0;
			}
		}
	
}
$Verification = new Verification();
?>
