<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');

// Include database configuration
include_once 'config.php';

// Check if the request method is PUT
if ($_SERVER['REQUEST_METHOD'] !== 'DELETE') {
    echo json_encode(array("message" => "Only delete requests are allowed", "status" => false));
    exit;
}

// Get the raw PUT data
$input = file_get_contents("php://input");
$data = json_decode($input, true);

// Check for required fields
if (!isset($data['sid'])) {
    echo json_encode(array("message" => "Invalid input", "status" => false));
    exit;
}

// Sanitize and assign the input values
$sid = mysqli_real_escape_string($conn, $data['sid']);


// SQL query to update the student record
$sql = "delete from student where sid='$sid' ";

if (mysqli_query($conn, $sql)) {
    if (mysqli_affected_rows($conn) > 0) {
        echo json_encode(array("message" => "Record deleted successfully", "status" => true));
    } else {
        echo json_encode(array("message" => "No record found to delete", "status" => false));
    }
} else {
    echo json_encode(array("message" => "Record not deleted", "status" => false));
}

// Close the database connection
mysqli_close($conn);
?>
