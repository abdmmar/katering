<?php
if (!isset($_SESSION)) {
  session_start();
}

if (!isset($_SESSION["IDpenjual"]) and !isset($_SESSION["IDpembeli"])) {
  echo "<script> alert('Silakan Login untuk mengakses halaman ini'); </script>";
  echo '<script> window.location="../../index.php"; </script>';
} else if (isset($_SESSION["IDpenjual"])) {
  if ($_SESSION["IDpenjual"] == 0) {
    echo "<script> alert('Hanya admin yang dapat mengakses halaman ini'); </script>";
    echo '<script> window.location="../../index.php"; </script>';
  }
} else if (isset($_SESSION["IDpembeli"])) {
  echo '<script> window.location="../pembeli/dashboard.php"; </script>';
} else {
  echo "<script> alert('Hanya admin yang dapat mengakses halaman ini'); </script>";
  echo '<script> window.location="../../index.php"; </script>';
}
