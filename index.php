<?php
session_start();
include "dbConnection.php";


// Query to get all users
$query = $db->query("SELECT * FROM usersmodule4exo3 ORDER BY id ASC");
$users = $query->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Exo 3</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
	<div class="container">

		<div class="container-fluid">
			<div class="container">
				<!-- **********************TITLE ************************************* -->
				<h2 class="text-center mt-5	" id="title">EXO 3</h2>
				<hr>


				<!--  ****************** SUCCESS  OR ERROR MESSAGE (Login, Post, not Register) ******************* -->
				<div class="text-center">
					<!-- Success -->
					<?php
					if (isset($_SESSION['successMessage'])) {
						?>
						<div id="successMessage" class="alert alert-success fade in alert-dismissible show" style="margin-top:18px;"> 
							<strong>Yahoo!</strong><br><?php echo $_SESSION['successMessage'] ?>
						</div>
						<?php
						unset($_SESSION['successMessage']);
					}
					?>

					<!-- Error -->
					<?php
					if (isset($_SESSION['errorMessage'])) {
						?>
						<div class="alert alert-danger fade in alert-dismissible show" style="margin-top:18px;"> 
							<strong>Oups!</strong><br><?php echo $_SESSION['errorMessage'] ?>
						</div>
						<?php
   					 // Unset the error message from the session to prevent it from displaying on refresh
						unset($_SESSION['errorMessage']);
					}
					?>
				</div>

				<!-- ************* SIGN UP FORM ****************************** -->
				<div class="row">
					<div class="col-md-5">
						<form role="form" method="post" action="register.php">
							<fieldset>

								<p class="text-uppercase"><b>SIGN UP</b></p>


								<div class="form-group">
									<!-- Email -->
									<input 	 input-lg mb-2" type="text" name="emailRegister" id="email" placeholder="Email Address" value="<?php echo isset($_SESSION['emailRegister']) ? ($_SESSION['emailRegister']) : ''; ?>">
								</div>
								<div class="form-group">

									<!-- Password -->
									<input class="form-control input-lg mb-2" type="password" name="passwordRegister" id="passwordRegistration"  placeholder="Password" value="<?php echo isset($_SESSION['passwordRegister']) ? ($_SESSION['passwordRegister']) : ''; ?>" >
								</div>
								<div class="form-group">
									<!-- Confirm password -->

									<input class="form-control input-lg mb-2" type="password" name="passwordConfirmRegister" id="confirmPassword"  placeholder="Confirm Password" value="<?php echo isset($_SESSION['passwordConfirmRegister']) ? ($_SESSION['passwordConfirmRegister']) : ''; ?>">
								</div>
								<!-- Buttons -->
								<div>
									<!-- Register button -->
									<input type="submit" class="btn btn-lg btn-primary me-2 mt-3" value="Register" name="buttonRegister">
									<!-- Clear button -->
									<button type="button" class="btn btn-lg btn-primary mt-3" onclick="clearForm()" id="buttonClear">Clear</button>

									<script type="text/javascript">
										function clearForm() {
											document.getElementById('email').value = '';
											document.getElementById('passwordRegistration').value = '';
											document.getElementById('confirmPassword').value = '';
										}
									</script>


								</div>

							</fieldset>
						</form>
					</div>



					<!-- ******************** LOGIN *********************** -->
					<div class="col-md-5 offset-md-2">
						<form role="form"  method="post" action="login.php">
							<fieldset>
								<p class="text-uppercase"><b>Login using your account</b></p>

								<div class="form-group">
									<!-- Email -->
									<input class="form-control input-lg mb-2" type="text" name="emailLogin" id="usernameLogin"  placeholder="username" value="<?php echo isset($_SESSION['emailLogin']) ? ($_SESSION['emailLogin']) : ""; ?>">
								</div>
								<!-- Password -->
								<div class="form-group">
									<input class="form-control input-lg mb-2" type="password" name="passwordLogin" id="passwordLogin"  placeholder="Password">
								</div>
								<div>
									<input type="submit" class="btn btn-md btn-success mt-3" value="Sign In" name="login">
								</div>

							</fieldset>
						</form>
					</div>
				</div>


				<!-- ****************** ERROR AND SUCCES MESSAGES **************************-->
				<!-- SUCCESS MESSAGE -->
				<br>
				<?php
				if (isset($_SESSION['successMessage'])) {
					?>
					<div class="alert alert-success fade in alert-dismissible show" style="margin-top:18px;">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true" style="font-size:20px">×</span>
						</button>    
						<strong>Yahoo!</strong><br><?php echo $_SESSION['successMessage'] ?>
					</div>
					<?php
   					 // Unset the error message from the session to prevent it from displaying on refresh
					unset($_SESSION['successMessage']);
				}
				?>

				<!-- ERROR MESSAGE -->
				<?php
				if (isset($_SESSION['errorMessage'])) {
					?>
					<div class="alert alert-danger fade in alert-dismissible show">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true" style="font-size:20px">×</span>
						</button>
						<strong>Oups!</strong><br><?php echo $_SESSION['errorMessage'] ?>
					</div>	
					<?php
   				 // Unset the error message from the session to prevent it from displaying on refresh
					unset($_SESSION['errorMessage']);
				}
				?>





				<!-- Unsetting the emailLong $_SESSION variable -->
				<?php
				unset($_SESSION['emailLogin']);
				?>

				<!-- Closing tag for the container  -->
			</div>
			<script src="js/bootstrap.bundle.js"></script>
			<script src="js/bootstrap.js"></script>
			<script src="js/jquery.js"></script>
			<script src="js/custom.js"></script>
		</body>
		</html>