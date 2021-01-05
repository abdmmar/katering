<?php
require('../../class/class.Menu.php');
require('../../class/class.Transaksi.php');
require('../../class/class.DetailTransaksi.php');

$arrayMenu = array();
$totalHarga = 0;

if (isset($_SESSION["IDpembeli"])) {
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
      <h2>Keranjang Belanja</h2>
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
            echo '    <form method="post" class="item-increment">';
            echo '      <button class="btn-minus">';
            echo '        <svg data-src="https://s.svgbox.net/hero-outline.svg?ic=minus&fill=ffffff" width="18" height="18"></svg>';
            echo '      </button>';
            echo '        <input type="number" min="1" class="total" value="' . $menuItem->jmlMenu . '" readonly/>';
            echo '      <button class="btn-plus">';
            echo '        <svg data-src="https://s.svgbox.net/hero-outline.svg?ic=plus&fill=ffffff" width="18" height="18"></svg>';
            echo '      </button>';
            echo '    </form>';
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
            Rp<span class="harga"><?php echo $totalHarga ?></span>
          </strong>
        </p>
      </div>
      <a href="dashboard.php?p=checkout">
        <button class="beli">
          <strong>Beli</strong>
        </button>
      </a>
    </div>
  </div>
</div>
<script type="text/javascript">
  const item = document.querySelectorAll(".item");
  const btnMinus = document.querySelectorAll(".btn-minus");
  const btnPlus = document.querySelectorAll(".btn-plus");
  let jmlMenu = document.querySelectorAll(".total");
  const btnDelete = document.querySelectorAll(".btn-delete");
  const dataToDelete = document.querySelectorAll(".btn-delete a");

  for (let i = 0; i < item.length; i++) {
    btnMinus[i].addEventListener("click", function(e) {
      e.preventDefault();
      if (jmlMenu[i].value > 1) {
        jmlMenu[i].value--;
      }
    });

    btnPlus[i].addEventListener("click", function(e) {
      e.preventDefault();
      jmlMenu[i].value++;
    });
  }

  for (let i = 0; i < btnDelete.length; i++) {
    btnDelete[i].addEventListener("click", function() {
      const isSure = confirm("Are you sure want to delete this item?");
      if (isSure) {
        const menuID = dataToDelete[i].dataset.menuid;
        const kodeTransaksi = dataToDelete[i].dataset.transaksi;
        window.location = `dashboard.php?p=deleteMenuInCart&menuID=${menuID}&kodeTransaksi=${kodeTransaksi}`;
      }

    });
  }
</script>