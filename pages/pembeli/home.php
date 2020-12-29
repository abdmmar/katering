<?php
require('../../class/class.Menu.php');
?>
<div class="container-dashboard">
  <div class="all-menu">
    <?php
    $Menu = new Menu();
    $listMenu = $Menu->getAllMenu();
    foreach ($listMenu as $menu) {
      echo '<div class="menu-item">';
      echo '  <img src="../../uploads/' . $menu->gambar . '" alt="' . $menu->nama . '">';
      echo '  <div class="menu-item-info pembeli">';
      echo "    <h4>$menu->nama</h4>";
      echo '    <p class="label-harga">';
      echo '      <strong>Rp<span class="harga">' . $menu->harga . '</span></strong>';
      echo '    </p>';
      echo '    <div class="menu-action pembeli">';
      echo '      <button>';
      echo '        <a href="#">';
      echo '          <svg data-src="https://s.svgbox.net/hero-outline.svg?ic=plus" width="18" height="18" stroke="currentColor"></svg>';
      echo '          <span>';
      echo '            Keranjang';
      echo '          </span>';
      echo '        </a>';
      echo '      </button>';
      echo '     </div>';
      echo '  </div>';
      echo "</div>";
    }

    ?>
  </div>
</div>