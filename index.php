<?php
#if (!(isset($_GET['device']) && isset($_GET['monitor']))) {
#  die("<br><br><br><center><h1>INTERNAL SERVER ERROR 505</h1></center>");
#}
include_once('config/server.php');

if (($server_url == null) || ($client_url == null)) {
    header("Location: setting.php");
}

if ($monitor == 1) {
    $width = '1024';
    $height = '768';

    $header1_width = '699';
    $header2_width = '325';

    $video_height = '464';
} else if ($monitor == 2) {
    $width = '1280';
    $height = '720';

    $header1_width = '870';
    $header2_width = '410';

    $video_height = '512';
}

function cek_tanggal($start_date, $end_date)
{
    $tanggal_sekarang = strtotime(date('d-m-Y H:m'));
    $start_date = strtotime($start_date);
    $end_date = strtotime($end_date);

    if (($tanggal_sekarang > $start_date) && ($tanggal_sekarang < $end_date)) {
        return true;
    } else {
        return false;
    }
}

$query_running_text = "SELECT * FROM signage_running_texts WHERE device_id = " . $device . "";
$running_text = $conn->query($query_running_text);

$query_video = "SELECT * FROM signage_videos WHERE device_id = " . $device . "";
$video = $conn->query($query_video);

$query_banner = "SELECT * FROM signage_banners WHERE device_id = " . $device . "";
$banner = $conn->query($query_banner);

$query_exchange_rate = "SELECT * FROM signage_exchange_rates WHERE device_id = " . $device . "";
$exchange_rate = $conn->query($query_exchange_rate);

$query_last_updated_exchange_rate = "SELECT updated_at FROM signage_exchange_rates WHERE device_id = " . $device . " ORDER BY updated_at DESC LIMIT 1";
$last_updated_exchange_rate = $conn->query($query_last_updated_exchange_rate);

if ($result = $conn->query($query_last_updated_exchange_rate)) {
    while ($row = $last_updated_exchange_rate->fetch_assoc()) {
        $date = $row['updated_at'];
    }
}

$updated_at = new DateTime($date);

$query_deposito = "SELECT * FROM signage_depositos WHERE device_id = " . $device . "";
$deposito = $conn->query($query_deposito);

