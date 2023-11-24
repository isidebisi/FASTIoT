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
$result_BOTTOM = mysqli_query($conn, "SELECT status FROM Next_spray WHERE id = 1");
$row_BOTTOM = mysqli_fetch_assoc($result_BOTTOM);

// Retrieve activation times from the POST request
$activationTimes = json_decode($_POST['activationTimes'], true);

// Concatenate activation times into a comma-separated string
$nextSprayTimes = implode(", ", $activationTimes);

// Update the Next_spray field in the database
$updateNextSpray = mysqli_query($conn, "UPDATE Next_spray SET status = '$nextSprayTimes' WHERE id = 1");

if ($updateNextSpray) {
    echo 'Update next spray script executed successfully';
} else {
    echo 'Error updating next spray: ' . mysqli_error($conn);
}

mysqli_close($conn);
?>
