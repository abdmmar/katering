<?php
class DetailTransaksi extends Connection
{
  public $menuID = 0;
  public $kodeTransaksi = 0;
  public $jmlMenu = 1;

  public $nama = '';
  public $harga = 0;

  public $result = false;
  public $message = '';

  public $TABLE_DETAILTRANSAKSI = 'detail_transaksi';
  public $COLUMN_MENUID = 'menuID';
  public $COLUMN_KODETRANSAKSI = 'kodetransaksi';
  public $COLUMN_JMLMENU = 'jmlmenu';
  public $COLUMN_NAMA = 'nama';
  public $COLUMN_HARGA = 'harga';

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
            WHERE $this->COLUMN_MENUID = $this->menuID AND $this->COLUMN_KODETRANSAKSI = $this->kodeTransaksi";

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
    $sql = "SELECT d.*, m.nama, m.harga 
    FROM detail_transaksi as d 
    INNER JOIN menu as m ON m.menuID = d.menuID 
    WHERE d.$this->COLUMN_KODETRANSAKSI = $this->kodeTransaksi";

    $result = mysqli_query($this->connection, $sql);
    $arrayMenu = array();
    $count = 0;

    if (mysqli_num_rows($result) > 0) {
      while ($data = mysqli_fetch_array($result)) {
        $DetailTransaksi = new DetailTransaksi();
        $DetailTransaksi->menuID = $data[$this->COLUMN_MENUID];
        $DetailTransaksi->kodeTransaksi = $data[$this->COLUMN_KODETRANSAKSI];
        $DetailTransaksi->jmlMenu = $data[$this->COLUMN_JMLMENU];
        $DetailTransaksi->nama = $data[$this->COLUMN_NAMA];
        $DetailTransaksi->harga = $data[$this->COLUMN_HARGA];
        $arrayMenu[$count] = $DetailTransaksi;
        $count++;
      }
    } else {
      $this->message = 'Belum ada menu di keranjang nih';
    }

    return $arrayMenu;
  }

  public function updateJumlahMenu()
  {
    $this->connect();
    $sql = "UPDATE $this->TABLE_DETAILTRANSAKSI
    SET $this->COLUMN_JMLMENU = $this->jmlMenu
    WHERE $this->COLUMN_KODETRANSAKSI = $this->kodeTransaksi 
    AND $this->COLUMN_MENUID = $this->menuID";

    $this->result = mysqli_query($this->connection, $sql);

    if ($this->result)
      $this->message = 'Jumlah menu berhasil diubah';
    else
      $this->message = 'Jumlah menu gagal diubah';
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
