<?php
include_once('config/server.php');

$api = synchronize( $server_url . "display/" . $device);

$api = json_decode($api, TRUE);

$video_server = $api['video'];
$banner_server = $api['banner'];

$video_baru = [];
$video_lama = [];
foreach ($video_server as $video) {
    $cek_data_if_exist = "SELECT * FROM signage_videos WHERE signage_videos.device_id LIKE '" . $device . "' and signage_videos.server_signage_id like '" . $video['id'] . "' and signage_videos.start_date like '" . $video['start_date'] . "' and signage_videos.end_date like '" . $video['end_date'] . "' and signage_videos.always_showing like '" . $video['always_showing'] . "'";
    $result = $conn->query($cek_data_if_exist);
    
    while($value = $result->fetch_assoc()){
        $id = $value['id'];
        $file = $value['file'];
    }

    $handle = @fopen($client_url.$video['file'], 'r');
    if(!$handle){
        file_put_contents(substr($video['file'], 1), file_get_contents($server_url . $video['file'], 'r'));
    }
    $video_baru[] = $video['file'];
}

$folder_video = __DIR__.'/storage/upload/videos';

$cek_isi_folder_video = scandir($folder_video);

unset($cek_isi_folder_video[0], $cek_isi_folder_video[1], $cek_isi_folder_video[2]);

foreach($cek_isi_folder_video as $file) {
    $video_lama[] = '/storage/upload/videos/'.$file;
}

$video_kosong = array_diff($video_lama, $video_baru);

foreach ($video_kosong as $video) {
    if ($api != []) {
        unlink(__DIR__.$video);
    }
}

$banner_baru = [];
$banner_lama = [];
foreach ($banner_server as $banner) {
    $cek_data_if_exist = "SELECT * FROM signage_banners WHERE signage_banners.device_id LIKE '" . $device . "' and signage_banners.server_signage_id like '" . $banner['id'] . "' and signage_banners.start_date like '" . $banner['start_date'] . "' and signage_banners.end_date like '" . $banner['end_date'] . "' and signage_banners.always_showing like '" . $banner['always_showing'] . "'";
    $result = $conn->query($cek_data_if_exist);
    
    while($value = $result->fetch_assoc()){
        $id = $value['id'];
        $file = $value['file'];
    }

    $handle = @fopen($client_url.$banner['file'], 'r');
    if(!$handle){
        file_put_contents(substr($banner['file'], 1), file_get_contents($server_url . $banner['file'], 'r'));
    }
    $banner_baru[] = $banner['file'];
}

$folder_banner = __DIR__.'/storage/upload/banners';

$cek_isi_folder_banner = scandir($folder_banner);

unset($cek_isi_folder_banner[0], $cek_isi_folder_banner[1], $cek_isi_folder_banner[2]);

foreach($cek_isi_folder_banner as $file) {
    $banner_lama[] = '/storage/upload/banners/'.$file;
}

$banner_kosong = array_diff($banner_lama, $banner_baru);

foreach ($banner_kosong as $banner) {
    if ($api != []) {
    unlink(__DIR__.$banner);
    }
}
header("Location: setting.php");
?>
