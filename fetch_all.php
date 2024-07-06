<?php
header('Content-Type:application/json');
header('Access-Control-Allow-Origin:*');
include_once 'config.php';
$sql="select * from student";
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