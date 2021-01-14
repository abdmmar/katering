<?php
require('../../class/class.Transaksi.php');
require('../../class/class.DetailTransaksi.php');

$transaksiList = array();
if (isset($_SESSION["IDpembeli"])) {
  $Transaksi = new Transaksi();
  $Transaksi->IDpembeli = $_SESSION["IDpembeli"];
  $transaksiList = $Transaksi->getAllFinishTransactionPembeli();
}
?>
<div class="container-report">
  <div class="report">
    <h3>
      Transaksi
    </h3>
    <table>
      <thead>
        <tr class="header">
          <th>Kode Transaksi</th>
          <th>Tanggal Transaksi</th>
          <th>Pembeli</th>
          <th>Alamat</th>
          <th>List Menu</th>
          <th>Total </th>
          <th>Status </th>
        </tr>
      </thead>
      <tbody>
        <?php
        if (sizeof($transaksiList) > 0) {
          foreach ($transaksiList as $key => $transaksi) {
            echo '<tr class="transaction-item" id="' . $key . '">';
            echo '<td>' . $transaksi->kodeTransaksi . '</td>';
            echo '<td>' . $transaksi->tanggalTransaksi . '</td>';
            echo '<td>' . $transaksi->IDpembeli . '</td>';
            echo '<td>Margonda, Depok</td>';

            echo '<td class="tr-item-list-menu">';
            echo '  <ul>';

            $DetailTransaksi = new DetailTransaksi();
            $DetailTransaksi->kodeTransaksi = $transaksi->kodeTransaksi;
            $arrayMenu = $DetailTransaksi->getAllMenuByKodeTransaksi();
            foreach ($arrayMenu as $key => $menu) {
              echo '    <li>' . $menu->menuID . '</li>';
            }

            echo '  </ul>';
            echo '</td>';
            echo '<td>';
            $formatter = new NumberFormatter('in_ID',  NumberFormatter::CURRENCY);
            echo $formatter->formatCurrency($transaksi->totalHarga, 'IDR') . PHP_EOL;
            echo '</td>';
            echo '<td>';
            echo 'Selesai';
            echo '</td>';
            echo '</tr>';
          }
        } else {
          echo '<tr><td colspan="8" style="text-align:center;"><h3>Belum ada transaksi yang selesai nih!</h3></td></tr>';
        }
        ?>
      </tbody>
    </table>
  </div>
</div>