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
		<link rel="stylesheet" type="text/css" href="files/profile.css?v=<?php echo time(); ?>">
		<link rel="icon" type="image/x-icon" href="files/assets/web-icon.png">
		<title>MJ Music Studio - My Profile</title>
	</head>
	<body>
		<div class="home-link">
			<a href="home.php">&laquo Home</a>
		</div>
		<div class="main">
			<div class="container">
			  	<img src="files/assets/profile-bg-1.png" alt="Paper" style="width:100%;" draggable="false">
			  	<div class="centered"><h1>My Profile</h1></div>
			  	<div class="top-left">
			  		<h2 class="spacing"><form method="post">Personal Info: <input type="submit" name="editPersonalBtn" value=" Edit " class="button"></form></h2> 
					<?php

						$user_id = $_SESSION['user_id'];

						$connect = mysqli_connect("localhost","root","","mj_music_studio") or die("Error in connection");

						$sql = "select * from customer where UserID='$user_id'";
						$res = mysqli_query($connect, $sql);

						$row = mysqli_fetch_array($res);

						echo "<div class=\"spacing\"><b>First Name:</b> ".$row['FirstName']."</div>";
						echo "<div class=\"spacing\"><b>Middle Name:</b> ".$row['MI'].".</div>";
						echo "<div class=\"spacing\"><b>Last Name:</b> ".$row['LastName']."</div>";
					?>
					
					<br>

					<h2 class="spacing"><form method="post">Account Info: <input type="submit" name="editAccountBtn" value=" Edit " class="button"></form></h2>
					<?php
						$sql = "select * from user where UserID='$user_id'";
						$res = mysqli_query($connect, $sql);

						$row = mysqli_fetch_array($res);

						echo "<div class=\"spacing\"><b>Username:</b> ".$row['Username']."</div>";
						echo "<div class=\"spacing\"><b>Email:</b> ".$row['Email']."</div>";
					?>
					
					<br>

					<h2 class="spacing">Passwords: </h2>
					<div class="spacing"><form method="post"><b>Password:</b> <input type="submit" name="changePassBtn" value=" Change Password " class="button"></form></div>


					<br>
					<br>
					<br>
					<br>
					<br>
					<br>
					<br>
					<br>
					<br>
					<br>
					<br>
					<br>
					<form method="post"><input type="submit" name="deleteAccBtn" value=" Delete Account " class="delete-button"></form>


					
			  	</div>
			</div>
		</div>
	</body>
</html>

<?php

	if(isset($_POST['editPersonalBtn'])){
		header("Location:edit_personal_info.php");
	}
	else if(isset($_POST['editAccountBtn'])){
		header("Location:edit_account_info.php");
	}
	else if(isset($_POST['changePassBtn'])){
		header("Location:change_password.php");
	}
	else if(isset($_POST['deleteAccBtn'])){
		header("Location:delete_account.php");
	}

?>