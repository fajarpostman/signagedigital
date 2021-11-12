<?php

include_once('../../config/server.php');

$query_running_text = "SELECT * FROM signage_running_texts WHERE device_id = " . $device . "";
$running_text = $conn->query($query_running_text);

while ($text = $running_text->fetch_assoc()) {
    if ($text['always_showing'] == 0) {
        if (cek_tanggal($text['start_date'], $text['end_date'])) {
            echo $text['text'];
            for ($i = 0; $i < 15; $i++) {
                echo '&nbsp;';
            }
        }
    } else {
        echo $text['text'];
        for ($i = 0; $i < 15; $i++) {
            echo '&nbsp;';
        }
    }
}
