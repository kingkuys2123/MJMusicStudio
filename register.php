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
		<title>MJ Music Studio - Register</title>
	</head>
	<body>
		<div class="home-link">
			<a href="home.php">&laquo Home</a>
		</div>
		<div class="main">
			<div class="wrapper">
				<form method="post">
					<h1>Register</h1>
					<div class="input-box">
						<input type="text" name="inpFirstName" placeholder="First Name" required>
					</div>
					<div class="input-box">
						<input type="text" name="inpLastName" placeholder="Last Name" required>
					</div>
					<div class="input-box">
						<input type="text" name="inpMI" placeholder="Middle Initial" required>
					</div>
					<div class="input-box">
						<input type="text" name="inpUsername" placeholder="Username" required>
					</div>
					<div class="input-box">
						<input type="text" name="inpEmail" placeholder="Email" required>
					</div>
					<div class="input-box">
						<input type="password" name="inputPassword" placeholder="Password" required>
					</div>
					<div class="input-box">
						<input type="password" name="confirmPassword" placeholder="Confirm Password" required>
					</div>

					<input type="submit" name="btnRegister" class="btn" value="Register">

					<div class="form-notif">
						<?php

							if(isset($_POST['btnRegister'])){
								$fname = $_POST['inpFirstName'];
								$lname = $_POST['inpLastName'];
								$mi = $_POST['inpMI'];
								$uname = $_POST['inpUsername'];
								$email = $_POST['inpEmail'];
								$pwd = $_POST['inputPassword'];
								$confirmpwd = $_POST['confirmPassword'];

								$connect = mysqli_connect("localhost","root","","mj_music_studio") or die("Error in connection");

								$sql = "select * from user where Username='$uname'";
								$result = mysqli_query($connect, $sql);

								if(mysqli_num_rows($result)==0){

									$sql = "select * from user where Email='$email'";
									$result = mysqli_query($connect, $sql);

									if(mysqli_num_rows($result)==0){
										
										if($pwd==$confirmpwd){
											$sql="insert into user(Username, Email, Password) values('$uname', '$email', '$pwd')";
											mysqli_query($connect,$sql);

											$userID = mysqli_insert_id($connect);

											$sql = "insert into customer(CustomerID, LastName, FirstName, MI, UserID) values($userID, '$fname', '$lname', '$mi', $userID)";
											mysqli_query($connect,$sql);

											echo "Successfully registered.";
										}
										else{
											echo "Passwords do not match.";
										}
										
									}
									else{
										echo "Email already in use.";;
									}

								}else{
									echo "Username is already taken.";
								}

							}

						?>
					</div>

					<div class="login-register-link">
						<p>Already have an account? <a href="login.php">Login</a> </p>
					</div>

				</form>
			</div>
		</div>
	</body>
</html>