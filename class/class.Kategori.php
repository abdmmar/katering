<?php

class Kategori extends Connection
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
            ($this->COLUMN_IDKATEGORI, $this->COLUMN_NAMAKATEGORI, $this->COLUMN_MENUID) 
            VALUES ($this->IDKategori, '$this->namakategori', $this->menuID)";

    $this->result = mysqli_query($this->connection, $sql);

    if ($this->result) {
      $this->message = 'Kategori berhasil ditambahkan';
    } else {
      $this->message = 'Kategori gagal ditambahkan';
    }

    return $this->connection->insert_id;
  }

  public function updateKategori()
  {
    $this->connect();
    $sql = "UPDATE $this->TABLE_KATEGORI
        SET $this->COLUMN_IDKATEGORI = '$this->IDKategori',
            $this->COLUMN_NAMAKATEGORI = '$this->namakategori',
        WHERE $this->COLUMN_MENUID = $this->menuID";

    $this->result = mysqli_query($this->connection, $sql);

    if ($this->result)
      $this->message = 'Kategori berhasil diubah';
    else
      $this->message = 'Kategori gagal diubah';
  }

  public function getKategoriByMenu()
  {
    $this->connect();
    $sql = "SELECT * FROM $this->TABLE_KATEGORI WHERE $this->COLUMN_MENUID=$this->menuID";
    $result = mysqli_query($this->connection, $sql);

    if (mysqli_num_rows($result) == 1) {
      $this->result = true;
      $data = mysqli_fetch_assoc($result);
      $this->IDKategori = $data[$this->COLUMN_IDKATEGORI];
      $this->namakategori = $data[$this->COLUMN_NAMAKATEGORI];
    }
  }

  public function getAllKategori()
  {
    $this->connect();
    $sql = "SELECT DISTINCT $this->COLUMN_IDKATEGORI, $this->COLUMN_NAMAKATEGORI FROM $this->TABLE_KATEGORI";
    $result = mysqli_query($this->connection, $sql);
    $arrayKategori = array();
    $count = 0;

    if (mysqli_num_rows($result) > 0) {
      while ($data = mysqli_fetch_array($result)) {
        $Kategori = new Kategori();
        $Kategori->IDKategori = $data[$this->COLUMN_IDKATEGORI];
        $Kategori->namakategori = $data[$this->COLUMN_NAMAKATEGORI];
        $arrayKategori[$count] = $Kategori;
        $count++;
      }
    } else {
      $this->message = 'Belum ada kategori nih';
    }

    return $arrayKategori;
  }
}
