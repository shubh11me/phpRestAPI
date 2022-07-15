<?php

header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

//Using POST method
// $data = json_decode(file_get_contents("php://input"), true);

// $search_value = $data['search'];

//Using GET method
$search_value = isset($_GET['search']) ? $_GET['search'] : die();

include "config.php";

$sql = "SELECT * FROM students WHERE name LIKE '%{$search_value}%'";

$result = mysqli_query($conn, $sql) or die ("SQL query failed");

if(mysqli_num_rows($result) > 0){
    
    $output = mysqli_fetch_all($result,MYSQLI_ASSOC);
    echo json_encode($output);
}
else{
    echo json_encode(array('msg'=>'no search found', 'status' => false));
}
?>