<?php
require('../../class/class.Menu.php');
require('../../class/class.Kategori.php');
?>
<div class="container-penjual">
  <div class="container-home-penjual">
    <div class="info-penjual-container">
      <div class="info-penjual">
        <figure>
          <img src="../../uploads/benjamin-henon-ZAucxTNf9bw-unsplash.jpg" alt="Foto Profil Hena Catering">
        </figure>
        <h2>Hena Catering</h2>
        <p class="label">Deskripsi Toko</p>
        <p>Hena Catering adalah</p>
        <p class="label">Kontak</p>
        <p>08123841876</p>
        <p class="label">Alamat Toko</p>
        <p>Jl. Jalan Satu Dua Tiga</p>
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
        <div class="menu-item">
          <img src="../../uploads/benjamin-henon-ZAucxTNf9bw-unsplash.jpg" alt="Menu">
          <div class="menu-item-info">
            <h4>Menu</h4>
            <p class="label-harga">
              <strong>
                Rp
                <span class="harga">
                  50000
                </span>
              </strong>
            </p>
          </div>
          <div class="menu-action">
            <button>
              <a href="dashboard.php">
                <svg data-src="https://s.svgbox.net/hero-outline.svg?ic=pencil" width="18" height="18" stroke="currentColor"></svg>
                <span>
                  Edit
                </span>
              </a>
            </button>
            <button>
              <a href="dashboard.php">
                <svg data-src="https://s.svgbox.net/hero-outline.svg?ic=trash" width="18" height="18" stroke="currentColor"></svg>
                <span>
                  Delete
                </span>
              </a>
            </button>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>