<?php
include './inc.connection.php';
require('./class/class.Menu.php');
?>
<div class="container-dashboard">
  <?php
  if (isset($_GET["search"])) {
    $keyword = $_GET["search"];
    echo "<h4>Hasil pencarian '$keyword':</h4>";
  }
  ?>
  <div class="all-menu">
    <?php
    $Menu = new Menu();
    $listMenu = $Menu->getAllMenu();

    if (isset($_GET["search"])) {
      $keyword = $_GET["search"];
      $listMenu = $Menu->getMenuByKeyword($keyword);
    }

    foreach ($listMenu as $menu) {
      echo '<div class="menu-item">';
      echo '  <img src="./uploads/' . $menu->gambar . '" alt="' . $menu->nama . '">';
      echo '  <div class="menu-item-info pembeli">';
      echo "    <h4>$menu->nama</h4>";
      echo '    <p class="label-harga">';
      echo '      <strong>Rp<span class="harga">' . $menu->harga . '</span></strong>';
      echo '    </p>';
      echo '    <div class="menu-action pembeli">';
      echo '     <a href="#">';
      echo '        <button>';
      echo '          <svg data-src="https://s.svgbox.net/hero-outline.svg?ic=plus" width="18" height="18" stroke="currentColor"></svg>';
      echo '          <span>';
      echo '            Keranjang';
      echo '          </span>';
      echo '        </button>';
      echo '      </a>';
      echo '     </div>';
      echo '  </div>';
      echo "</div>";
    }

    ?>
  </div>
</div>