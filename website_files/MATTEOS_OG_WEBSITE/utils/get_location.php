<?php
// Function to handle database connection with error handling
function connectToDatabase($host, $username, $password, $database)
{
    $conn = mysqli_connect($host, $username, $password, $database);

    if (!$conn) {
        throw new Exception("Database connection failed: " . mysqli_connect_error());
    }

    return $conn;
}

// Function to execute a prepared statement and fetch a single result
function fetchSingleResult($conn, $query, $paramType, $paramValue)
{
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, $paramType, $paramValue);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $result);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    return $result;
}

// Function to make a cURL request with error handling
function makeCurlRequest($url)
{
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        $error = ['error' => 'Curl error: ' . curl_error($ch)];
        echo json_encode($error);
        exit();
    }

    curl_close($ch);

    return $response;
}

$servername = "localhost";
$dBUsername = "id21525238_id21476219_ismaelfrei";
$dBPassword = "FASTIoT_2023";
$dBName = "id21525238_id21476219_esp32";

// Connect to the database
$conn = connectToDatabase($servername, $dBUsername, $dBPassword, $dBName);

// Retrieve the current longitude and latitude from the database
$longitude = fetchSingleResult($conn, "SELECT status FROM Location_longitude WHERE id = ?", "i", 1);
$latitude = fetchSingleResult($conn, "SELECT status FROM Location_latitude WHERE id = ?", "i", 1);




// Close the database connection
mysqli_close($conn);

// Use cURL to get the location from Google Maps Geocoding API
$apiKey = "AIzaSyBZoXBX0eK1_O9MtCu3yzBPjb0AZqRSvuQ"; // Replace with your actual API key
$apiUrl = "https://maps.googleapis.com/maps/api/geocode/json?latlng={$latitude},{$longitude}&key={$apiKey}";

// Make the cURL request
$response = makeCurlRequest($apiUrl);

// Debugging statement to check the response before JSON encoding
$data = json_decode($response, true);

// Check if the response is successful
if ($data['status'] == 'OK') {
    // Get the formatted address
    $location = $data['results'][0]['formatted_address'];
} else {
    $location = "Location not found";
}


// Return the location as JSON
echo json_encode(['location' => $location]);
?>


<?php
// Function to handle database connection with error handling
function connectToDatabase($host, $username, $password, $database)
{
    $conn = mysqli_connect($host, $username, $password, $database);

    if (!$conn) {
        throw new Exception("Database connection failed: " . mysqli_connect_error());
    }

    return $conn;
}

// Function to execute a prepared statement and fetch a single result
function fetchSingleResult($conn, $query, $paramType, $paramValue)
{
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, $paramType, $paramValue);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $result);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    return $result;
}

// Function to make an HTTP request with detailed error handling
function makeHttpRequest($url)
{
    $context = stream_context_create([
        'http' => [
            'method' => 'GET',
            'header' => 'Content-Type: application/json',
        ],
    ]);

    $response = file_get_contents($url, false, $context);

    if ($response === false) {
        $error = ['error' => 'HTTP request failed: ' . error_get_last()['message']];
        echo json_encode($error);
        exit();
    }

    // Check if the response is empty
    if (empty($response)) {
        $error = ['error' => 'Empty response from the server.'];
        echo json_encode($error);
        exit();
    }

    // Check if the response is valid JSON
    $decodedResponse = json_decode($response, true);
    if ($decodedResponse === null && json_last_error() !== JSON_ERROR_NONE) {
        $error = ['error' => 'Invalid JSON in the response.'];
        echo json_encode($error);
        exit();
    }

    return $response;
}

$servername = "localhost";
$dBUsername = "id21525238_id21476219_ismaelfrei";
$dBPassword = "FASTIoT_2023";
$dBName = "id21525238_id21476219_esp32";

// Connect to the database
$conn = connectToDatabase($servername, $dBUsername, $dBPassword, $dBName);

// Retrieve the current longitude and latitude from the database
$longitude = fetchSingleResult($conn, "SELECT status FROM Location_longitude WHERE id = ?", "i", 1);
$latitude = fetchSingleResult($conn, "SELECT status FROM Location_latitude WHERE id = ?", "i", 1);

// Close the database connection
mysqli_close($conn);

// Use file_get_contents to get the location from Google Maps Geocoding API
$apiKey = "AIzaSyBZoXBX0eK1_O9MtCu3yzBPjb0AZqRSvuQ"; // Replace with your actual API key
$apiUrl = "https://maps.googleapis.com/maps/api/geocode/json?latlng={$latitude},{$longitude}&key={$apiKey}";

// Make the HTTP request
$response = makeHttpRequest($apiUrl);

// Decode the response as JSON
$data = json_decode($response, true);

// Check if the response is successful
if ($data['status'] == 'OK') {
    // Get the formatted address
    $location = $data['results'][0]['formatted_address'];
} else {
    $location = "Location not found";
}

// Return the location as JSON
echo json_encode(['location' => $location]);
?>
