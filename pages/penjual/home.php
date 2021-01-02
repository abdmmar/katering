<?php
require('../../class/class.Menu.php');
require('../../class/class.Kategori.php');
require('../../class/class.Penjual.php');
?>
<div class="container-penjual">
  <div class="container-home-penjual">
    <div class="info-penjual-container">
      <div class="info-penjual">
        <?php
        $Penjual = new Penjual();
        $Penjual->IDpenjual = $_SESSION["IDpenjual"];
        $Penjual->getPenjual();
        echo '<img src="../../uploads/' . $Penjual->foto . '" alt="Foto Profil Hena Catering">';
        echo "<h2>$Penjual->nama</h2>";
        echo '<p class="label">Deskripsi Toko</p>';
        echo "<p>$Penjual->deskripsi</p>";
        echo '<p class="label">Nomer Telepon</p>';
        echo "<p>$Penjual->telepon</p>";
        echo '<p class="label">Alamat Toko</p>';
        echo "<p>$Penjual->alamat</p>";
        ?>
        <a href="dashboard.php?p=profile&IDpenjual=<?php echo $_SESSION["IDpenjual"] ?>">
          <button>
            Edit Profile
          </button>
        </a>
      </div>
      <div class="kategori-menu">
        <h3>Kategori</h3>
        <ul>
          <li class="selected">Semua Produk</li>
          <?php
          $Kategori = new Kategori();
          $listKategori = $Kategori->getAllKategori();
          foreach ($listKategori as $kategori) {
            echo "<li>$kategori->namakategori</li>";
          }
          ?>
        </ul>
      </div>
    </div>
    <div class="menu-container">
      <div class="header-menu">
        <h3>Semua Menu</h3>
        <div class="filter-urutkan">
          <h4>Urutkan</h4>
          <select name="urutkan" id="urutkan">
            <option value="Terbaru">Terbaru</option>
          </select>
        </div>
      </div>
      <div class="all-menu">
        <?php
        $Menu = new Menu();
        $listMenu = $Menu->getAllMenu();
        foreach ($listMenu as $menu) {
          echo '<div class="menu-item">';
          echo '  <img src="../../uploads/' . $menu->gambar . '" alt="' . $menu->nama . '">';
          echo '  <div class="menu-item-info">';
          echo "    <h4>$menu->nama</h4>";
          echo '    <p class="label-harga">';
          echo '      <strong>Rp<span class="harga">' . $menu->harga . '</span></strong>';
          echo '    </p>';
          echo '  </div>';
          echo '  <div class="menu-action">';
          echo '    <button>';
          echo '      <a href="dashboard.php?p=addMenu&menuID=' . $menu->menuID . '">';
          echo '        <svg data-src="https://s.svgbox.net/hero-outline.svg?ic=pencil" width="18" height="18" stroke="currentColor"></svg>';
          echo '        <span>';
          echo '          Edit';
          echo '        </span>';
          echo '      </a>';
          echo '    </button>';
          echo '    <button>';
          echo '      <a href="dashboard.php?p=deleteMenu&menuID=' . $menu->menuID . '">';
          echo '        <svg data-src="https://s.svgbox.net/hero-outline.svg?ic=trash" width="18" height="18" stroke="currentColor"></svg>';
          echo '        <span>';
          echo '          Delete';
          echo '        </span>';
          echo '      </a>';
          echo '    </button>';
          echo '  </div>';
          echo "</div>";
        }

        ?>

      </div>
    </div>
  </div>
</div>