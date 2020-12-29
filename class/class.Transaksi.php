<?php
class Penjual extends Connection
{
  public $IDPenjual = 0;
  public $IDPembeli = 0;
  public $kodeTransaksi = 0;
  public $tanggalTransaksi = '';
  public $totalHarga = '';

  public $result = false;
  public $message = '';

  public $TABLE_PENJUAL = 'transaksi';
  public $COLUMN_KODETRANSAKSI = 'kodetransaksi';
  public $COLUMN_IDPEMBELI = 'IDPembeli';
  public $COLUMN_IDPENJUAL = 'IDPenjual';
  public $COLUMN_TGLTRANSAKSI = 'tanggal_transaksi';
  public $COLUMN_TOTALHARGA = 'total_harga';
}
