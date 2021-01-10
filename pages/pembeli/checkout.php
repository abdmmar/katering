<?php
require('../../class/class.Pembeli.php');
require('../../class/class.Menu.php');
require('../../class/class.Transaksi.php');
require('../../class/class.DetailTransaksi.php');
require('../../class/class.Alamat.php');

$arrayMenu = array();
$totalHarga = 0;

if (isset($_SESSION["IDpembeli"]) && isset($_GET["kodeTransaksi"])) {
  $Transaksi = new Transaksi();
  $Transaksi->IDpembeli = $_SESSION["IDpembeli"];
  $Transaksi->getOneTransaction();
  if ($Transaksi->status == 'inChart') {
    $DetailTransaksi = new DetailTransaksi();
    $DetailTransaksi->kodeTransaksi = $Transaksi->kodeTransaksi;
    $arrayMenu = $DetailTransaksi->getAllMenuByKodeTransaksi();

    $totalHarga = $Transaksi->totalHarga;
  }
}

$jmlMenu = 1;
?>
<div class="container-cart">
  <div>
    <div class="list-item-container">
      <h2>Checkout</h2>
      <h3>Alamat</h3>
      <div class="alamat-container">
        <?php
        if (isset($_SESSION["IDpembeli"])) {
          $IDpembeli = $_SESSION["IDpembeli"];
          $Pembeli = new Pembeli();
          $Pembeli->IDpembeli = $IDpembeli;
          $Pembeli->getUser();

          $Alamat = new Alamat();
          $Alamat->IDpembeli = $IDpembeli;
          $Alamat->getAlamat();

          echo '<h4>' . $Pembeli->nama . '</h4>';
          echo '<span>' . $Pembeli->telepon . '</span>';
          echo '<p class="alamat">' . $Alamat->alamat . '</p>';
        }
        ?>
        <button>Pilih Alamat</button>
      </div>
      <h3>List Menu</h3>
      <div class="list-item">
        <?php
        if ($arrayMenu > 0) {
          foreach ($arrayMenu as $menuItem) {
            $Menu = new Menu();
            $Menu->menuID = $menuItem->menuID;
            $Menu->getMenu();

            echo '<div class="item" id="' . $Menu->menuID . '">';
            echo ' <img src="../../uploads/' . $Menu->gambar . '" alt="Menu">';
            echo '  <div class="item-info">';
            echo '    <p>' . $Menu->nama . '</p>';
            echo '    <p class="label-harga">';
            echo '      <strong>';
            echo '        Rp<span class="harga">' . $Menu->harga . '</span>';
            echo '      </strong>';
            echo '    </p>';
            echo '    <div class="jmlMenu">' . $menuItem->jmlMenu . '</div>';
            echo '  </div>';
            echo '  <div class="btn-delete">';
            echo '    <a class="icon" data-menuid="' . $Menu->menuID . '" data-transaksi="' . $menuItem->kodeTransaksi . '" href="#">';
            echo '      <svg data-src="https://s.svgbox.net/hero-outline.svg?ic=trash&fill=767676" width="24" height="24"></svg>';
            echo '    </a>';
            echo '  </div>';
            echo '</div>';
          }
        } else {
          echo '<div class="empty-list-item">';
          echo '  <h3>Keranjangmu masih kosong nih!</h3>';
          echo '  <a href="dashboard.php"><- Kembali ke dashboard</a>';
          echo '</div>';
        };
        ?>
      </div>
    </div>
    <div class="shopping-summary">
      <h3>Ringkasan Belanja</h3>
      <div class="total-price">
        <div class="label">Total Harga</div>
        <p class="label-harga">
          <strong>
            Rp<span class="total-harga"><?php echo $totalHarga ?></span>
          </strong>
        </p>
      </div>
      <button class="bayar">
        <strong>Bayar</strong>
      </button>
    </div>
  </div>
</div>
</div>