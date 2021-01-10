<?php
include './upload.php';
require('../../class/class.Menu.php');
require('../../class/class.Kategori.php');

$currentName = '';
$currentPicture = '';
$currentDescription = '';
$currentCategory = 0;
$currentPrice = '';
$arrCategory = array(1 => "Makanan", 2 => "Minuman");

if (isset($_GET['menuID'])) {
  $Menu = new Menu();
  $Kategori = new Kategori();

  $Menu->menuID = $_GET['menuID'];
  $Menu->getMenu();

  $Kategori->menuID = $_GET["menuID"];
  $Kategori->getKategoriByMenu();

  $currentName = $Menu->nama;
  $currentPicture = $Menu->gambar;
  $currentDescription = $Menu->deskripsi;
  $currentPrice = $Menu->harga;
  $currentCategory = $Kategori->IDKategori;
}

if (isset($_POST["add-menu"])) {
  $inputName = $_POST["menu-name"];
  $inputFile = $_FILES["photoMenu"];
  $inputDescription = $_POST["description"];
  $inputCategory = $_POST["category"];
  $inputPrice = $_POST["price"];
  $uploaded = array("Choose your file before submit", 0);

  if ($inputFile["name"] != '') {
    $target_dir = "../../uploads/";
    $target_file = $target_dir . basename($currentPicture);

    $uploaded = addFile($inputFile);
    $currentPicture = $inputFile["name"];

    if (isset($_GET["menuID"])) {
      if (file_exists($target_file)) {
        unlink($target_file);
      }
    }
  } else if ($currentPicture != '') {
    $uploaded[1] = 1;
  }

  $Menu = new Menu();
  $Kategori = new Kategori();

  if ($uploaded[1] == 1) {
    $Menu->nama = $inputName;
    $Menu->gambar = $currentPicture;
    $Menu->deskripsi = $inputDescription;
    $Menu->harga = $inputPrice;
    $Menu->IDpenjual = $_SESSION["IDpenjual"];

    $Kategori->namakategori = $arrCategory[$inputCategory];
    $Kategori->IDKategori = $inputCategory;

    if (isset($_GET["menuID"])) {
      $Menu->menuID = $_GET["menuID"];
      $Kategori->menuID = $_GET["menuID"];
      $Menu->updateMenu();
      $Kategori->updateKategori();
    } else {
      $menuID = $Menu->addMenu();

      $Kategori->menuID = $menuID;
      $Kategori->namakategori = $arrCategory[$inputCategory];
      $Kategori->IDKategori = $inputCategory;
      $Kategori->addKategori();
    }

    if ($Menu->result) {
      echo "<script> alert('$Menu->message'); </script>";
      echo '<script> window.location="dashboard.php"; </script>';
    }
  } else {
    echo "<script> alert('$uploaded[0]')</script>";
  }
}

?>
<div class="container-penjual">
  <div class="penjual-container">
    <h2 class="menu-heading">Tambah Menu</h2>

    <form action="#" method="post" enctype="multipart/form-data">
      <?php
      if (isset($_GET["menuID"])) {
        echo '<section class="current-photo-section">';
        echo '    <img src="../../uploads/' . $currentPicture . '" alt="Menu">';
        echo '    <span>' . $currentPicture . '</span>';
        echo '</section>';
      }
      ?>

      <section class="menu-photo-section">
        <label for="photo-menu">Pilih foto menu:</label>
        <input type="file" id="photoMenu" name="photoMenu" accept="image/*">
      </section>

      <section class="menu-name-section">
        <label for="menu-name">Nama Menu</label>
        <input type="text" id="menu-name" name="menu-name" placeholder="Mie Ayam" autocomplete="menu-name" value="<?php echo $currentName ?>" required autofocus />
      </section>

      <section class="menu-description-section">
        <label for="description">Deksripsi</label>
        <textarea id="description" name="description" rows="5" placeholder="Deskripsi menu" required><?php echo trim($currentDescription) ?></textarea>
      </section>

      <section class="menu-category-section">
        <label for="category">Kategori</label>
        <select name="category" id="category">
          <?php
          foreach ($arrCategory as $key => $value) {
            if ($key == $currentCategory) {
              echo '<option value="' . $key . '" selected>' . $value . '</option>';
            } else {
              echo '<option value="' . $key . '">' . $value . '</option>';
            }
          }
          ?>
        </select>
        <!-- <input type="text" id="category" name="category" placeholder="Misal: Minuman, Makananan, dll" value="<?php echo $currentCategory ?>" autocomplete=" category" required autofocus /> -->
      </section>

      <section class="menu-price-section">
        <label for="price">Harga</label>
        <input type="number" id="price" name="price" placeholder="Rp100.000" autocomplete="price" value="<?php echo $currentPrice ?>" required autofocus />
      </section>

      <input type="submit" id="add-menu" name="add-menu" value="Submit" />
    </form>
  </div>
</div>