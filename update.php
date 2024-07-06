<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');

// Include database configuration
include_once 'config.php';

// Check if the request method is PUT
if ($_SERVER['REQUEST_METHOD'] !== 'PUT') {
    echo json_encode(array("message" => "Only PUT requests are allowed", "status" => false));
    exit;
}

// Get the raw PUT data
$input = file_get_contents("php://input");
$data = json_decode($input, true);

// Check for required fields
if (!isset($data['sid']) || !isset($data['sname']) || !isset($data['sadd']) || !isset($data['subject'])) {
    echo json_encode(array("message" => "Invalid input", "status" => false));
    exit;
}

// Sanitize and assign the input values
$sid = mysqli_real_escape_string($conn, $data['sid']);
$sname = mysqli_real_escape_string($conn, $data['sname']);
$sadd = mysqli_real_escape_string($conn, $data['sadd']);
$sub = mysqli_real_escape_string($conn, $data['subject']);

// SQL query to update the student record
$sql = "UPDATE student SET sname='$sname', sadd='$sadd', subject='$sub' WHERE sid='$sid'";

if (mysqli_query($conn, $sql)) {
    if (mysqli_affected_rows($conn) > 0) {
        echo json_encode(array("message" => "Record updated successfully", "status" => true));
    } else {
        echo json_encode(array("message" => "No record found to update", "status" => false));
    }
} else {
    echo json_encode(array("message" => "Record not updated", "status" => false));
}

// Close the database connection
mysqli_close($conn);
?>
