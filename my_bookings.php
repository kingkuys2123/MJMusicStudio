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
		<link rel="stylesheet" type="text/css" href="files/book.css?v=<?php echo time(); ?>">
		<link rel="icon" type="image/x-icon" href="files/assets/web-icon.png">
		<title>MJ Music Studio - Booked Rooms</title>
	</head>
	<body>
		<div class="home-link">
			<a href="home.php">&laquo Home</a>
		</div>
		<div class="main">
			<div class="container">
			  	<img src="files/assets/book_bg.png" alt="Paper" style="width:100%;" draggable="false">
			  	<div class="centered"><h1>Booked Studio Rooms</h1></div>
			  	<div>
			  		<table class="rooms" style="width: 87%;">
			  			<thead>
			  				<tr>
			  					<th>Room No.</th>
			  					<th>Size</th>
			  					<th>Schedule in</th>
			  					<th>Schedule out</th>
			  					<th>Cost</th>
			  					<th>Duration</th>
			  					<th></th>
			  				</tr>
			  			</thead>
			  			<tbody>
			  				<?php
			  					$customer_id = $_SESSION['user_id'];

			  				    $connect = mysqli_connect("localhost","root","","mj_music_studio") or die("Error in connection");

			  				    $sql = "SELECT * FROM book where CustomerID=$customer_id ORDER BY StudioRoomNumber, StartDateTime ASC";
			  				    $result = mysqli_query($connect, $sql);

								while($row = mysqli_fetch_array($result)){

									$sql = "SELECT * from studio_room where StudioRoomNumber=".$row['StudioRoomNumber'];
									$rooms_row = mysqli_fetch_array(mysqli_query($connect, $sql));

						  			$startDateTime = date_create($row['StartDateTime']);
						  			$startDateTime = date_format($startDateTime, "M d, Y h:i A");

						  			$endDateTime = date_create($row['EndDateTime']);
						  			$endDateTime = date_format($endDateTime, "M d, Y h:i A");

								    echo "<tr>
								            <td>".$row['StudioRoomNumber']."</td>
								            <td>".$rooms_row['StudioRoomSize']."</td>
								            <td>".$startDateTime."</td>
								            <td>".$endDateTime."</td>
								            <td>₱".$row['Cost']."</td>
								            <td>".$row['Duration']." Hour(s)</td>
								            <td style=\"text-align: center;\">
								                <form method=\"post\">
								                    <input type=\"hidden\" name=\"roomNumber\" value=\"".$row['StudioRoomNumber']."\">
								                    <input type=\"hidden\" name=\"startDateTime\" value=\"".$row['StartDateTime']."\">
								                    <input class=\"button\" type=\"submit\" name=\"cancelBookBtn\" value=\" X \">
								                </form>
								            </td>
								          </tr>";
								}
			  				?>
			  				<?php
								if(isset($_POST['cancelBookBtn'])){
									$customer_id = $_SESSION['customer_id'];
									$room_number = $_POST['roomNumber'];
									$startDateTime = $_POST['startDateTime'];

									$sql = "DELETE from book where CustomerID=$customer_id AND StudioRoomNumber=$room_number AND StartDateTime='$startDateTime'";
									$result = mysqli_query($connect, $sql);

									echo "<meta http-equiv='refresh' content='0'>";
								}
							?>
			  			</tbody>
			  		</table>
			  	</div>

			  	<div class="bottom-left">
			  		<a class="out-button" href="book.php">Go Back</a>
			  	</div>
			</div>
		</div>
	</body>
</html>