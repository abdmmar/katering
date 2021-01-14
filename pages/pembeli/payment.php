<?php
require('../../class/class.Transaksi.php');

$totalPembayaran = 0;

if (isset($_SESSION["IDpembeli"])) {
  $Transaksi = new Transaksi();
  $Transaksi->IDpembeli = $_SESSION["IDpembeli"];
  $Transaksi->getTransactionPayment();
  $totalPembayaran = $Transaksi->totalHarga;
}
?>
<div class="container-cart">
  <div>
    <div class="payment-container">
      <h2>Payment</h2>
      <p>Tinggal satu langkah lagi buat dapetin menu katering yang kamu pesan.</p>

      <div class="jumlah-pembayaran">
        <p>Jumlah yang harus dibayarkan</p>
        <p class="total">
          <span>
            <?php
            if ($totalPembayaran > 0) {
              $formatter = new NumberFormatter('in_ID',  NumberFormatter::CURRENCY);
              echo $formatter->formatCurrency($totalPembayaran, 'IDR') . PHP_EOL;
            }
            ?>
          </span>
        </p>
      </div>

      <p>Silahkan hubungi penjual untuk melakukan pembayaran.</p>
      <div>
        <a href="https://wa.me/6285694550045" target="_blank">
          <button>Hubungi Penjual</button>
        </a>
      </div>
    </div>
  </div>
</div>