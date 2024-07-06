<?php
header('Content-Type:application/json');
header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Method:GET');
include_once 'config.php';
$data=json_decode(file_get_contents("php://input"),true);
if (is_null($data) || !isset($data['sid'])) {
    echo json_encode(array("message" => "Invalid input", "status" => false));
    exit;
}

$sid=$data['sid'];
$sql="select * from student where sid='$sid'";
$result=mysqli_query($conn,$sql);
if(mysqli_num_rows($result)>0){
//   $rows=mysqli_fetch_assoc($result);
  $rows=mysqli_fetch_all($result,MYSQLI_ASSOC);
//   print_r(($rows));
 echo json_encode($rows);
}
else{
   echo json_encode(array("message"=>"not record found","status"=>false));
}
?>