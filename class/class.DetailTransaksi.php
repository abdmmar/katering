<?php
class DetailTransaksi extends Connection
{
  public $menuID = 0;
  public $kodeTransaksi = 0;
  public $jmlMenu = 0;

  public $result = false;
  public $message = '';

  public $TABLE_DETAILTRANSAKSI = 'detail_transaksi';
  public $COLUMN_MENUID = 'menuID';
  public $COLUMN_KODETRANSAKSI = 'kodetransaksi';
  public $COLUMN_JMLMENU = 'jmlmenu';
}
