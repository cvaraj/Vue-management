<?php
$host = "localhost"; 
$user = "root"; 
$password = ""; 
$dbname = "vuedb"; 
$id = '';

$con = mysqli_connect($host, $user, $password,$dbname);

$method = $_SERVER['REQUEST_METHOD'];
//$request = explode('/', trim($_SERVER['PATH_INFO'],'/'));
//$input = json_decode(file_get_contents('php://input'),true);


if (!$con) {
  die("Connection failed: " . mysqli_connect_error());
}


$result = mysqli_query($con,$sql);

/*if (!$result) {
  http_response_code(404);
  die(mysqli_error($con));
}*/
$data = json_decode(file_get_contents("php://input"));

  $request = $data->request;

if ($method == 'POST') {
	

   if($request == 2){
	   $id = $data->id;
	 
	    $id = $id;

	    mysqli_query($con,"DELETE FROM contacts WHERE id=".$id);
	    echo json_encode($result);
	    exit;
	}
}
?>