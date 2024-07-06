<?php
header('Content-Type:application/json');
header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Method:POST');
// header('Access-Control-Allow-Headers:Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Method,Authorization,X-Requested-With');
include_once 'config.php';
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(array("message" => "Only POST requests are allowed", "status" => false));
    exit;
}
$data=json_decode(file_get_contents("php://input"),true);
// $sid=$data['sid'];

if (!isset($data['sname']) || !isset($data['sadd']) || !isset($data['subject'])) {
    echo json_encode(array("message" => "Invalid input", "status" => false));
    exit;
}

$sname=$data['sname'];
$sadd=$data['sadd'];
$sub=$data['subject'];
$sql="insert into student(sname,sadd,subject)values('$sname','$sadd','$sub')";
if(mysqli_query($conn,$sql))
{
    echo json_encode(array("message"=>"record inserted successfully","status"=>true));
}
else{
   echo json_encode(array("message"=>"record not inserted","status"=>false));
}
?>