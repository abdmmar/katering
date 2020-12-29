<?php

class Menu extends Connection
{
  public $IDKategori = 0;
  public $namakategori = '';
  public $menuID = '';

  public $result = false;
  public $message = '';

  public $TABLE_KATEGORI = 'kategori';
  public $COLUMN_IDKATEGORI = 'IDKategori';
  public $COLUMN_NAMAKATEGORI = 'namakategori';
  public $COLUMN_MENUID = 'menuID';

  public function addKategori()
  {
    $this->connect();
    $sql = "INSERT INTO $this->TABLE_KATEGORI
            ($this->COLUMN_NAMAKATEGORI, $this->COLUMN_MENUID) 
            VALUES ('$this->namakategori', $this->menuID)";

    $this->result = mysqli_query($this->connection, $sql);

    if ($this->result) {
      $this->message = 'Kategori berhasil ditambahkan';
    } else {
      $this->message = 'Kategori gagal ditambahkan';
    }

    return $this->connection->insert_id;
  }

  public function deleteMenu()
  {
    $this->connect();
    $sql = "DELETE FROM $this->TABLE_MENU WHERE $this->COLUMN_MENUID=$this->menuID";
    $this->result = mysqli_query($this->connection, $sql);

    if ($this->result) {
      $this->message = 'Menu berhasil dihapus';
    } else {
      $this->message = 'Menu gagal dihapus';
    }
  }

  public function updateMenu()
  {
    $this->connect();
    $sql = "UPDATE $this->TABLE_MENU
        SET $this->COLUMN_NAMA = '$this->nama',
            $this->COLUMN_DESKRIPSI = '$this->deskripsi',
            $this->COLUMN_GAMBAR = '$this->gambar',
            $this->COLUMN_HARGA = $this->harga,
            $this->COLUMN_IDPENJUAL = $this->IDpenjual
        WHERE $this->COLUMN_MENUID = $this->menuID";

    $this->result = mysqli_query($this->connection, $sql);

    if ($this->result)
      $this->message = 'Data berhasil diubah';
    else
      $this->message = 'Data gagal diubah';
  }

  public function getMenu()
  {
    $this->connect();
    $sql = "SELECT * FROM $this->TABLE_MENU WHERE $this->COLUMN_MENUID=$this->menuID";
    $result = mysqli_query($this->connection, $sql);

    if (mysqli_num_rows($result) == 1) {
      $this->result = true;
      $data = mysqli_fetch_assoc($result);
      $this->nama = $data[$this->COLUMN_NAMA];
      $this->deskripsi = $data[$this->COLUMN_DESKRIPSI];
      $this->gambar = $data[$this->COLUMN_GAMBAR];
      $this->harga = $data[$this->COLUMN_HARGA];
      $this->IDpenjual = $data[$this->COLUMN_IDPENJUAL];
    }
  }

  public function getAllMenu()
  {
    $this->connect();
    $sql = "SELECT * FROM $this->TABLE_MENU";
    $result = mysqli_query($this->connection, $sql);
    $arrayMenu = array();
    $count = 0;

    if (mysqli_num_rows($result) > 0) {
      while ($data = mysqli_fetch_array($result)) {
        $Menu = new Menu();
        $Menu->menuID = $data[$this->COLUMN_MENUID];
        $Menu->nama = $data[$this->COLUMN_NAMA];
        $Menu->deskripsi = $data[$this->COLUMN_DESKRIPSI];
        $Menu->gambar = $data[$this->COLUMN_GAMBAR];
        $Menu->harga = $data[$this->COLUMN_HARGA];
        $Menu->IDpenjual = $data[$this->COLUMN_IDPENJUAL];
        $arrayMenu[$count] = $Menu;
        $count++;
      }
    } else {
      $this->message = 'Belum ada menu nih';
    }

    return $arrayMenu;
  }
}
