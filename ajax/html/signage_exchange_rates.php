<?php
include_once('../../config/server.php');

if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}

$konek= mysqli_connect($servername, $username, $password, $dbname) or die ('gagal konek data base');


$no_of_records_per_page = 4;
$offset = ($page-1) * $no_of_records_per_page;

$total_pages_sql = "SELECT COUNT(*) FROM signage_exchange_rates";
$result = mysqli_query($konek,$total_pages_sql);
$total_rows = mysqli_fetch_array($result)[0];
$total_pages = ceil($total_rows / $no_of_records_per_page);

$sql = "SELECT * FROM signage_exchange_rates LIMIT $offset, $no_of_records_per_page";

$datanya = mysqli_query($konek,$sql);

$iterasi = $no_of_records_per_page;
$table_html = '';


 foreach ($datanya as $key => $kurs) {
   $table_html .= '
      <tr class="indexing">
          <td class="kurs-responsive text-center isi-kurs" style="height:50px; background-color:#1E88BC !important">
              <span style="margin-left:-10px;">
                  <img src="assets/image/flag/'.strtolower($kurs['country']) .'.png" class="flag-icon" width="18">
                  <b>'.$kurs['country'] . ' ' . $kurs['type'].'</b>
              </span>
          </td>
          <td class="kurs-responsive text-center isi-kurs">
              <b style="font-size:1.2em;">'. number_format($kurs['bank_buy'], 2) .'</b>
          </td>
          <td class="kurs-responsive text-center isi-kurs">
              <b style="font-size:1.2em;">'. number_format($kurs['bank_sell'], 2) .'</b>
          </td>
      </tr>

      ';



  $iterasi--;
  }

    if ($iterasi){
      for ($i=1;$i<=$iterasi;$i++){
      $table_html .= '<tr><td class="kurs-responsive text-center isi-kurs" style="height:50px;"></td><td class="kurs-responsive text-center isi-kurs"></td><td class="kurs-responsive text-center isi-kurs"></td></tr>';
    }

  }

$next_page = $page+1;

if ($next_page > $total_pages) {
  $next_page = 1;
}
$response = (object) array(
  'next_page'=>$next_page,
  'table_html'=>$table_html
);

print_r(json_encode($response));

?>
