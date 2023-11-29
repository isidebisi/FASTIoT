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
$result = mysqli_query($conn, "SELECT status FROM Problems WHERE id = 1");
$row = mysqli_fetch_assoc($result);

// Map the numeric status to the corresponding mode
$mode = '';
switch ($row['status']) {
    case 1:
        $mode = 'NO PROBLEMS FOUND';
        break;
    case 0:
        $mode = 'PROBLEMS FOUND';
        break;
    default:
        $mode = 'Other Problems';
}

// Return the mode and a timestamp as JSON
echo json_encode(['mode' => $mode]);
?>