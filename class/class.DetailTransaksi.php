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

  public function getMenu()
  {
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

  public function getAllMenuByKodeTransaksi()
  {
    $this->connect();
    $sql = "SELECT * FROM $this->TABLE_DETAILTRANSAKSI WHERE $this->COLUMN_KODETRANSAKSI = $this->kodeTransaksi";
    $result = mysqli_query($this->connection, $sql);
    $arrayMenu = array();
    $count = 0;

    if (mysqli_num_rows($result) > 0) {
      while ($data = mysqli_fetch_array($result)) {
        $DetailTransaksi = new DetailTransaksi();
        $DetailTransaksi->menuID = $data[$this->COLUMN_MENUID];
        $DetailTransaksi->kodeTransaksi = $data[$this->COLUMN_KODETRANSAKSI];
        $DetailTransaksi->jmlMenu = $data[$this->COLUMN_JMLMENU];
        $arrayMenu[$count] = $DetailTransaksi;
        $count++;
      }
    } else {
      $this->message = 'Belum ada menu di keranjang nih';
    }

    return $arrayMenu;
  }

  public function deleteMenu()
  {
    $this->connect();
    $sql = "DELETE FROM $this->TABLE_DETAILTRANSAKSI 
    WHERE $this->COLUMN_MENUID=$this->menuID 
    AND $this->COLUMN_KODETRANSAKSI = $this->kodeTransaksi";
    $this->result = mysqli_query($this->connection, $sql);

    if ($this->result) {
      $this->message = 'Menu berhasil dihapus dari keranjang';
    } else {
      $this->message = 'Menu gagal dihapus dari keranjang';
    }
  }
}
