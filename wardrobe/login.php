<!DOCTYPE html>
<html lang="en">

<head>
	<?php include "meta-css.php"; ?>
	<title>Login | Wardrobe </title>
</head>

<body style="background:#F7F7F7;">
	
	<div class="">
		<a class="hiddenanchor" id="toregister"></a>
		<a class="hiddenanchor" id="tologin"></a>

		<div id="wrapper">
			<div id="login" class="animate form">
				<section class="login_content">
					<form action="api/login.php" method="post">
						<h1>Login</h1>
						<div>
							<input type="text" class="form-control" name="username" placeholder="Username" required="" />
						</div>
						<div>
							<input type="password" class="form-control" name="password" placeholder="Password" required="" />
						</div>
						<div>
							<button class="btn btn-default submit">Log in</button>
							<a class="reset_pass" href="#">Lost your password?</a>
						</div>
						<div class="clearfix"></div>
						<div class="separator">

							<p class="change_link">New to site?
								<a href="#toregister" class="to_register"> Create Account </a>
							</p>
							<div class="clearfix"></div>
							<br />
							<div>
								<h1><i class="fa fa-umbrella" style="font-size: 26px;"></i> Wardrobe</h1>

								<p>©2015 All Rights Reserved</p>
							</div>
						</div>
					</form>
					<!-- form -->
				</section>
				<!-- content -->
			</div>
			<div id="register" class="animate form">
				<section class="login_content">
					<form action="api/register.php" method="post">
						<h1>Create Account</h1>
						<div>
							<input type="text" class="form-control" placeholder="Username" required="" />
						</div>
						<div>
							<input type="email" class="form-control" placeholder="Email" required="" />
						</div>
						<div>
							<input type="password" class="form-control" placeholder="Password" required="" />
						</div>
						<div>
							<a class="btn btn-default submit" href="index.php">Submit</a>
						</div>
						<div class="clearfix"></div>
						<div class="separator">

							<p class="change_link">Already a member ?
								<a href="#tologin" class="to_register"> Log in </a>
							</p>
							<div class="clearfix"></div>
							<br />
							<div>
								<h1><i class="fa fa-umbrella" style="font-size: 26px;"></i> Wardrobe</h1>

								<p>©2015 All Rights Reserved</p>
							</div>
						</div>
					</form>
					<!-- form -->
				</section>
				<!-- content -->
			</div>
		</div>
	</div>

</body>

</html>