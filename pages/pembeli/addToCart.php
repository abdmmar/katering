<?php
include '../../inc.connection.php';
require('../../class/class.Menu.php');
require('../../class/class.Transaksi.php');
require('../../class/class.DetailTransaksi.php');

if (isset($_POST["IDpenjual"])) {
  $menuID = $_POST["menuID"];
  $IDpenjual = $_POST["IDpenjual"];
  $IDpembeli = $_POST["IDpembeli"];

  $Menu = new Menu();
  $Menu->menuID = $menuID;
  $Menu->getMenu();

  $Transaksi = new Transaksi();
  $Transaksi->IDpembeli = $IDpembeli;
  $Transaksi->getOneTransaction();

  if ($Transaksi->status == 'inChart') {
    $DetailTransaksi = new DetailTransaksi();
    $DetailTransaksi->menuID = $menuID;
    $DetailTransaksi->menuID = $Transaksi->kodeTransaksi;
    $DetailTransaksi->getMenu();

    if ($DetailTransaksi->result) {
      echo "<script> alert('Menu sudah ada di keranjang'); </script>";
      echo '<script> window.location="dashboard.php"; </script>';
    } else {
      $DetailTransaksi = new DetailTransaksi();
      $DetailTransaksi->menuID = $menuID;
      $DetailTransaksi->kodeTransaksi = $Transaksi->kodeTransaksi;
      $DetailTransaksi->addDetailTransaction();

      $totalHarga = $Transaksi->totalHarga + $Menu->harga;
      $Transaksi->totalHarga = $totalHarga;
      $Transaksi->updateTransacationTotalPrice();
    }

    if ($DetailTransaksi->result) {
      echo "<script> alert('$DetailTransaksi->message'); </script>";
      echo '<script> window.location="dashboard.php?p=cart"; </script>';
    }
  } else {
    $Transaksi = new Transaksi();
    $Transaksi->IDpembeli = $IDpembeli;
    $Transaksi->IDpenjual = $IDpenjual;
    $Transaksi->totalHarga = $Menu->harga;
    $Transaksi->status = 'inChart';
    $kodeTransaksi = $Transaksi->addTransaction();

    $DetailTransaksi = new DetailTransaksi();
    $DetailTransaksi->kodeTransaksi = $kodeTransaksi;
    $DetailTransaksi->menuID = $menuID;
    $DetailTransaksi->addDetailTransaction();

    if ($DetailTransaksi->result) {
      echo "<script> alert('$DetailTransaksi->message'); </script>";
      echo '<script> window.location="dashboard.php?p=cart"; </script>';
    }
  }
} else {
  echo '<script> window.location = "dashboard.php";</script>';
}
