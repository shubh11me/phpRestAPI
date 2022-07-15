<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

require './vendor/autoload.php';

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
$data = json_decode(file_get_contents("php://input"), true);

$email = $data['email'];
$pass = $data['pass'];


$key='biroo';
include "config.php";
$time = time();



$sql = "select * from user where Email='$email' and password='$pass'";
$res=mysqli_query($conn, $sql);
if(mysqli_num_rows($res)>0){
    $data=mysqli_fetch_all($res,MYSQLI_ASSOC);
    $payload = [
        'iss' => 'dreamteam',
        'aud' => 'dreamAud',
        'iat' => $time,
        'nbf' => $time,
        'data' => $data
    ];
    
    $jwt = JWT::encode($payload, $key, 'HS512');
	echo json_encode(array('message' => 'Login pass', 'status' => true,"jwt"=>$jwt));

}else{

 echo json_encode(array('message' => 'Login failed', 'status' => false));

}
?>
