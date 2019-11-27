<?php 
	session_start();
	include 'config/config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Log-In form creation.</title>
	<link rel="stylesheet" href="style.css">
</head>
<body style = "background: #323232;">
	
	
	<section id = "main_regis">
		<h1>Log In Form</h1>
		<img src="image/avatar.png" class = "avatar" id = "uploadPreview" alt="">

		<div class="main_form">
			<form action="index.php" method = "POST">
				<table>
					<tr>
						<td><span>User-Email : </span></td>
						<td>
							<input type="text" id = "input_value" name = "email" placeholder = "Your Name." required = "1">
						</td>
					</tr>

					<tr>
						<td><span>Password : </span></td>
						<td>
							<input type="password" id = "input_value" name = "password" placeholder = "Your Password." required = "1">
						</td>
					</tr>

					<tr>
						<td></td>
						<td>
							<input type="submit" id = "log-in" name = "log-in" value = "Log-In">
							<a href = "registration.php"><input type="button" id = "register-btn"
							 value = "Register"></a>
						</td>
					</tr>
				</table>
			</form>

			<?php

				if(isset($_POST['log-in'])){

					$email = $_POST['email'];
					$password = $_POST['password'];
					$encripted_password = md5($password);

					$query = "SELECT * FROM user WHERE email = '$email'
					 AND password = '$encripted_password'";

					 $query_run = mysqli_query($db, $query);

					 if(mysqli_num_rows($query_run)>0){
					 	
					 	$row = mysqli_fetch_assoc($query_run);
					 	$_SESSION['email'] = $row['email'];
					 	$_SESSION['imglink'] = $row['imglink'];
					 	header('location: homepage.php');
					 }
					 else{
					 	echo '<script type = "text/javascript"> alert("Invalid Account..")</script>';
					 }

				}
			?>
		</div>
	</section>


</body>
</html>