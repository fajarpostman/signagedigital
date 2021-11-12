<?php

    // Copy & paste server.example.php to server.php, then configure server.

    $servername = "";
    $username = "";
    $password = "";
    $dbname = "";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    // Check connection
    if ($conn->connect_error) {
        die("<br><br><br><center><h1>INTERNAL SERVER ERROR 505</h1></center>");
    }

    function synchronize($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);

        return $output;
    }

    $query_setting = "SELECT * FROM settings";
    $settings = $conn->query($query_setting);

    while ($row = $settings->fetch_assoc()) {
        if ($row['name'] == 'server_url') {
            $server_url = 'http://'.$row['value'];
        }
        if ($row['name'] == 'client_url') {
            $client_url = 'http://'.$row['value'];
        }
        if ($row['name'] == 'device') {
            $device = $row['value'];
        }
        if ($row['name'] == 'monitor') {
            $monitor = $row['value'];
        }
        if ($row['name'] == 'timezone') {
            $timezone = $row['value'];
        }
    }

    if ($timezone == null) {
        date_default_timezone_set('Asia/Jakarta');
    } else {
        date_default_timezone_set($timezone);
    }
    
?>