?>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bank Agris Jakarta</title>

    <link rel="stylesheet" href="assets/app.css">
    <link rel="stylesheet" href="node_modules/video.js/dist/video-js.min.css">

    <script src="node_modules/jquery/dist/jquery.min.js"></script>
    <script src="node_modules/video.js/dist/video.js"></script>
    <script src="node_modules/videojs-playlist/dist/videojs-playlist.js"></script>

    <style>
        .display-frame {
            width: <?= $width ?>px;
            height: <?= $height ?>px;
        }

        /* .vjs-tech {
            object-fit: cover;
       } */
    </style>

    <script>
        function date_time(id) {
            date = new Date;
            year = date.getFullYear();
            month = date.getMonth();
            months = new Array('Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
            d = date.getDate();
            day = date.getDay();
            days = new Array('Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu');
            h = date.getHours();
            if (h < 10) {
                h = "0" + h;
            }
            m = date.getMinutes();
            if (m < 10) {
                m = "0" + m;
            }
            s = date.getSeconds();
            if (s < 10) {
                s = "0" + s;
            }
            result = '' + days[day] + ', ' + d + ' ' + months[month] + ' ' + year + ' ' + h + ':' + m + ':' + s;
            document.getElementById(id).innerHTML = result;
            setTimeout('date_time("' + id + '");', '1000');
            return true;
        }
    </script>
</head>

<body>
    <table class="display-frame"  cellpadding="0" cellspacing="0">
        <tr height="100">
            <td width="<?= $header2_width ?>" style="border: 1px solid white;">
                <center>
                    <a href="setting.php"> <img src="assets/image/IBK.png" width="300" alt=""> </a>
                </center>
            </td>
            <td width="<?= $header1_width ?>" class="bg-orange" >
                <h2 class="text-center" style="margin-top: 10px">SELAMAT DATANG</h2>
                <h2 class="text-center" style="margin-top: -10px">DI <?= $location ?></h2>
            </td>
        </tr>
        <tr>
            <td valign="top" height="200">
                <!-- <div class="carousel">
                    <?php
                    if ($banner->num_rows == 0) {
                    ?> <img class="img-carousel" src="" style="height:200px;"> <?php
                                                                            } else {
                                                                                while ($image = $banner->fetch_assoc()) {
                                                                                    if ($image['always_showing'] == 0) {
                                                                                        if (cek_tanggal($image['start_date'], $image['end_date'])) { ?>
                                    <img class="img-carousel" src="<?= $client_url . $image['file'] ?>" style="height:200px;">
                                <?php }
                                                                                    } else { ?>
                                <img class="img-carousel" src="<?= $client_url . $image['file'] ?>" style="height:200px;">
                            <?php } ?>
                        <?php } ?>
                    <?php } ?>
                </div> -->
                <div style="border: 1px solid white;height: 195px;">
                    <center>
                        <p class="text-center" style="margin-bottom: 20px"><span id="date_time"></span></p>
                        <h1 class="text-center" style="font-size: 60px; margin-top: -20px;">061</h1>
                        <h3 class="text-center" style="font-size: 30px; margin-top: -40px">COUNTER 2</h3>
                        <div style="display: flex" class="text-center">
                            <div style="width:50%; height: 40px; margin-top: -40px; ">
                                <p style="margin-top: 20px;font-weight: bold">012</p>
                                <p style="margin-top: -10px;font-weight: bold">Counter 1</p>
                            </div>
                            <div style="width:50%; height: 40px; margin-top: -40px; ">
                                <p style="margin-top: 20px; font-weight: bold">012</p>
                                <p style="margin-top: -10px; font-weight: bold">Counter 1</p>
                            </div>
                        </div>
                    </center>
                </div>
            </td>
            <td rowspan="2" bgcolor="black">
                <table height="100%" width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td bgcolor="black" style="border: 1px solid white;">
                            <video class="video-js" preload="auto" style="width:100%;height:<?= $video_height ?>px;" autoplay></video>
                        </td>
                    </tr>
                    <tr>
                        <td width="<?= $header1_width ?>" class="bg-orange" style="border: 1px solid white;"">
                            <marquee behavior="" direction="" style="margin-bottom:-10px;">
                                <h1 style="color:white;" id="ajax_running_text">

                                </h1>
                            </marquee>
                            <!-- <b style="font-size:1.1em;margin-right:10px;float:right;"><span id="date_time"></span></b> -->
                        </td>
                    </tr>
                </table>

            </td>
        </tr>
        <tr>

            <td valign="top">
                <center style="height:100%;">
                    <table class="tabel-kurs-strip" style="height:100%; border-collapse: collapse;">
                        <thead>
                            <tr style="height:50px;">
                                <td class="kurs-responsive text-center bg-orange">
                                    <b style="font-size:0.85em;">Exchange Rate</b>
                                </td>
                                <td class="kurs-responsive text-center bg-orange">
                                    <b style="font-size:0.85em;">Bank Buy</b>
                                </td>
                                <td class="kurs-responsive text-center bg-orange">
                                    <b style="font-size:0.85em;">Bank Sell</b>
                                </td>
                            </tr>
                        </thead>

                        <tbody id="ajax_signage_exchange_rates">

                        </tbody>

                    </table>
                </center>
            </td>

        </tr>

    </table>

    <input type="hidden" name="next_page" value="1" id="next_page">
    <script type="text/javascript">
        window.onload = date_time('date_time');
        window.setInterval(function() {
            $.ajax({
                url: "<?= $server_url . "refresh_cek/" . $device ?>",
                method: "GET",
                async: false,
                dataType: 'json',
                success: function(data) {
                    console.log(data.status);
                    if (data.status == 'refresh') {
                        location.reload();
                    }
                }
            });
        }, 5000); //milliseconds
    </script>
    <script>
        var player = videojs(document.querySelector('video'), {
            "controls": false,
            "autoplay": true,
            <?php
            if (mysqli_num_rows($video) <= 1) {
            ?> "loop": true
            <?php
            }
            ?>
        });

        player.playlist(
            [
                <?php while ($file = $video->fetch_assoc()) {
                    if ($file['always_showing'] == 0) {
                        if (cek_tanggal($file['start_date'], $file['end_date'])) { ?> {
                                sources: [{
                                    src: "<?= $client_url . $file['file'] ?>",
                                    type: 'video/mp4'
                                }]
                            },
                        <?php }
                    } else { ?> {
                            sources: [{
                                src: "<?= $client_url . $file['file'] ?>",
                                type: 'video/mp4'
                            }]
                        },
                    <?php } ?>
                <?php } ?>
            ]
        );

        var size = Object.keys(player.playlist()).length;
        player.playlist.autoadvance(0);
        player.playlist.repeat(true);

        var hitung_playlist = 0;
        player.on('ended', function() {
            if (size == (player.playlist.currentItem() + 1)) {
                player.playlist.first();
                hitung_playlist++;
            }
        });

        var myIndex = 0;
        // carousel();

        function carousel() {
            var i;
            var x = document.getElementsByClassName("img-carousel");
            for (i = 0; i < x.length; i++) {
                x[i].style.display = "none";
            }
            myIndex++;
            if (myIndex > x.length) {
                myIndex = 1
            }
            x[myIndex - 1].style.display = "block";
            setTimeout(carousel, 5000); // Change image every 2 seconds
        }

        function ajax_signage_depositos() {
            var next_page = $('#next_page').val();
            $.ajax({
                url: "./ajax/html/signage_depositos.php",
                type: "GET",
                success: function(response) {
                    result = JSON.parse(response);
                    console.log(result);
                    $('#tr_tabel_bulan').html(result.tr_tabel_bulan);
                    $('#tr_tabel_deposito').html(result.tr_tabel_deposito);
                },
                error: function() {
                    // $('#ajax_signage_exchange_rates').html('');
                }
            });
        }

        function ajax_signage_exchange_rates() {
            var next_page = $('#next_page').val();
            $.ajax({
                url: "./ajax/html/signage_exchange_rates.php?page=" + next_page,
                type: "GET",
                success: function(response) {
                    result = JSON.parse(response);
                    $('#next_page').val(result.next_page);
                    $('#ajax_signage_exchange_rates').html(result.table_html);
                },
                error: function() {
                    // $('#ajax_signage_exchange_rates').html('');
                }
            });
        }

        function ajax_running_text() {
            $.ajax({
                url: "./ajax/html/running_text.php",
                type: "GET",
                success: function(response) {
                    $('#ajax_running_text').html(response);
                },
                error: function() {
                    $('#ajax_running_text').html('');
                }
            });
        }

        $(document).ready(function() {
            ajax_running_text();
            ajax_signage_exchange_rates();
            ajax_signage_depositos();

            window.setInterval(function() {
                ajax_running_text();
                ajax_signage_exchange_rates();
                ajax_signage_depositos();
            }, 10000);
        });
    </script>
</body>

</html>

<?php

$conn->close();

?>