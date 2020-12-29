<?php
include('../inc.connection.php');
require('../class/class.Penjual.php');
require('../class/class.Pembeli.php');

if (isset($_POST["submit"])) {
  $inputEmail = $_POST["email"];
  $inputPassword = $_POST["current-password"];

  $Penjual = new Penjual();
  $Pembeli = new Pembeli();

  $Penjual->ValidateEmailPenjual($inputEmail);
  $Pembeli->ValidateEmailUser($inputEmail);

  if ($Penjual->result) {

    $isMatch = password_verify($inputPassword, $Penjual->password);

    if ($isMatch) {
      if (!isset($_SESSION)) {
        session_start();
      }

      $_SESSION["nama"] = $Penjual->nama;
      $_SESSION["email"] = $Penjual->email;
      $_SESSION["alamat"] = $Penjual->alamat;
      $_SESSION["telepon"] = $Penjual->telepon;
      $_SESSION["deskripsi"] = $Penjual->deskripsi;
      $_SESSION["IDpenjual"] = $Penjual->IDpenjual;

      echo "<script> alert('Login sukses!'); </script>";
      echo '<script> window.location = "../pages/penjual/dashboard.php"; </script>';
    } else {
      echo "<script> alert('Password tidak match!'); </script>";
    }
  } elseif ($Pembeli->result) {

    $isMatch = password_verify($inputPassword, $Pembeli->password);
    echo $isMatch;

    if ($isMatch) {
      if (!isset($_SESSION)) {
        session_start();
      }

      $_SESSION["IDpembeli"] = $Pembeli->IDPembeli;
      $_SESSION["nama"] = $Pembeli->nama;
      $_SESSION["email"] = $Pembeli->email;

      echo "<script> alert('Login sukses!'); </script>";
      echo '<script> window.location = "../pages/pembeli/dashboard.php"; </script>';
    } else {
      echo "<script> alert('Password tidak match!'); </script>";
    }
  } else {
    echo "<script> alert('Email tidak terdaftar!'); </script>";
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login to Hena Catering</title>
  <link rel="shortcut icon" href="../logo.png" type="image/x-icon" />
  <link rel="stylesheet" href="../style/style.css">
</head>

<body>
  <div class="container">
    <div class="sign-in-container">
      <a href="../index.php">
        <img class="logo-icon" src="../logo.png" alt="Ketring Logo" />
      </a>
      <h2 class="sign-in-heading">Login</h2>

      <form method="post" action="">
        <section class="email-section">
          <label for="email">Email</label>
          <input type="email" id="email" name="email" placeholder="Username@domain.com" autocomplete="email" required autofocus />
        </section>

        <section class="password-section">
          <label for="current-password">Password</label>
          <input id="current-password" class="current-password" name="current-password" type="password" autocomplete="current-password" aria-describedby="password-constraints" placeholder="Password" required />
          <button id="toggle-password" type="button" aria-label="Show password as plain text. Warning: this will display your password on the screen.">
            Show password
          </button>
          <div id="password-constraints">
            Eight or more characters with a mix of letters, numbers and
            symbols.
          </div>
        </section>

        <input type="submit" name="submit" id="login" value="Login" />
      </form>
      <div class="sign-up">
        <p>Don't have an account yet? <a href="register.php">Register</a></p>
      </div>
    </div>
  </div>
  <script src="../script/script.js"></script>
</body>

</html>