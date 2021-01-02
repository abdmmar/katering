<?php
include './upload.php';
require('../../class/class.Pembeli.php');
require('../../class/class.Alamat.php');

$currentNama = '';
$currentTelepon = '';
$currentEmail = '';
$currentAddress = '';
$currentPhoto = '';

if (isset($_GET['IDpembeli'])) {
  $Pembeli = new Pembeli();
  $Pembeli->IDpembeli = $_GET['IDpembeli'];
  $Pembeli->getUser();

  $Alamat = new Alamat();
  $Alamat->IDpembeli = $Pembeli->IDpembeli;
  $Alamat->getAlamat();

  $currentNama = $Pembeli->nama;
  $currentTelepon = $Pembeli->telepon;
  $currentEmail = $Pembeli->email;
  $currentAddress = $Alamat->alamat;
  $currentPhoto = '';
}

if (isset($_POST["save-profile"])) {
  $inputName = $_POST["profile-name"];
  $inputPhoto = $_FILES["photoProfile"];
  $inputEmail = $_POST["email"];
  $inputTelepon = $_POST["telepon"];
  $inputAddress = $_POST["alamat"];
  $uploaded = array("Choose your file before submit", 1);

  // if ($inputPhoto["name"] != '') {
  //   $target_dir = "../../uploads/";
  //   $target_file = $target_dir . basename($currentPhoto);

  //   $uploaded = addFile($inputPhoto);
  //   $currentPhoto = $inputPhoto["name"];

  //   if (file_exists($target_file)) {
  //     unlink($target_file);
  //   }
  // } else if ($currentPhoto != '') {
  //   $uploaded[1] = 1;
  // }


  if ($uploaded[1] == 1) {
    $Pembeli = new Pembeli();
    $Pembeli->IDpembeli = $_SESSION["IDpembeli"];
    $Pembeli->nama = $inputName;
    $Pembeli->email = $inputEmail;
    $Pembeli->telepon = $inputTelepon;

    $Alamat = new Alamat();
    $Alamat->IDpembeli = $Pembeli->IDpembeli;
    $Alamat->alamat = $inputAddress;

    $Pembeli->UpdateUser();
    $Alamat->UpdateAlamat();

    if ($Pembeli->result) {
      echo "<script> alert('$Pembeli->message'); </script>";
      echo '<script> window.location="dashboard.php?p=profile&IDpembeli=' . $Pembeli->IDpembeli . '"; </script>';
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
          if (isset($_GET["IDpembeli"])) {
            $srcPhoto = "../../uploads/$currentPhoto";
            $srcText = $currentPhoto;

            if ($currentPhoto == '') {
              $srcPhoto = "../../uploads/Profile placeholder.png";
              $srcText = "Photo doesn't exist";
            }
            echo '<section class="current-photo-section">';
            echo '    <img src="' . $srcPhoto . '" alt="Menu">';
            echo '    <span>' . $srcText . '</span>';
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

          <section class="profile-alamat-section">
            <label for="alamat">Alamat Toko</label>
            <textarea id="alamat" name="alamat" rows="5" placeholder="Alamat" required><?php echo trim($currentAddress) ?></textarea>
          </section>
        </div>
      </div>

      <input type="submit" id="save-profile" name="save-profile" value="Submit" />
    </form>
  </div>
</div>