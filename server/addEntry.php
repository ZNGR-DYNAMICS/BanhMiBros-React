<?php

require_once 'env.php';

loadEnv(__DIR__, '../.env');

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");


$servername = 'localhost';
$username = getenv('DB_SERVER');
$dbname = getenv('DB_USERNAME');
$password = getenv('DB_PASSWORD');

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    http_response_code(500);
    die("Connection failed: " . $conn->connect_error);
}

$input = file_get_contents("php://input");
$data = json_decode($input, true);

if (isset($data['username']) && isset($data['password'])) {
    $username = $conn->real_escape_string($data['username']);
    $password = $conn->real_escape_string($data['password']);

    $sql = "INSERT INTO test (`username-test`, `password-test`) VALUES ('$username', '$password')";

    if ($conn->query($sql) === TRUE) {
        echo "New entry added successfully!";
    } else {
        http_response_code(500);
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    http_response_code(400);
    echo "Invalid input. Please provide both username and password.";
}

$conn->close();

?>