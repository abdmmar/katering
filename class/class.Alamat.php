<?php

class Alamat extends Connection
{
  public $IDPembeli = 0;
  public $alamat = '';

  public $result = false;
  public $message = '';

  public $TABLE_ALAMAT = 'alamat_pembeli';
  public $COLUMN_IDPEMBELI = 'IDpembeli';
  public $COLUMN_ALAMAT = 'Alamat';

  public function addAlamat()
  {
    $this->connect();
    $sql = "INSERT INTO $this->TABLE_ALAMAT
            ($this->COLUMN_IDPEMBELI, $this->COLUMN_ALAMAT) 
            VALUES ($this->IDPembeli, '$this->alamat')";

    $this->result = mysqli_query($this->connection, $sql);

    if ($this->result) {
      $this->message = 'Data berhasil ditambahkan';
    } else {
      $this->message = 'Data gagal ditambahkan';
    }

    return $this->connection->insert_id;
  }

  public function UpdateAlamat()
  {
    $this->connect();
    $sql = "UPDATE '$this->TABLE_ALAMAT'
                    SET $this->COLUMN_ALAMAT = '$this->alamat'
                    WHERE $this->COLUMN_IDPEMBELI = '$this->IDPembeli'";

    $this->result = mysqli_query($this->connection, $sql);

    if ($this->result)
      $this->message = 'Data berhasil diubah';
    else
      $this->message = 'Data gagal diubah';
  }

  public function DeleteAlamat()
  {
    $this->connect();
    $sql = "DELETE FROM '$this->TABLE_ALAMAT' WHERE '$this->COLUMN_IDPEMBELI' = '$this->IDPembeli'";
    $this->result = mysqli_query($this->connection, $sql);

    if ($this->result)
      $this->message = 'Data berhasil dihapus';
    else
      $this->message = 'Data gagal dihapus';
  }

  public function SelectAlamat()
  {
    $this->connect();
    $sql = "SELECT * FROM '$this->TABLE_ALAMAT' WHERE '$this->COLUMN_IDPEMBELI' = '$this->IDPembeli'";
    $result = mysqli_query($this->connection, $sql);

    if (mysqli_num_rows($result) == 1) {
      $this->result = true;
      $data = mysqli_fetch_assoc($result);
      $this->nama = $data['nama'];
      $this->email = $data['email'];
      $this->password = $data['password'];
      $this->telepon = $data['telepon'];
    }
  }
}
