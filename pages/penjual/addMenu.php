<?php
include './upload.php';
require('../../class/class.Menu.php');

if (isset($_POST["add-menu"])) {
    $inputName = $_POST["menu-name"];
    $inputFile = $_FILES["photoMenu"];
    $inputDescription = $_POST["description"];
    $inputCategory = $_POST["category"];
    $inputPrice = $_POST["price"];

    $uploaded = addFile($inputFile);
    $Menu = new Menu();

    if ($uploaded[1] == 1) {
        $Menu->nama = $inputName;
        $Menu->gambar = $inputFile["name"];
        $Menu->deskripsi = $inputDescription;
        $Menu->harga = $inputPrice;
        $Menu->IDpenjual = $_SESSION["IDPenjual"];
        $Menu->addMenu();

        if ($Menu->result) {
            echo "<script> alert('Menu berhasil ditambahkan'); </script>";
            echo '<script> window.location="dashboardPenjual.php"; </script>';
        }
    } else {
        echo "<script> alert($uploaded[0])</script>";
    }
}

?>
<div class="container-penjual">
    <div class="penjual-container">
        <h2 class="menu-heading">Tambah Menu</h2>

        <form action="#" method="post" enctype="multipart/form-data">

            <section class="menu-photo-section">
                <label for="photo-menu">Pilih foto menu:</label>
                <input type="file" id="photoMenu" name="photoMenu" accept="image/*">
            </section>

            <section class="menu-name-section">
                <label for="menu-name">Nama Menu</label>
                <input type="text" id="menu-name" name="menu-name" placeholder="Mie Ayam" autocomplete="menu-name" required autofocus />
            </section>

            <section class="menu-description-section">
                <label for="description">Deksripsi</label>
                <textarea id="description" name="description" rows="5" placeholder="Deskripsi menu" required></textarea>
            </section>


            <section class="menu-category-section">
                <label for="category">Kategori</label>
                <input type="text" id="category" name="category" placeholder="Misal: Minuman, Makananan, dll" autocomplete="category" required autofocus />
            </section>

            <section class="menu-price-section">
                <label for="price">Harga</label>
                <input type="number" id="price" name="price" placeholder="Rp100.000" autocomplete="price" required autofocus />
            </section>

            <input type="submit" id="add-menu" name="add-menu" value="Submit" />
        </form>
    </div>
</div>