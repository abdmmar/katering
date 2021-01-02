<?php
class Transaksi extends Connection
{
  public $IDpenjual = 0;
  public $IDpembeli = 0;
  public $kodeTransaksi = 0;
  public $tanggalTransaksi = '';
  public $totalHarga = '';

  public $result = false;
  public $message = '';

  public $TABLE_TRANSAKSI = 'transaksi';
  public $COLUMN_KODETRANSAKSI = 'kodetransaksi';
  public $COLUMN_IDPEMBELI = 'IDpembeli';
  public $COLUMN_IDPENJUAL = 'IDpenjual';
  public $COLUMN_TGLTRANSAKSI = 'tanggal_transaksi';
  public $COLUMN_TOTALHARGA = 'total_harga';
}
