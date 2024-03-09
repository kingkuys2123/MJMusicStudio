<?php
    session_start();

    if (!isset($_SESSION['username'])) {
        header("Location:home.php");
    }
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="files/form.css?v=<?php echo time(); ?>">
		<link rel="icon" type="image/x-icon" href="files/assets/web-icon.png">
		<title>MJ Music Studio - Change Account Info</title>
	</head>
	<body>
		<div class="home-link">
			<a href="profile.php">&laquo My Profile</a>
		</div>
		<div class="main">
			<div class="wrapper">
				<form method="post">
					<h1>Account Info</h1>
					<div class="input-box">
						<input type="text" name="inpUsername" placeholder="New Username" required>
						<button style="margin-top: 5px;" type="submit" name="btnSaveUsername" class="btn">Save Username</button>
						<div class="form-notif">
							<?php

								if(isset($_POST['btnSaveUsername'])){
									$username = $_POST['inpUsername'];
									$userId = $_SESSION['user_id'];

									$connect = mysqli_connect("localhost","root","","mj_music_studio") or die("Error in connection");

									$sql = "select * from user where Username='$username'";
									$result = mysqli_query($connect, $sql);
									$row = mysqli_fetch_array($result);

									if(mysqli_num_rows($result)==0){
										$sql = "update user set Username='$username' where UserID=$userId";
										$_SESSION['username'] = $username;
										
										mysqli_query($connect, $sql);

										echo "Changes have been made!";

									}
									else if($row['Username']==$username){
										echo "You have already used this username!";
									}
									else{
										echo "Username is already taken.";
									}

									
									
								}

							?>
					</div>
					</div>
				</form>

				<br>

				<form method="post">
					<div class="input-box">
						<input type="text" name="inpEmail" placeholder="New Email" required>
						<button style="margin-top: 5px;" type="submit" name="btnSaveEmail" class="btn">Save Email</button>
						<div class="form-notif">
							<?php

								if(isset($_POST['btnSaveEmail'])){
									$email = $_POST['inpEmail'];
									$userId = $_SESSION['user_id'];

									$connect = mysqli_connect("localhost","root","","mj_music_studio") or die("Error in connection");

									$sql = "select * from user where Email='$email'";
									$result = mysqli_query($connect, $sql);
									$row = mysqli_fetch_array($result);

									if(mysqli_num_rows($result)==0){
										$sql = "update user set Email='$email' where UserID=$userId";
									
										mysqli_query($connect, $sql);

										echo "Changes have been made!";

									}
									else if($row['Email']==$email){
										echo "You have already used this email!";
									}
									else{
										echo "email already taken.";
									}
								}

							?>
						</div>
					</div>
				</form>
				<br>
				<br>
			</div>
		</div>
	</body>
</html>