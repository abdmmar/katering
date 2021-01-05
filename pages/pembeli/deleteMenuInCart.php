<?php

require('../../class/class.Menu.php');
require('../../class/class.Transaksi.php');
require('../../class/class.DetailTransaksi.php');

if (isset($_GET['kodeTransaksi']) && isset($_GET['menuID'])) {
  $menuID = $_GET['menuID'];
  $kodeTransaksi = $_GET['kodeTransaksi'];
  $DetailTransaksi = new DetailTransaksi();
  $DetailTransaksi->kodeTransaksi = $kodeTransaksi;
  $DetailTransaksi->menuID = $menuID;
  $DetailTransaksi->deleteMenu();

  $Menu = new Menu();
  $Menu->menuID = $menuID;
  $Menu->getMenu();

  $Transaksi = new Transaksi();
  $Transaksi->IDpembeli = $_SESSION["IDpembeli"];
  $Transaksi->getOneTransaction();

  $Transaksi->totalHarga = $Transaksi->totalHarga - ($Menu->harga * $DetailTransaksi->jmlMenu);
  $Transaksi->updateTransacationTotalPrice();

  echo "<script> alert('$DetailTransaksi->message'); </script>";
  echo "<script> window.location = 'dashboard.php?p=cart' </script>";
} else {
  echo '<script> window.history.back() </script>';
}
