<?php
require '../../vendor/autoload.php';
require_once('../../class/class.Mail.php');
require_once('../../class/class.Transaksi.php');
require_once('../../class/class.Pembeli.php');

if (isset($_SESSION["IDpenjual"]) and isset($_GET['kodeTransaksi'])) {
  $Transaksi = new Transaksi();
  $Transaksi->kodeTransaksi = $_GET["kodeTransaksi"];
  $Transaksi->IDpenjual = $_SESSION["IDpenjual"];
  $Transaksi->status = 'finish';
  $Transaksi->updateTransacationStatusByPenjual();

  if ($Transaksi->result) {
    $message =  file_get_contents('../../mail/template_email.php');
    $header = "Pesanan Selesai!";
    $body = 'Terima kasih telah berbalanja di Hena Katering!';
    $url = 'localhost/katering';

    $Pembeli = new Pembeli();
    $Pembeli->IDpembeli = $_GET["IDpembeli"];
    $Pembeli->getUser();

    $nama = $Pembeli->nama;
    $email = $Pembeli->email;

    $message = str_replace("{EMAIL_TITLE}", $header, $message);
    $message = str_replace("{EMAIL_BODY}", $body, $message);
    $message = str_replace("{TO_NAME}", $nama, $message);
    $message = str_replace("{CUSTOM_URL}", $url, $message);

    //Send payment successfull to email 
    $objMail = new Mail();
    $objMail->SendMail($email, $nama, $header, $message);
    echo "<script> alert('Pesanan berhasil diselesaikan'); </script>";
    echo '<script> window.location="dashboard.php?p=transaction"; </script>';
  } else {
    echo '<script> window.history.back() </script>';
  }
} else {
  echo '<script> window.history.back() </script>';
}
