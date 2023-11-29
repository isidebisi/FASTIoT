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
$result = mysqli_query($conn, "SELECT status FROM Operation_Mode WHERE id = 1");
$row = mysqli_fetch_assoc($result);

// Map the numeric status to the corresponding mode
$mode = '';
switch ($row['status']) {
    case 1:
        $mode = 'SPRAY NOW';
        break;
    case 2:
        $mode = 'SCHEDULED';
        break;
    case 3:
        $mode = 'AUTOMATIC';
        break;
    default:
        $mode = 'No Mode enabled';
}

// Return the mode and a timestamp as JSON
echo json_encode(['mode' => $mode]);
?>