<?php
include '../inc.connection.php';
require('../class/class.Pembeli.php');
require('../class/class.Alamat.php');
require('../class/class.Mail.php');

if (isset($_POST["register"])) {
  $inputEmail = $_POST["email"];
  $inputPassword = $_POST["current-password"];

  $Pembeli = new Pembeli();
  $Alamat = new Alamat();

  $Pembeli->ValidateEmailUser($inputEmail);

  if ($Pembeli->result) {
    echo "<script> alert('Email sudah terdaftar'); </script>";
  } else {
    $nama = $_POST["nama"];
    $Pembeli->nama = $nama;
    $Pembeli->email = $inputEmail;
    $Pembeli->telepon = $_POST["telepon"];
    $Pembeli->password = password_hash($_POST["current-password"], PASSWORD_DEFAULT);
    $IDPembeli_Alamat = $Pembeli->addUser();

    $Alamat->IDpembeli = $IDPembeli_Alamat;
    $Alamat->alamat = $_POST["alamat"];
    $Alamat->addAlamat();

    if ($Pembeli->result) {
      //Get register email template
      $message =  file_get_contents('template_email_register.php');

      //Set content of email
      $header = "Registrasi berhasil";
      $message = str_replace("{EMAIL_TITLE}", $header, $message);
      $message = str_replace("{TO_NAME}", $nama, $message);

      //Send register notification to email 
      $objMail = new Mail();
      $objMail->SendMail($inputEmail, $nama, 'Registrasi berhasil', $message);

      echo "<script> alert('Registrasi berhasil'); </script>";
      echo '<script> window.location="login.php"; </script>';
    }
  }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register Hena Catering</title>
  <link rel="shortcut icon" href="../logo.png" type="image/x-icon" />
  <link rel="stylesheet" href="../style/style.css">
</head>

<body>
  <div class="container">
    <div class="sign-up-container">
      <a href="../index.php">
        <img class="logo-icon" src="../logo.png" alt="Ketring Logo" />
      </a>
      <h2 class="sign-in-heading">Register</h2>

      <form action="#" method="post">
        <div class="form-group">
          <section class="name-section">
            <label for="name">Name</label>
            <input type="text" id="name" name="nama" placeholder="Budi" autocomplete="name" required autofocus />
          </section>

          <section class="email-section">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Username@domain.com" autocomplete="email" required autofocus />
          </section>
        </div>

        <section class="alamat-section">
          <label for="alamat">Alamat</label>
          <textarea id="alamat" name="alamat" rows="5" placeholder="Alamat" required></textarea>
        </section>

        <div class="form-group">
          <section class="telpon-section">
            <label for="telepon">Nomer Telepon</label>
            <input type="tel" id="telepon" name="telepon" placeholder="+62" autocomplete="telepon" required autofocus />
          </section>

          <section class="password-section">
            <label for="current-password">Password</label>
            <input id="current-password" class="current-password" name="current-password" type="password" autocomplete="current-password" aria-describedby="password-constraints" placeholder="Password" required />
            <button id="toggle-password" type="button" aria-label="Show password as plain text. Warning: this will display your password on the screen.">
              Show password
            </button>
          </section>
        </div>
        <div id="password-constraints">
          Eight or more characters with a mix of letters, numbers and
          symbols.
        </div>

        <button type="submit" id="register" name="register">Register</button>
      </form>
      <div class="sign-up">
        <p>Already have an account? <a href="login.php">Login</a></p>
      </div>
    </div>
  </div>
  <script src="../script/script.js"></script>
</body>

</html>