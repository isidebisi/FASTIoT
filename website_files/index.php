<?php

$servername = "localhost";
$dBUsername = "id21476219_ismaelfrei";
$dBPassword = "FASTIoT_2023";
$dBName = "id21476219_esp32";

$conn = mysqli_connect($servername, $dBUsername, $dBPassword, $dBName);

if (!$conn) {
	die("Connection failed: ".mysqli_connect_error());
}

// Check if form is submitted - MODE
if (isset($_POST['change_mode'])) {
    $new_mode = $_POST['operation_mode'];
    $update = mysqli_query($conn, "UPDATE Operation_Mode SET status = '$new_mode' WHERE id = 1;");
}



if (isset($_POST['toggle_LED'])) {
	$sql = "SELECT * FROM LED_status;";
	$result   = mysqli_query($conn, $sql);
	$row  = mysqli_fetch_assoc($result);
	
	if($row['status'] == 0){
		$update = mysqli_query($conn, "UPDATE LED_status SET status = 1 WHERE id = 1;");		
	}		
	else{
		$update = mysqli_query($conn, "UPDATE LED_status SET status = 0 WHERE id = 1;");		
	}
}



// Fetch the current operation mode
$sqlO = "SELECT * FROM Operation_Mode WHERE id = 1;";
$resultO = mysqli_query($conn, $sqlO);
$rowO = mysqli_fetch_assoc($resultO);
$current_mode = $rowO['status'];


$sql = "SELECT * FROM LED_status;";
$result   = mysqli_query($conn, $sql);
$row  = mysqli_fetch_assoc($result);
?>

<!-- Display the current operation mode -->
<p>Current Operation Mode: 
<?php 
switch ($current_mode) {
    case 0:
        echo "OFF";
        break;
    case 1:
        echo "MANUAL";
        break;
    case 2:
        echo "TIMER";
        break;
    case 3:
        echo "AUTOMATIC";
        break;
    default:
        echo "UNKNOWN";
}
?>
</p>


	

<style>
	.wrapper{
		width: 100%;
		padding-top: 50px;
	}
	.col_3{
		width: 33.3333333%;
		float: left;
		min-height: 1px;
	}
	#submit_button{
		background-color: #2bbaff; 
		color: #FFF; 
		font-weight: bold; 
		font-size: 40; 
		border-radius: 15px;
    	text-align: center;
	}
	.led_img{
		height: 400px;		
		width: 100%;
		object-fit: cover;
		object-position: center;
	}
	
	@media only screen and (max-width: 600px) {
		.col_3 {
			width: 100%;
		}
		.wrapper{
			width: 100%;
			padding-top: 5px;
		}
		.led_img{
			height: 300px;		
			width: 80%;
			margin-right: 10%;
			margin-left: 10%;
			object-fit: cover;
			object-position: center;
		}
	}

</style>


<html>
<head>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.0/jquery.min.js" type="text/javascript"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

	<!-- Form to change the operation mode -->
	<form method="post" action="">
		<select name="operation_mode">
			<option value="0" <?php if ($current_mode == 0) echo 'selected'; ?>>OFF</option>
			<option value="1" <?php if ($current_mode == 1) echo 'selected'; ?>>MANUAL</option>
			<option value="2" <?php if ($current_mode == 2) echo 'selected'; ?>>TIMER</option>
			<option value="3" <?php if ($current_mode == 3) echo 'selected'; ?>>AUTOMATIC</option>
		</select>
		<input type="submit" name="change_mode" value="Change Mode">
	</form>

	<div class="wrapper" id="refresh">
		<div class="col_3">
		</div>

		<div class="col_3" >
			
			<?php echo '<h1 style="text-align: center;">The status of the LED is: '.$row['status'].'</h1>';?>
			
			<div class="col_3">
			</div>
			
			<div class="col_3" style="text-align: center;">
			<form action="index.php" method="post" id="LED" enctype="multipart/form-data">			
				<input id="submit_button" type="submit" name="toggle_LED" value="Toggle LED" />
			</form>
				
			<script type="text/javascript">
			$(document).ready (function () {
				var updater = setTimeout (function () {
					$('div#refresh').load ('index.php', 'update=true');
				}, 1000);
			});
			</script>
			<br>
			<br>
			<?php
				if($row['status'] == 0){?>
				<div class="led_img">
					<img id="contest_img" src="led_off.png" width="100%" height="100%">
				</div>
			<?php	
				}
				else{ ?>
				<div class="led_img">
					<img id="contest_img" src="led_on.png" width="100%" height="100%">
				</div>
			<?php
				}
			?>
			
				
				
				
			</div>
				
			<div class="col_3">
			</div>
		</div>

		<div class="col_3">
		</div>
	</div>
</body>
</html>

