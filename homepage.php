<?php
	session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Home-Page creation.</title>
	<link rel="stylesheet" href="style.css">
</head>
<body style = "background: #323232;">
	
	
	<section id = "main_regis">
		<h4>Wellcome <?php echo $_SESSION['email'];?></h4>
		<h2>Well-Come To New Page</h2>
		<h1>Home Page</h1>
		<?php echo'<img class = "avatar" src="'.$_SESSION['imglink'].'" alt="">'?>

		<div class="main_form">
			<form action="index.php" method = "POST">
				<table>
					
					<tr>
						<td></td>
						<td>
							<input type="submit" id = "log-out" name = "log-out" value = "Log-Out">
						</td>
					</tr>
				</table>
			</form>

			<?php
				if(isset($_POST['log-out'])){

					session_destroy();
					header('location: index.php');
				}
			?>
		</div>
	</section>


</body>
</html>

