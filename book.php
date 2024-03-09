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
		<title>MJ Music Studio - Book</title>
	</head>
	<body>
		<div class="home-link">
			<a href="home.php">&laquo Home</a>
		</div>
		<div class="main">
			<div class="container">
			  	<img src="files/assets/book_bg.png" alt="Paper" style="width:100%;" draggable="false">
			  	<div class="centered"><h1>Book a Studio Room</h1></div>
			  	<div>
			  		<table class="rooms" style="width: 87%;">
			  			<thead>
			  				<tr>
			  					<th>Room No.</th>
			  					<th>Size</th>
			  					<th></th>
			  				</tr>
			  			</thead>
			  			<tbody>
			  				<?php
			  				    $connect = mysqli_connect("localhost","root","","mj_music_studio") or die("Error in connection");

			  				    $sql = "SELECT * FROM studio_room";
			  				    $result = mysqli_query($connect, $sql);

								while($row = mysqli_fetch_array($result)){
								    echo "<tr>
								            <td>".$row['StudioRoomNumber']."</td>
								            <td>".$row['StudioRoomSize']."</td>
								            <td style=\"text-align: center;\">
								                <form method=\"post\">
								                    <input type=\"hidden\" name=\"roomNumber\" value=\"".$row['StudioRoomNumber']."\">
								                    <input class=\"button\" type=\"submit\" name=\"bookRoomBtn\" value=\" Book \">
								                </form>
								            </td>
								          </tr>";
								}
			  				?>
			  				<?php
								if(isset($_POST['bookRoomBtn'])){
									$_SESSION['book_room_number'] = $_POST['roomNumber'];
									header("Location:book_room.php");
								}
							?>
			  			</tbody>
			  		</table>
			  	</div>
			  	<div class="bottom-left">
			  		<h3>Rates:</h3>
			  		<p>Small = ₱50/hr &nbsp; Medium = ₱75/hr &nbsp; Large = ₱100/hr</p>
			  	</div>
			  	<div class="bottom-right">
			  		<a class="out-button" href="my_bookings.php">My Bookings</a>
			  	</div>
			</div>
		</div>
	</body>
</html>