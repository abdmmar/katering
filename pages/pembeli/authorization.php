<?php
if (!isset($_SESSION)) {
  session_start();
}

if (isset($_SESSION["IDpenjual"])) {
  echo '<script> window.location="../penjual/dashboard.php"; </script>';
}

if (!isset($_SESSION["IDpembeli"])) {
  echo "<script> alert('Silakan Login untuk mengakses halaman ini'); </script>";
  echo '<script> window.location="../../index.php"; </script>';
}
