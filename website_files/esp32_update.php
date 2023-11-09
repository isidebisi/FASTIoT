<?php


$servername = "localhost";
$dBUsername = "id21476219_ismaelfrei";
$dBPassword = "FASTIoT_2023";
$dBName = "id21476219_esp32";

$conn = mysqli_connect($servername, $dBUsername, $dBPassword, $dBName);

if (!$conn) {
	die("Connection failed: ".mysqli_connect_error());
}

//Read the database for LED status
if (isset($_POST['check_LED_status'])) {
	$led_id = $_POST['check_LED_status'];	
	$sql = "SELECT * FROM LED_status WHERE id = '$led_id';";
	$result   = mysqli_query($conn, $sql);
	$row  = mysqli_fetch_assoc($result);
	if($row['status'] == 0){
		echo "LED_is_off";
	}
	else{
		echo "LED_is_on";
	}	
}	

//Update the database for LED status
if (isset($_POST['toggle_LED'])) {
	$led_id = $_POST['toggle_LED'];	
	$sql = "SELECT * FROM LED_status WHERE id = '$led_id';";
	$result   = mysqli_query($conn, $sql);
	$row  = mysqli_fetch_assoc($result);
	if($row['status'] == 0){
		$update = mysqli_query($conn, "UPDATE LED_status SET status = 1 WHERE id = 1;");
		echo "LED_is_on";
	}
	else{
		$update = mysqli_query($conn, "UPDATE LED_status SET status = 0 WHERE id = 1;");
		echo "LED_is_off";
	}	
}	


//Read the database for Operation Mode
if (isset($_POST['check_Operation_Mode'])) {
    $mode_id = $_POST['check_Operation_Mode'];	
    $sql = "SELECT * FROM Operation_Mode WHERE id = '$mode_id';";
    $result   = mysqli_query($conn, $sql);
    $row  = mysqli_fetch_assoc($result);
    echo "Operation_Mode_is_".$row['status'];
}

//Update the database for Operation Mode
if (isset($_POST['change_Operation_Mode'])) {
    $mode_id = $_POST['change_Operation_Mode'];
    $new_mode = $_POST['new_mode'];
    $update = mysqli_query($conn, "UPDATE Operation_Mode SET status = '$new_mode' WHERE id = '$mode_id';");
    echo "Operation_Mode_is_now_".$new_mode;
}
?>