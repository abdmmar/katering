<?php
require('../../class/class.DetailTransaksi.php');

$transaksiList = array();
if (isset($_SESSION["IDpenjual"])) {
  $Transaksi = new Transaksi();
  $Transaksi->IDpenjual = $_SESSION["IDpenjual"];
  $transaksiList = $Transaksi->getAllTransactionPayment();
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
          <th>Action </th>
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
            echo $transaksi->status;
            echo '</td>';
            echo '<td>';
            switch ($transaksi->status) {
              case 'pendingPayment':
                echo '<button class="transactionPayment" data-pembeli="' . $transaksi->IDpembeli . '" data-transaksi="' . $transaksi->kodeTransaksi . '">Konfirmasi Pembayaran</button>';
                break;
              case 'paid':
                echo '<button class="transactionDelivery" data-pembeli="' . $transaksi->IDpembeli . '" data-transaksi="' . $transaksi->kodeTransaksi . '">Konfirmasi Pengiriman</button>';
                break;
              case 'inDelivery':
                echo '<button class="transactionFinish" data-pembeli="' . $transaksi->IDpembeli . '" data-transaksi="' . $transaksi->kodeTransaksi . '">Selesai</button>';
                break;
              case 'finish':
                echo '<button class="transactionFinish" disabled>Selesai</button>';
                break;
            }
            echo '</td>';
            echo '</tr>';
          }
        } else {
          echo '<tr><td colspan="8" style="text-align:center;"><h3>Belum ada yang mesen nih!</h3></td></tr>';
        }
        ?>
      </tbody>
    </table>
  </div>
</div>
<script>
  const transactionPayment = document.querySelectorAll('.transactionPayment');
  const transactionDelivery = document.querySelectorAll('.transactionDelivery');
  const transactionFinish = document.querySelectorAll('.transactionFinish');

  transactionEvent(transactionPayment, "mengkonfimari pembayaran", "transactionPayment");
  transactionEvent(transactionDelivery, "mengkonfimari pengiriman", "transactionDelivery");
  transactionEvent(transactionFinish, "menyelesaikan", "transactionFinish");

  function transactionEvent(transaction, message, action) {
    for (let i = 0; i < transaction.length; i++) {
      transaction[i].addEventListener("click", () => {
        transactionConfirmation(transaction, message, action, i);
      });
    }
  }

  function transactionConfirmation(transaction, message, action, i) {
    const isSure = confirm(`Apakah anda yakin mau ${message} transaksi ini?`);
    if (isSure) {
      const kodeTransaksi = transaction[i].dataset.transaksi;
      const idPembeli = transaction[i].dataset.pembeli;
      window.location = `dashboard.php?p=${action}&IDpembeli=${idPembeli}&kodeTransaksi=${kodeTransaksi}`;
    }
  }
</script>