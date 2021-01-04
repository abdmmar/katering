<?php
class DetailTransaksi extends Connection
{
  public $menuID = 0;
  public $kodeTransaksi = 0;
  public $jmlMenu = 1;

  public $result = false;
  public $message = '';

  public $TABLE_DETAILTRANSAKSI = 'detail_transaksi';
  public $COLUMN_MENUID = 'menuID';
  public $COLUMN_KODETRANSAKSI = 'kodetransaksi';
  public $COLUMN_JMLMENU = 'jmlmenu';

  public function addDetailTransaction()
  {
    $this->connect();
    $sql = "INSERT INTO $this->TABLE_DETAILTRANSAKSI
            ($this->COLUMN_MENUID, $this->COLUMN_KODETRANSAKSI, 
            $this->COLUMN_JMLMENU) VALUES ($this->menuID, 
            $this->kodeTransaksi, $this->jmlMenu)";

    $this->result = mysqli_query($this->connection, $sql);

    if ($this->result) {
      $this->message = 'Transaksi berhasil ditambahkan';
    } else {
      $this->message = 'Transaksi gagal ditambahkan';
    }

    return $this->connection->insert_id;
  }

  public function getMenu(){
    $this->connect();
    $sql = "SELECT * FROM $this->TABLE_DETAILTRANSAKSI 
            WHERE $this->COLUMN_MENUID = $this->menuID";

    $result = mysqli_query($this->connection, $sql);

    if (mysqli_num_rows($result) == 1) {
      $this->result = true;
      $data = mysqli_fetch_assoc($result);
      $this->menuID = $data[$this->COLUMN_MENUID];
      $this->kodeTransaksi = $data[$this->COLUMN_KODETRANSAKSI];
      $this->jmlMenu = $data[$this->COLUMN_JMLMENU];
    }
  }
}
