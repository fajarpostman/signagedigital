<?php
include_once('../../config/server.php');

$query_deposito = "SELECT * FROM signage_depositos WHERE device_id = " . $device . "";

$konek    = mysqli_connect($servername, $username, $password, $dbname) or die('gagal konek data base');
$deposito = mysqli_query($konek, $query_deposito);

$tr_tabel_bulan = '';

?>

<?php
    $jumlah_deposito = 1;

    foreach ($deposito as $key => $tenor) {
        $jumlah_deposito++;
    }

    $tr_tabel_bulan  .= '<td rowspan="2" class="bg-orange" style="width:' . (100 / $jumlah_deposito) . '%"><b style="font-size:1em;">TIME DEPOSIT</b></td>';
?>

<?php

    foreach ($deposito as $key => $tenor) {
        if ($tenor['always_showing'] == 0) {
            if (cek_tanggal($tenor['start_date'], $tenor['end_date'])) {
                $tr_tabel_bulan .= '<td class="bg-orange" style="border: 1px solid white; font-size:1em; width:' . (100 / $jumlah_deposito) . '%"><b>' . $tenor['tenor'] . '</b></td>';
            }
        } else {
            $tr_tabel_bulan .= '<td class="bg-orange" style="border: 1px solid white; font-size:1em; width:' . (100 / $jumlah_deposito) . '%"><b>' . $tenor['tenor'] . '</b></td>';
        }
    }

    $tr_tabel_deposito = '';

    foreach ($deposito as $key => $interest) {
        if ($interest['always_showing'] == 0) {
            if (cek_tanggal($interest['start_date'], $interest['end_date'])) {
                $tr_tabel_deposito .= '<td class="isi-deposito"><b style="font-size:1em; width:' . (100 / $jumlah_deposito) . '%">' . $interest['interest'] . '</b></td>';
            }
        } else {
            $tr_tabel_deposito .= '<td class="isi-deposito"><b style="font-size:1em; width:' . (100 / $jumlah_deposito) . '%">' . $interest['interest'] . '</b></td>';
        }
    }

    $response = (object) array(
        'tr_tabel_bulan' => $tr_tabel_bulan,
        'tr_tabel_deposito' => $tr_tabel_deposito,
    );

    print_r(json_encode($response));

?>
