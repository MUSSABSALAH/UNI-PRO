//scripts.js // created at 08-04-2019 By Mussab Salah 
//scripts.js // Last Update at 08-04-2019 By Mussab Salah 




// Send Code Function To send ajax Verification Code
function sendcode() 
{
	// Hide Error and success divs until response // 
	$(".error").html("").hide();
	$(".success").html("").hide();
	//phone No from the form 
	var number = $("#phone").val();
	// phone No is correct or not //
	if (number.length == 12 && number != null) 
	{
		var input = {
			"phone" : number,
			"action" : "send_code"
		};
		$.ajax({
			url : 'Verification.php',
			type : 'POST',
			data : input,
			success : function(response) {
				//$(".container").html(response);
				
				var obj = JSON.parse(response);
				console.log(obj.type);
				if(obj.type === "success")
				{
					// (success) Div after (reg_form) form
					$(".success").html("The verification Code has been Sent to your mobile");
					$(".success").show();
					$('#v_code').attr('readonly', false);
					/* $('#fname').attr('readonly', true);
					$('#lname').attr('readonly', true);
					$('#email').attr('readonly', true);
					$('#phone').attr('readonly', true); */
					
				}
				else
				{
					if(obj.type == "noerror")
					{
						$(".error").html("an error accrued when send Verification , number should be like 966*********!");
						$(".error").show();
					}
					else
					{
						// Error Div after (reg_form) form
						$(".error").html("an error accrued when send Verification , contact administrator!");
						$(".error").show();
					}
				}
				
			}
		});
	} 
	else 
	{
		// Error Div after (reg_form) form
		$(".error").html('Please enter a valid number like 966*********!')
		$(".error").show();
	}
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function FormSubmit() 
{
	var flag=1;
	
	$('#reg_form').submit(function(e) {
	  e.preventDefault();
	})
	///////////////////////////////////////////////////////////////////////
	//validate form field (only check empty //
	if($("#fname").val()=='')
	{
		flag=0;
	}
	else
	{
		if($("#lname").val()=='')
		{
			flag=0;
		}
		else
		{
			if($("#email").val()=='')
			{
				flag=0;
			}
			else
			{
				if($("#phone").val()=='')
				{
					flag=0;
				}
				else
				{
					if($("#v_code").val()=='')
					{
						flag=2;
					}
					else
					{
					}
				}
			}
		}
	}
	///////////////////////////////////////////////////////////////////////
	if(flag == 0)
	{
		$(".error").html("** All Fields are required!!");
		$(".error").show();
	}
	else
	{
		if(flag==2)
		{
			$(".error").html("Verify your Phone first!!");
			$(".error").show();
		}
		else
		{
			$.ajax({
			url: "Submitform.php",
			type: "post",
			dataType: 'JSON',
			data:
			{
				'fname':$("#fname").val(),
				'lname':$("#lname").val(),
				'email':$("#email").val(),
				'phone':$("#phone").val(),
				'v_code':$("#v_code").val()
			},
			success : function(response) {
				//var obj1 = JSON.parse(response);
				//console.log(response.type);
				if(response.type == "success")
				{
					$("#main_cont").html(response.message);
				}
				else
				{
					$(".error").html(response.message);
					$(".error").show();
				}
			},
			error: function(xhr, status, error) 
			{
				$(".error").html("unknown Error , Contact system Administrator");
				$(".error").show();
				console.log(xhr.responseText);
			}
			});
		}
	}
}
