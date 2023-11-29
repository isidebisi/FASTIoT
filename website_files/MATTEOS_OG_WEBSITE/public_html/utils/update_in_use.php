<?php

$servername = "localhost";
$dBUsername = "thawpalc_01";
$dBPassword = "fastiotepfl23";
$dBName = "thawpalc_0";

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


