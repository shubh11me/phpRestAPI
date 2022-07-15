<?php

header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers:Access-Control-Allow-Headers, Content-type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

$data = json_decode(file_get_contents("php://input"), true);

$student_id = $data['sid'];

include "config.php";

$sql = "DELETE FROM students WHERE id = {$student_id}";

if(mysqli_query($conn, $sql)){
    
    echo json_encode(array('msg'=>'student record deleted', 'status' => false));
}
else{
    echo json_encode(array('msg'=>'student record not deleted', 'status' => false));
}
?>
