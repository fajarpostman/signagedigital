<?php
$server = $_POST['server_url'];

// $server = '192.168.100.155/server_ibk/public/';
$explode = explode('/', $server);
$ip =   $explode[0];

exec("ping -n 3 $ip", $output, $status);//windows
// exec("ping -c 2 $ip", $output, $status);//linux
$response['data'] = $output; 

echo json_encode($response);
?>