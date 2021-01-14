<?php
require('../../class/class.Menu.php');
require('../../class/class.Transaksi.php');
require('../../class/class.DetailTransaksi.php');

$arrayMenu = array();
$totalHarga = 0;
$kodeTransaksi = 0;

if (isset($_SESSION["IDpembeli"])) {
  $Transaksi = new Transaksi();
  $Transaksi->IDpembeli = $_SESSION["IDpembeli"];
  $Transaksi->getOneTransaction();
  if ($Transaksi->status == 'inChart') {
    $DetailTransaksi = new DetailTransaksi();
    $DetailTransaksi->kodeTransaksi = $Transaksi->kodeTransaksi;
    $kodeTransaksi = $Transaksi->kodeTransaksi;
    $arrayMenu = $DetailTransaksi->getAllMenuByKodeTransaksi();

    $totalHarga = $Transaksi->totalHarga;
  }
}

if (isset($_POST["beli"])) {
  $currTotalHarga = $_POST["curr-total-harga"];
  $totalMenu = $_POST["total-menu"];
  $arrTotalMenu = explode(",", $totalMenu);
  $result = false;

  for ($i = 0; $i < count($arrayMenu); $i++) {
    $DetailTransaksi = new DetailTransaksi();
    $DetailTransaksi->kodeTransaksi = $arrayMenu[$i]->kodeTransaksi;
    $DetailTransaksi->menuID = $arrayMenu[$i]->menuID;
    $DetailTransaksi->jmlMenu = $arrTotalMenu[$i];
    $DetailTransaksi->updateJumlahMenu();
    $result = $DetailTransaksi->result;
  }

  if ($result) {
    $Transaksi = new Transaksi();
    $Transaksi->IDpembeli = $_SESSION["IDpembeli"];
    $Transaksi->kodeTransaksi = $kodeTransaksi;
    $Transaksi->totalHarga = $currTotalHarga;
    $Transaksi->updateTransacationTotalPrice();

    if ($Transaksi->result) {
      echo '<script> window.location="dashboard.php?p=checkout&kodeTransaksi=' . $kodeTransaksi . '"; </script>';
    } else {
      echo "<script> alert('Transaksi gagal di checkout'); </script>";
    }
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
        if (sizeof($arrayMenu) > 0) {
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
            echo '        <input type="number" min="1" class="total" value="' . $menuItem->jmlMenu . '"/>';
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
            Rp<span class="total-harga"><?php echo $totalHarga ?></span>
          </strong>
        </p>
      </div>
      <form action="" method="post">
        <input type="hidden" class="curr-total-harga" name="curr-total-harga" value="<?php echo $totalHarga ?>">
        <input type="hidden" class="total-menu" name="total-menu" value="">
        <input type="submit" name="beli" class="beli" value="Beli">
        </input>
      </form>
    </div>
  </div>
</div>
<script type="text/javascript">
  const item = document.querySelectorAll(".item");
  const hargaItem = document.querySelectorAll(".item .harga");

  const btnMinus = document.querySelectorAll(".btn-minus");
  const btnPlus = document.querySelectorAll(".btn-plus");
  const btnDelete = document.querySelectorAll(".btn-delete");
  const dataToDelete = document.querySelectorAll(".btn-delete a");
  const beli = document.querySelector(".beli");

  const totalMenu = document.querySelector(".total-menu");
  const currTotalHarga = document.querySelector(".curr-total-harga");

  let jmlMenu = document.querySelectorAll(".total");
  const arrTotalMenu = [];


  if (parseInt(currTotalHarga.value) === 0) {
    console.log(true);
    beli.disabled = true;
  }

  for (let i = 0; i < item.length; i++) {

    arrTotalMenu[i] = jmlMenu[i].value;

    if (item.length < 1) {
      totalMenu.value = arrTotalMenu.join("");
    }
    totalMenu.value = arrTotalMenu.join(",");

    btnMinus[i].addEventListener("click", function(e) {
      e.preventDefault();
      if (jmlMenu[i].value > 1) {
        const totalHarga = document.querySelector(".total-harga");

        //Set total menu
        jmlMenu[i].value--;
        arrTotalMenu[i] = jmlMenu[i].value;

        let totalHargaInt = parseInt(totalHarga.textContent);
        totalHargaInt -= parseInt(hargaItem[i].textContent);

        totalHarga.textContent = `${totalHargaInt}`;
        currTotalHarga.value = `${totalHargaInt}`;
        totalMenu.value = arrTotalMenu.join(",");
      }
    });

    btnPlus[i].addEventListener("click", function(e) {
      e.preventDefault();
      const totalHarga = document.querySelector(".total-harga");
      let totalHargaInt = parseInt(totalHarga.textContent);

      jmlMenu[i].value++;
      arrTotalMenu[i] = jmlMenu[i].value;

      totalHargaInt += parseInt(hargaItem[i].textContent);
      totalHarga.textContent = `${totalHargaInt}`;
      currTotalHarga.value = `${totalHargaInt}`;

      totalMenu.value = arrTotalMenu.join(",");
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