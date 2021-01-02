<?php
include './upload.php';
require('../../class/class.Penjual.php');

$currentNama = '';
$currentEmail = '';
$currentTelepon = '';
$currentAlamat = '';
$currentDescription = '';
$currentPhoto = '';

if (isset($_GET['IDpenjual'])) {
  $Penjual = new Penjual();
  $Penjual->IDpenjual = $_GET['IDpenjual'];
  $Penjual->getPenjual();

  $currentNama = $Penjual->nama;
  $currentEmail = $Penjual->email;
  $currentTelepon = $Penjual->telepon;
  $currentAlamat = $Penjual->alamat;
  $currentDescription = $Penjual->deskripsi;
  $currentPhoto = $Penjual->foto;
}

if (isset($_POST["save-profile"])) {
  $inputName = $_POST["profile-name"];
  $inputPhoto = $_FILES["photoProfile"];
  $inputEmail = $_POST["email"];
  $inputTelepon = $_POST["telepon"];
  $inputDescription = $_POST["description"];
  $inputAddress = $_POST["alamat"];
  $uploaded = array("Choose your file before submit", 0);

  if ($inputPhoto["name"] != '') {
    $target_dir = "../../uploads/";
    $target_file = $target_dir . basename($currentPhoto);

    $uploaded = addFile($inputPhoto);
    $currentPhoto = $inputPhoto["name"];

    if (file_exists($target_file)) {
      unlink($target_file);
    }
  } else if ($currentPhoto != '') {
    $uploaded[1] = 1;
  }


  if ($uploaded[1] == 1) {
    $Penjual = new Penjual();
    $Penjual->IDpenjual = $_SESSION["IDpenjual"];
    $Penjual->nama = $inputName;
    $Penjual->email = $inputEmail;
    $Penjual->telepon = $inputTelepon;
    $Penjual->foto = $currentPhoto;
    $Penjual->deskripsi = $inputDescription;
    $Penjual->alamat = $inputAddress;

    $Penjual->UpdatePenjual();


    if ($Penjual->result) {
      echo "<script> alert('$Penjual->message'); </script>";
      echo '<script> window.location="dashboard.php"; </script>';
    }
  } else {
    echo "<script> alert('$uploaded[0]')</script>";
  }
}

?>
<div class="container-profile">
  <div class="profile-section">
    <h2 class="profile-heading">Profile</h2>

    <form action="#" method="post" enctype="multipart/form-data">
      <div>
        <div class="profile-img">
          <?php
          if (isset($_GET["IDpenjual"])) {
            echo '<section class="current-photo-section">';
            echo '    <img src="../../uploads/' . $currentPhoto . '" alt="Menu">';
            echo '    <span>' . $currentPhoto . '</span>';
            echo '</section>';
          }
          ?>
          <section class="menu-photo-section">
            <label for="photoProfile">Pilih foto menu:</label>
            <input type="file" id="photoProfile" name="photoProfile" accept="image/*">
          </section>
        </div>

        <div class="profile-info">
          <section class="profile-name-section">
            <label for="profile-name">Nama Toko</label>
            <input type="text" id="profile-name" name="profile-name" placeholder="Budi" autocomplete="profile-name" value="<?php echo $currentNama ?>" required autofocus />
          </section>

          <section class="telpon-section">
            <label for="telepon">Nomer Telepon</label>
            <input type="tel" id="telepon" name="telepon" placeholder="+62" autocomplete="telepon" required autofocus value="<?php echo $currentTelepon ?>" />
          </section>

          <section class=" profile-email-section">
            <label for="email">Email</label>
            <input id="email" name="email" rows="5" placeholder="Email" required value="<?php echo $currentEmail ?>" />
          </section>

          <section class="profile-description-section">
            <label for="description">Deksripsi Toko</label>
            <textarea id="description" name="description" rows="5" placeholder="Deskripsi menu" required><?php echo trim($currentDescription) ?></textarea>
          </section>

          <section class="profile-alamat-section">
            <label for="alamat">Alamat Toko</label>
            <textarea id="alamat" name="alamat" rows="5" placeholder="Alamat" required><?php echo trim($currentAlamat) ?></textarea>
          </section>
        </div>
      </div>

      <input type="submit" id="save-profile" name="save-profile" value="Submit" />
    </form>
  </div>
</div>