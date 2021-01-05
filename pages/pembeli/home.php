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
      echo '      <form action="./addToCart.php" method="post" class="addToCart">';
      echo '        <input type="hidden" name="menuID" value=' . $menu->menuID . ' />';
      echo '        <input type="hidden" name="IDpenjual" value=' . $menu->IDpenjual . ' />';
      echo '        <input type="hidden" name="IDpembeli" value=' . $_SESSION["IDpembeli"] . ' />';
      echo '        <input type="submit" id="btnAddToCart" name="btnAddToCart" value="+ Keranjang" />';
      echo '      </form>';
      echo '     </div>';
      echo '  </div>';
      echo "</div>";
    }

    ?>
  </div>
</div>