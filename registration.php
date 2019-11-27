
<?php include 'config/config.php';?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Registration form creation.</title>
	<link rel="stylesheet" href="style.css">


	<script type = "text/javascript">
		function preview(){
			var oFReader = new FileReader();
			oFReader.readAsDataURL(document.getElementById("imglink").files[0]);

			oFReader.onload = function (oFREvent){
				document.getElementById("upload").src = oFREvent.target.result;
			};
		};
	</script>


</head>
<body style = "background: #323232;">
	
	
		<section id = "main_regis">
		<div class="main_form">
			<form action="registration.php" method = "POST" enctype = "multipart/form-data"/>
			
				<center>
					<h1>Registration Form</h1>
					<img id = "upload" src="image/avatar.png" class = "avatar" alt="">
					<input type="file" name = "imglink" id = "imglink" accept =".jpg,.png,.jpeg" onchange = "preview();"/>
				</center>
				<table>
					<tr>
						<td><span>User-Name : </span></td>
						<td>
							<input type="text" id = "input_value" name = "name" placeholder = "Your Name." required/>
						</td>
					</tr>

					<tr>
						<td><span>User-Email : </span></td>
						<td>
							<input type="text" id = "input_value" name = "email" placeholder = "Your Email." required/>
						</td>
					</tr>

					<tr>
						<td><span>Gender : </span></td>
						<td>
							<input type="radio" name = "gender" id = "gender" value = "Male" checked required>  Male
							<input type="radio" name = "gender" id = "gender" value = "Female" required>  Female
						</td>
					</tr>

					<tr>
						<td><span>Qualification : </span></td>
						<td>
							<select name="qualification" id="qualification">
								<option>Select One</option>
								<option value="CSE">CSE</option>
								<option value="EEE">EEE</option>
								<option value="IT">IT</option>
								<option value="MARINE">MARINE</option>
								<option value="Bangla">Bangla</option>
							</select>
						</td>
					</tr>

					<tr>
						<td><span>Password : </span></td>
						<td>
							<input type="password" id = "input_value" name = "password" placeholder = "Your Password." required/>
						</td>
					</tr>

					<tr>
						<td><span>Confirm Password : </span></td>
						<td>
							<input type="password" id = "input_value" name = "cpassword" placeholder = "Your Confirm Password." required/>
						</td>
					</tr>

					<tr>
						<td></td>
						<td>
							<input type="submit" id = "sign-up" name = "regis_submit" value = "Sign-Up">
							<a href="index.php"><input type="button" id = "back-btn"  value = "Back Log-In"></a>
						</td>
					</tr>
				</table>
			</form>

			<?php


				if(isset($_POST['regis_submit'])){
					//echo '<script type = "text/javascript"> alert("Sign Up button clicked.")</script>';
					$name = $_POST['name'];
					$email = $_POST['email'];
					$gender = $_POST['gender'];
					$qualification = $_POST['qualification'];
					$password = $_POST['password'];
					$cpassword = $_POST['cpassword'];

					$img_name = $_FILES['imglink']['name'];
					$img_size = $_FILES['imglink']['size'];
					$img_tmp = $_FILES['imglink']['tmp_name'];

					$directory = 'uploads/';
					$target_file = $directory.$img_name;
					if($password == $cpassword){

						$encripted_password = md5($password);
						$query = "SELECT * FROM user WHERE name='$name'";
						$query_run = mysqli_query($db,$query);

						if(mysqli_num_rows($query_run)>0)
						{
							echo '<script type = "text/javascript"> alert("This name is already exist.")</script>';
						}
						else if(file_exists($target_file)){
							echo '<script type = "text/javascript"> alert("Image File is already exist.")</script>';
						}
						else if($img_size > 2097152){
							echo '<script type = "text/javascript"> alert("Image File size is lager than 2 MB.")</script>';
						}
						else {
							move_uploaded_file($img_tmp, $target_file);
							$query="INSERT INTO user(name,email,gender,qualification,password,imglink) 
							VALUES('$name','$email','$gender','$qualification','$encripted_password','$target_file')";
							$query_run=mysqli_query($db,$query);

							if($query_run){

								echo '<script type = "text/javascript"> alert("Username Registered... Go to login page..")</script>';
							}
							else{

								echo '<script type = "text/javascript"> alert("Error..")</script>';
							}
						}
					}
					else{
						echo '<script type = "text/javascript"> alert("The two password do not match..!")</script>';
					}
				}
			?>

		</div>
	</section>


</body>
</html>


