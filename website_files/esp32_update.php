<?php

$servername = "localhost";
$dBUsername = "id21476219_ismaelfrei";
$dBPassword = "FASTIoT_2023";
$dBName = "id21476219_esp32";

$conn = mysqli_connect($servername, $dBUsername, $dBPassword, $dBName);

if (!$conn) {
	die("Connection failed: ".mysqli_connect_error());
}


// Update the database for Is_Spraying
if (isset($_POST['cIS'])) {
	$spraying_id = $_POST['cIS'];
	$newVal = $_POST['newVal'];
	$update = mysqli_query($conn, "UPDATE Is_Spraying SET status = '$newVal' WHERE id = '$spraying_id';");
	echo "IS" . $newVal;
}

// Read the database for Operation Mode
if (isset($_POST['rOM'])) {
	$mode_id = $_POST['rOM'];
	$sql = "SELECT * FROM Operation_Mode WHERE id = '$mode_id';";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);
	echo "OM" . $row['status'];
}

// Update the database for Operation Mode
if (isset($_POST['cOM'])) {
	$mode_id = $_POST['cOM'];
	$newVal = $_POST['newVal'];
	$update = mysqli_query($conn, "UPDATE Operation_Mode SET status = '$newVal' WHERE id = '$mode_id';");
	echo "OM" . $newVal;
}

// Update the database for Last_online
if (isset($_POST['cLO'])) {
	$online_id = $_POST['cLO'];
	$newVal = $_POST['newVal'];
	$update = mysqli_query($conn, "UPDATE Last_online SET status = '$newVal' WHERE id = '$online_id';");
	echo "LO" . $newVal;
}

// Update the database for Last_sprayed
if (isset($_POST['cLS'])) {
	$sprayed_id = $_POST['cLS'];
	$newVal = $_POST['newVal'];
	$update = mysqli_query($conn, "UPDATE Last_sprayed SET status = '$newVal' WHERE id = '$sprayed_id';");
	echo "LS" . $newVal;
}

// Update the database for Next_spray
if (isset($_POST['cNS'])) {
	$spray_id = $_POST['cNS'];
	$newVal = $_POST['newVal'];
	$update = mysqli_query($conn, "UPDATE Next_spray SET status = '$newVal' WHERE id = '$spray_id';");
	echo "NS" . $newVal;
}

// Update the database for Salt_concentration
if (isset($_POST['cSC'])) {
	$salt_id = $_POST['cSC'];
	$newVal = $_POST['newVal'];
	$update = mysqli_query($conn, "UPDATE Salt_concentration SET status = '$newVal' WHERE id = '$salt_id';");
	echo "SC" . $newVal;
}

// Update the database for Salt_level
if (isset($_POST['cSL'])) {
	$level_id = $_POST['cSL'];
	$newVal = $_POST['newVal'];
	$update = mysqli_query($conn, "UPDATE Salt_level SET status = '$newVal' WHERE id = '$level_id';");
	echo "SL" . $newVal;
}

// Read the database for Time_of_spray
if (isset($_POST['rToS'])) {
	$time_id = $_POST['rToS'];
	$sql = "SELECT * FROM Time_of_spray WHERE id = '$time_id';";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);
	echo "ToS" . $row['status'];
}

// Update the database for Water_tank_level
if (isset($_POST['cWtl'])) {
	$tank_id = $_POST['cWtl'];
	$newVal = $_POST['newVal'];
	$update = mysqli_query($conn, "UPDATE Water_tank_level SET status = '$newVal' WHERE id = '$tank_id';");
	echo "Wtl" . $newVal;
}
