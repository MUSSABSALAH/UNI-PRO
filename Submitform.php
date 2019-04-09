<?php
session_start();

class Submitform
{
    function __construct() 
	{
        $this->Validation();
		//to validate before save db //
    }
    public function Validation()
    {
		//Post From Element //
		//strip_tags to clean POST from any HTML & PHP tags 
		$First_name=strip_tags($_POST['fname']);
		$Last_name=strip_tags($_POST['lname']);
		$email=strip_tags($_POST['email']);
		$Phone=strip_tags($_POST['phone']);
		$verification_code=strip_tags($_POST['v_code']);
		//Validate First Name //
		if($this->string_validation($First_name,2,22))
		{
			//Validate Last Name //
			if($this->string_validation($Last_name,2,22))
			{
				//Validate Email address //
				if($this->email_validation($email))
				{
					if($this->phone_validation($Phone,'sa'))
					{
						//Validate Verification code //
						if ($verification_code == $_SESSION['verification_code']) 
						{
							//here you call RegistrationData($fname,$lname,$Email,$Phone); to save the data to the db --- if saved return success message //
							//unset (delete the saved code in session)//
							unset($_SESSION['verification_code']);
							$type='success';
							$message='You Have register Successfully';
							
						} 
						else 
						{
							$message='an error accrued ! <br/> Error in verification code!';
							$type='error';
						} 
						
					}
					else
					{
						$message='an error accrued ! <br/> Error in Phone!';
						$type='error';
					}
					
				}
				else
				{
					$message='an error accrued ! <br/> Error in Email!';
					$type='error';
				}
			}
			else
			{
				$message='an error accrued ! <br/> Error in last name!';
				$type='error';
			}
			
		}
		else
		{
			$message='an error accrued ! <br/> Error in first name!';
			$type='error';
		}
		echo json_encode(array("type"=>$type, "message"=>$message));
	}
	public function string_validation($str,$min_length,$max_length)
	{
		if (!preg_match("/^[a-zA-Z ]*$/",$str)) 
		{
			return false;
		}
		else
		{
			if((strlen($str) > $min_length) && (strlen($str) < $max_length))
			{
				return true;
			}
			else
			{
				return false;
			}
			
		}
	}
	public function email_validation($eml)
	{
		//check text length //
		if((strlen($eml) > 7) && (strlen($eml) < 20))
		{
			//remove '@' to validate host and domain and to make sure it's email //
			if (strpos($eml, '@') !== false) 
			{
				$emailacc=explode("@",$eml);
				//to make sure there is dot in email address in the domain after explode domain & host//
				if (strpos($emailacc[1], '.') !== false) 
				{
					//after dot validation and before dot
					$removeondot=explode(".",$emailacc[1]);
					//domain should be only numbers & letters//
					if (!preg_match("/^[a-zA-Z ]*$/",$removeondot[0]))
					{
						return false;
					}
					else
					{
						// host can be number and English letters and (.,-)//
						if (!preg_match('/^[A-Za-z1-9\.\d\_\-]+$/i',$emailacc[0]))
						{
							return false;
						}
						else
						{
							return true;
						} 
					}
				}
				else
				{
					return false;
				}
			}
			else
			{
				return false;
			}
			
		}
		else
		{
			return false;
		}
	}
	public function phone_validation($pho,$country)
	{
		$lenght=12;
		//country define digit numbers -- you can add countries in the below if stm...
		if($country=='sa')
		{
			$lenght=12;
		}
		if(is_numeric($pho))
		{
			if(strlen($pho) == $lenght)
			{
				//check the country key -- Ex. KSA start 966 
				if(mb_substr($pho, 0, 3)=='966')
				{
					//correct saudi Key
					return true;
				}
				else
				{
					return false;
				} 
				//return true;
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}
	}
	public function RegistrationData($fname,$lname,$Email,$Phone)
	{
		// here you can save the posted data
	}		
}
$Submitform = new Submitform();
?>