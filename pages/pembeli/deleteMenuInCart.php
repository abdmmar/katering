<?php

require('../../class/class.DetailTransaksi.php');

if (isset($_GET['kodeTransaksi']) && isset($_GET['menuID'])) {
  $DetailTransaksi = new DetailTransaksi();
  $DetailTransaksi->kodeTransaksi = $_GET['kodeTransaksi'];
  $DetailTransaksi->menuID = $_GET['menuID'];

  $DetailTransaksi->deleteMenu();

  echo "<script> alert('$DetailTransaksi->message'); </script>";
  echo "<script> window.location = 'dashboard.php?p=cart' </script>";
} else {
  echo '<script> window.history.back() </script>';
}
