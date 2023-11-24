<?php

$servername = "localhost";
$dBUsername = "id21525238_id21476219_ismaelfrei";
$dBPassword = "FASTIoT_2023";
$dBName = "id21525238_id21476219_esp32";

$conn = mysqli_connect($servername, $dBUsername, $dBPassword, $dBName);

if (!$conn) {
	die("Connection failed: ".mysqli_connect_error());
}




if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the mode value sent from JavaScript
    $mode = $_POST['mode'];

    
    $update = mysqli_query($conn, "UPDATE Is_Spraying SET status = 1 WHERE id = 1;");
    

    // Perform database update using $mode value (you should have your database connection here)
    // Example:
    // $db->query("UPDATE your_table SET mode='$mode' WHERE id=your_id");

    // Return a success message (this will be sent back to the JavaScript as a response)
    echo 'Database updated successfully';
} else {
    echo 'Invalid request';
}




?>


