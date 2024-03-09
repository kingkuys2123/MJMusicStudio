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
		<title>MJ Music Studio - Delete Account</title>
	</head>
	<body>
		<div class="home-link">
			<a href="profile.php">&laquo My Profile</a>
		</div>
		<div class="main">
			<div class="wrapper">
				<form method="post">
					<h1>Confirm Delete Account</h1>

					<div class="btn-container">
						<br>
						<button type="submit" name="btnYes" class="btn-next">Yes</button>
						<button type="submit" name="btnNo" class="btn-next">No</button>
					</div>
					

					<div class="form-notif">
						<?php

							if(isset($_POST['btnYes'])){

								$connect = mysqli_connect("localhost", "root", "", "mj_music_studio") or die("Error in Connection!");

								$sql = "DELETE FROM user where UserID=".$_SESSION['user_id']."";
								mysqli_query($connect, $sql);

								$_SESSION = array();

								session_destroy();

								header("Location:home.php");
							}
							else if(isset($_POST['btnNo'])){
								header("Location:profile.php");
							}

						?>
					</div>

				</form>
			</div>
		</div>
	</body>
</html>