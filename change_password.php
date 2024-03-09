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
		<title>MJ Music Studio - Change Password</title>
	</head>
	<body>
		<div class="home-link">
			<a href="profile.php">&laquo My Profile</a>
		</div>
		<div class="main">
			<div class="wrapper">
				<form method="post">
					<h1>Password</h1>
					<div class="input-box">
						<input type="password" name="inpOldPass" placeholder="Old Password" required>
					</div>
					<div class="input-box">
						<input type="password" name="inpNewPass" placeholder="New Password" required>
					</div>
					<div class="input-box">
						<input type="password" name="inpConfirmNewPass" placeholder="Confirm New Password" required>
					</div>

					<button type="submit" name="btnSave" class="btn">Change Password</button>

					<div class="form-notif">
						<?php

							if(isset($_POST['btnSave'])){
								$oldPass = $_POST['inpOldPass'];
								$newPass = $_POST['inpNewPass'];
								$confirmPass = $_POST['inpConfirmNewPass'];
								$user_id = $_SESSION['user_id'];

								$connect = mysqli_connect("localhost","root","","mj_music_studio") or die("Error in connection");

								$sql = "select * from user where Password='$oldPass' AND UserID=$user_id";
								$result = mysqli_query($connect, $sql);

								if(mysqli_num_rows($result)==1){
									if($newPass==$confirmPass){
										$sql = "update user set Password='$newPass' where UserID=$user_id";
										mysqli_query($connect, $sql);
										echo "Changes have been made!";
									}
									else{
										echo "New passwords do not match!";
									}
								}
								else{
									echo "Old password is incorrect!";
								}
								
							}

						?>
					</div>

				</form>
			</div>
		</div>
	</body>
</html>