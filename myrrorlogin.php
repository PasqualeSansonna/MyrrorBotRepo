<?php


function queryMyrror($param){

	$ch = curl_init();
    $json_data = null;

curl_setopt($ch, CURLOPT_URL,"http://90.147.102.243:5000/auth/login");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS,
            "email=cat@cat.it&password=cat");

// In real life you should use something like:
// curl_setopt($ch, CURLOPT_POSTFIELDS, 
//          http_build_query(array('postvar1' => 'value1')));

// Receive server response ...
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$server_output = curl_exec($ch);
$result = json_decode($server_output,true);
curl_close ($ch);

// Further processing ...
if ($server_output) {
// echo $result['token'];
 $token = $result['token'];
 $ch = curl_init();

$headers =[
"x-access-token:".$token
];



curl_setopt($ch, CURLOPT_URL, "http://90.147.102.243:5000/api/profile/".$result['username'].$param);

curl_setopt($ch, CURLOPT_POST, 0);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);          

$result2 = curl_exec($ch);
//Decode JSON
$json_data = json_decode($result2,true);




//Print data
//print_r($json_data);

curl_close ($ch);

return $json_data;




}

}

?>