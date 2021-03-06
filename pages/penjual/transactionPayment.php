<?php
require '../../vendor/autoload.php';
require_once('../../class/class.Mail.php');
require_once('../../class/class.Transaksi.php');
require_once('../../class/class.Pembeli.php');

if (isset($_SESSION["IDpenjual"]) and isset($_GET['kodeTransaksi'])) {
    $Transaksi = new Transaksi();
    $Transaksi->kodeTransaksi = $_GET["kodeTransaksi"];
    $Transaksi->IDpenjual = $_SESSION["IDpenjual"];
    $Transaksi->status = 'paid';
    $Transaksi->updateTransacationStatusByPenjual();

    if ($Transaksi->result) {
        $message =  file_get_contents('../../mail/template_email.php');
        $header = "Pembayaran Berhasil!";
        $body = 'Selamat! kamu berhasil membayar pesananmu! Sekarang duduk manis dan tunggu pesananmu untuk dibuat dan diantarkan ya!';
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
        echo "<script> alert('Pembayaran berhasil dikonfirmasi'); </script>";
        echo '<script> window.location="dashboard.php?p=transaction"; </script>';
    } else {
        echo '<script> window.history.back() </script>';
    }
} else {
    echo '<script> window.history.back() </script>';
}
