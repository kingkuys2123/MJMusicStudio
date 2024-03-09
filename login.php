<?php
    session_start();

    if (isset($_SESSION['username'])) {
        header("Location:user_home.php");
    }
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="files/form.css?v=<?php echo time(); ?>">
		<link rel="icon" type="image/x-icon" href="files/assets/web-icon.png">
		<title>MJ Music Studio - Login</title>
	</head>
	<body>
		<div class="home-link">
			<a href="home.php">&laquo Home</a>
		</div>
		<div class="main">
			<div class="wrapper">
				<form method="post">
					<h1>Login</h1>
					<div class="input-box">
						<input type="text" name="inpUsername" placeholder="Username" required>
					</div>
					<div class="input-box">
						<input type="password" name="inpPassword" placeholder="Password" required>
					</div>

					<button type="submit" name="btnLogin" class="btn">Login</button>

					<div class="form-notif">
						<?php

							if(isset($_POST['btnLogin'])){
								$uname = $_POST['inpUsername'];
								$pwd = $_POST['inpPassword'];

								$connect = mysqli_connect("localhost","root","","mj_music_studio") or die("Error in connection");

								$sql = "select * from user where Username='$uname'";
								$result = mysqli_query($connect, $sql);

								if(mysqli_num_rows($result)==0){
									echo "User does not exist!";
								}
								else{
									$row = mysqli_fetch_array($result);

									if($row['Password']==$pwd){
										$user_id = $row['UserID'];
										$_SESSION['username'] = $row['Username'];
										$_SESSION['user_id'] = $user_id;

										$sql = "select * from customer where UserID='$user_id'";
										$result = mysqli_query($connect, $sql);
										$row = mysqli_fetch_array($result);

										$_SESSION['customer_id'] = $row['CustomerID'];

										header("Location:user_home.php");
									}
									else{
										echo "Incorrect password!";
									}
								}
								
							}

						?>
					</div>

					<div class="login-register-link">
						<p>Don't have an account? <a href="register.php">Register</a> </p>
					</div>

				</form>
			</div>
		</div>
	</body>
</html>