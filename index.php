<html>
<head>
	<link href="assets/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/jquery.min.js"></script>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">
	<script src="assets/js/scripts.js"></script>
	<title>Registration page </title>
</head>
<body>
	<div class="container">
		<br>  
		<b class="text-left">Registration page </b>
		<hr>
		<div class="card bg-light">
			<div class="card-body mx-auto" style="max-width: 800px;" id="main_cont">
				<form action="" method="POST" id="reg_form">
					<div style="display:none"class="alert alert-danger error" role="alert">
					</div>
					<div style="display:none"class="alert alert-success success" role="alert">
					</div>
					<div class="form-group input-group">
						<div class="input-group-prepend">
							<span class="input-group-text"> <i class="fa fa-user"></i> </span>
						 </div>
						<input name="fname" id="fname" class="form-control" placeholder="First name" type="text" value="" />
					</div> <!-- form-group// -->
					<div class="form-group input-group">
						<div class="input-group-prepend">
							<span class="input-group-text"> <i class="fa fa-user"></i> </span>
						 </div>
						<input name="lname" id="lname" class="form-control" placeholder="Last name" type="text" value="" />
					</div> <!-- form-group// -->
					<div class="form-group input-group">
						<div class="input-group-prepend">
							<span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
						 </div>
						<input name="email" id="email" class="form-control" placeholder="Email address" type="text" value="" />
					</div> <!-- form-group// -->
					<div class="form-group input-group">
						<div class="input-group-prepend">
							<span class="input-group-text"> <i class="fa fa-phone"></i> </span>
						</div>
						<input name="phone" id="phone" class="form-control" placeholder="Phone number" type="text" value="" />
						<a onclick="sendcode()" class="btn btn-primary" style="margin-left:10px;color:#fff;">send SMS to verify</a>
					</div> <!-- form-group// -->
					<div class="form-group input-group">
						<div class="input-group-prepend">
							<span class="input-group-text"> <i class="fa fa-lock"></i> </span>
						</div>
						<input class="form-control" placeholder="Verification Code" id="v_code" name="v_code" type="text" readonly="true" value="" />
					</div> <!-- form-group// -->                                      
					<div class="form-group">
						<input type="submit" class="btn btn-primary btn-block" value="Register!!" onclick="FormSubmit()"/>
					</div> <!-- form-group// -->      
				</form>
			</div>
		</div> <!-- card.// -->
	</div> 
<!--container end.//-->
</body>
</html>