<?php
$servername = "localhost";
$dBUsername = "id21525238_id21476219_ismaelfrei";
$dBPassword = "FASTIoT_2023";
$dBName = "id21525238_id21476219_esp32";

$conn = mysqli_connect($servername, $dBUsername, $dBPassword, $dBName);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Retrieve the current mode from the database


// Retrieve the current mode from the database
$result_BOTTOM = mysqli_query($conn, "SELECT status FROM Is_Spraying WHERE id = 1");
$row_BOTTOM = mysqli_fetch_assoc($result_BOTTOM);

// Map the numeric status to the corresponding mode
$mode = '';
if ($row_BOTTOM['status'] == 1) {
    $mode = 'WARNING SPRAYING ONGOING';
} else if ($row_BOTTOM['status'] == 0) {
    $mode = 'NO SPRAYING ONGOING';
}




// Return the mode and a timestamp as JSON
echo json_encode(['mode' => $mode]);
?>