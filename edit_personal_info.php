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
		<title>MJ Music Studio - Change Personal Info</title>
	</head>
	<body>
		<div class="home-link">
			<a href="profile.php">&laquo My Profile</a>
		</div>
		<div class="main">
			<div class="wrapper">
				<form method="post">
					<h1>Personal Info</h1>
					<div class="input-box">
						<input type="text" name="inpFirstName" placeholder="First Name" required>
					</div>
					<div class="input-box">
						<input type="text" name="inpMiddleInitial" placeholder="Middle Initial" required>
					</div>
					<div class="input-box">
						<input type="text" name="inpLastName" placeholder="Last Name" required>
					</div>

					<button type="submit" name="btnSave" class="btn">Save Changes</button>

					<div class="form-notif">
						<?php

							if(isset($_POST['btnSave'])){
								$fname = $_POST['inpFirstName'];
								$mi = $_POST['inpMiddleInitial'];
								$lname = $_POST['inpLastName'];
								$customerId = $_SESSION['customer_id'];

								$connect = mysqli_connect("localhost","root","","mj_music_studio") or die("Error in connection");

								$sql = "update customer set LastName='$lname', FirstName='$fname', MI='$mi' where customerID=$customerId";
								
								mysqli_query($connect, $sql);

								echo "Changes have been made!";
								
							}

						?>
					</div>

				</form>
			</div>
		</div>
	</body>
</html>