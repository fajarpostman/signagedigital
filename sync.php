<?php

include_once('config/server.php');

$api = synchronize($server_url . "display/" . $device);

$api = json_decode($api, TRUE);

$running_text_server = $api['running_text'];
$video_server = $api['video'];
$banner_server = $api['banner'];
$exchange_rate_server = $api['exchange_rate'];
$deposito_server = $api['deposito'];

$conn->query("TRUNCATE signage_running_texts");
foreach ($running_text_server as $running_text) {
    $insert_running_text = "INSERT INTO signage_running_texts (device_id, server_signage_id, text, start_date, end_date, always_showing) VALUES (" . $device . ", " . $running_text['id'] . ", '" . $running_text['text'] . "', '" . $running_text['start_date'] . "', '" . $running_text['end_date'] . "', '" . $running_text['always_showing'] . "')";
    $conn->query($insert_running_text);
}

if ($api != []) {
    $conn->query("TRUNCATE signage_videos");
}
foreach ($video_server as $video) {
    $insert_video = "INSERT INTO signage_videos (device_id, server_signage_id, file, start_date, end_date, always_showing) VALUES (" . $device . ", " . $video['id'] . ",'" . $video['file'] . "', '" . $video['start_date'] . "', '" . $video['end_date'] . "', '" . $video['always_showing'] . "')";
    $conn->query($insert_video);
}

if ($api != []) {
    $conn->query("TRUNCATE signage_banners");
}
foreach ($banner_server as $banner) {
    $insert_banner = "INSERT INTO signage_banners (device_id, server_signage_id, file, start_date, end_date, always_showing) VALUES (" . $device . ", " . $banner['id'] . ",'" . $banner['file'] . "','" . $banner['start_date'] . "','" . $banner['end_date'] . "','" . $banner['always_showing'] . "')";
    $conn->query($insert_banner);
}

$conn->query("TRUNCATE signage_depositos");
foreach ($deposito_server as $deposito) {
    $insert_deposito = "INSERT INTO signage_depositos (device_id, server_signage_id, tenor, interest, start_date, end_date, always_showing) VALUES (" . $device . ", " . $deposito['id'] . ", '" . $deposito['tenor'] . "', '" . $deposito['interest'] . "', '" . $deposito['start_date'] . "', '" . $deposito['end_date'] . "', '" . $deposito['always_showing'] . "')";
    $conn->query($insert_deposito);
}

$conn->query("TRUNCATE signage_exchange_rates");
foreach ($exchange_rate_server as $exchange) {
    $insert_exchange = "INSERT INTO signage_exchange_rates (device_id, server_signage_id, country, type, bank_buy, bank_sell, start_date, end_date, always_showing, updated_at) VALUES (" . $device . ", " . $exchange['id'] . ", '" . $exchange['country'] . "', '" . $exchange['type'] . "', " . $exchange['bank_buy'] . ", " . $exchange['bank_sell'] . ", '" . $exchange['start_date'] . "', '" . $exchange['end_date'] . "', '" . $exchange['always_showing'] . "', '" . $exchange['updated_at'] . "')";
    $conn->query($insert_exchange);
}
header("Location: setting.php");
