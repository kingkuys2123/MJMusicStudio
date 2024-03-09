<?php
    session_start();

    if (!isset($_SESSION['username'])) {
        header("Location:home.php");
    }

    $connect = mysqli_connect("localhost", "root","", "mj_music_studio") or die("Error in Connection!");

    $sql = "SELECT * FROM studio_room where StudioRoomNumber=".$_SESSION['book_room_number'];
    $row = mysqli_fetch_array(mysqli_query($connect, $sql));
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="files/book.css?v=<?php echo time(); ?>">
		<link rel="icon" type="image/x-icon" href="files/assets/web-icon.png">
		<title>MJ Music Studio - Book Info</title>
	</head>
    <script>
        function totalCost() {
            var duration = document.getElementById("bookDuration").value;
            var roomSize = '<?php echo $row['StudioRoomSize']; ?>';

            if(roomSize=="Small"){
            	var totalCost = duration * 50
            }
            else if(roomSize=="Medium"){
            	var totalCost = duration * 75
            }
            else if(roomSize=="Large"){
            	var totalCost = duration * 100
            }

            document.getElementById("bookCost").value = totalCost;
        }
    </script>
	<body>
		<div class="home-link">
			<a href="home.php">&laquo Home</a>
		</div>
		<div class="main">
			<div class="container">
			  	<img src="files/assets/book_bg.png" alt="Paper" style="width:100%;" draggable="false">
			  	<div class="centered"><h1>Book Info</h1></div>

			  	<form method="post">
				  	<div class="room-number">
				  		<h3>Room Number:</h3>
				  		<br>
				  		<?php
				  			echo $_SESSION['book_room_number'];
				  		?>
				  	</div>

				  	<div class="room-size">
				  		<h3>Room Size:</h3>
				  		<br>
				  		<?php
				  			echo $row['StudioRoomSize'];
				  		?>
				  	</div>

				  	<div class="start-date-time">
				  		<h3>Schedule:</h3>
				  		<br>
				  		<input type="datetime-local" id="bookStartDateTime" name="bookStartDateTime" required onkeydown="return false;">
				  	</div>

				  	<div class="duration">
				  		<h3>Duration:</h3>
				  		<br>
				  		<input type="number" id="bookDuration" name="bookDuration" min="1" style="width: 100px;" oninput="totalCost()" placeholder="0" required onkeydown="return false;">
				  	</div>

				  	<div class="total-cost">
				  		<h3>Cost:</h3>
				  		<br>
				  		₱ <input type="text" id="bookCost" name="bookCost" placeholder="0" style="width: 100px;" readonly>
				  	</div>

				  	<div class="bottom-right">
				  		<input class="confirm-button" type="submit" name="bookRoomBtn" value=" Confirm Book ">
				  	</div>

				  	<?php

				  		if(isset($_POST['bookRoomBtn'])){
				  			$currentDateTime = date("Y-m-d H:i");
				  			$startDateTime = str_replace('T', ' ', $_POST['bookStartDateTime']);

				  			$duration = $_POST['bookDuration'];
				  			$totalCost = $_POST['bookCost'];
				  			$room_number = $_SESSION['book_room_number'];
				  			$customer_id = $_SESSION['customer_id'];

				  			$endDateTime = date_create($startDateTime);
				  			date_add($endDateTime, date_interval_create_from_date_string("$duration hours"));
				  			$endDateTime = date_format($endDateTime, "Y-m-d H:i");

				  			if($startDateTime<$currentDateTime){
				  				echo "<div class=\"confirm-notif\">
								  		Schedule date is invalid, please try again!
								  	</div>";
				  			}
				  			else{
								$sql = "SELECT * FROM book WHERE (StartDateTime < '$endDateTime' AND EndDateTime > '$startDateTime') AND StudioRoomNumber=$room_number";
								$result = mysqli_query($connect, $sql);

								if(mysqli_num_rows($result)==0){
									$sql = "INSERT INTO book values('$startDateTime', '$endDateTime', $totalCost, $duration, $customer_id, $room_number)";
									$result = mysqli_query($connect, $sql);

									header("Location:my_bookings.php");
								}
								else{
									$count=0;

									echo "<div class=\"confirm-notif dropdown\">
								  		<span>Conflicts with other schedule(s), please try again!</span>
								  		<div class=\"dropdown-schedules\">";

								  	while($row=mysqli_fetch_array($result)){
								  		$tempDateTime = date_create($row['StartDateTime']);
						  				$confStartDateTime = date_format($tempDateTime, "Y-m-d h:i A");

						  				$tempDateTime = date_create($row['EndDateTime']);
						  				$confEndDateTime = date_format($tempDateTime, "Y-m-d h:i A");

						  				if($count==0){
						  					echo "<h4>Schedules:</h4><li>".$confStartDateTime." - ".$confEndDateTime."</li>";
						  				}
						  				else{
						  					echo "<br><li>".$confStartDateTime." - ".$confEndDateTime."</li>";
						  				}

						  				$count++;

								  	}

								  	echo "</div>
								  		</div>";
								}
				  			}
				  		}

				  	?>

			  	</form>

			  	<div class="bottom-left">
			  		<a class="out-button" href="book.php">Go Back</a>
			  	</div>
			</div>
		</div>
	</body>
</html>