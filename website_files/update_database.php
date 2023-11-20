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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the mode value sent from JavaScript
    $mode = $_POST['mode'];

    if ($mode == 'AUTOMATIC') {
        $update = mysqli_query($conn, "UPDATE Operation_Mode SET status = 3 WHERE id = 1;");
        
        
        
    } else if ($mode == 'Is_Spraying') {
        $update = mysqli_query($conn, "UPDATE Operation_Mode SET status = 1 WHERE id = 1;");
     
        

    } else if ($mode == 'SCHEDULED') {
        $update = mysqli_query($conn, "UPDATE Operation_Mode SET status = 2 WHERE id = 1;");
        

    } 

    // Perform database update using $mode value (you should have your database connection here)
    // Example:
    // $db->query("UPDATE your_table SET mode='$mode' WHERE id=your_id");

    // Return a success message (this will be sent back to the JavaScript as a response)
    echo 'Database updated successfully';
} else {
    echo 'Invalid request';
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

