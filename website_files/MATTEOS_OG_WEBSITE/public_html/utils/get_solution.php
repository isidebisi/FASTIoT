<?php
$servername = "localhost";
$dBUsername = "thawpalc_01";
$dBPassword = "fastiotepfl23";
$dBName = "thawpalc_0";

$conn = mysqli_connect($servername, $dBUsername, $dBPassword, $dBName);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Retrieve the current mode from the database


// Retrieve the current mode from the database
$result_BOTTOM = mysqli_query($conn, "SELECT status FROM Salt_concentration WHERE id = 1");
$row_BOTTOM = mysqli_fetch_assoc($result_BOTTOM);

// Map the numeric status to the corresponding mode
$mode = $row_BOTTOM['status'] . '%';





// Return the mode and a timestamp as JSON
echo json_encode(['mode' => $mode]);
?>