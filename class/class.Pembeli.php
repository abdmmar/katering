<?php

class Pembeli extends Connection
{
  public $IDpembeli = 0;
  public $nama = '';
  public $email = '';
  public $telepon = '';
  public $password = '';

  public $result = false;
  public $message = '';

  public $TABLE_PEMBELI = 'pembeli';
  public $COLUMN_IDPEMBELI = 'IDpembeli';
  public $COLUMN_NAMA = 'nama';
  public $COLUMN_EMAIL = 'email';
  public $COLUMN_TELEPON = 'telepon';
  public $COLUMN_PASSWORD = 'password';

  public function ValidateEmailUser($inputEmail)
  {
    $this->connect();

    $sql = "SELECT * FROM $this->TABLE_PEMBELI 
            WHERE $this->COLUMN_EMAIL = '$inputEmail'";

    $result = mysqli_query($this->connection, $sql);

    if (mysqli_num_rows($result) == 1) {
      $this->result = true;
      $data = mysqli_fetch_assoc($result);
      $this->IDpembeli = $data['IDpembeli'];
      $this->nama = $data['nama'];
      $this->email = $data['email'];
      $this->password = $data['password'];
      $this->telepon = $data['telepon'];
    }
  }

  public function addUser()
  {
    $this->connect();
    $sql = "INSERT INTO $this->TABLE_PEMBELI
            ($this->COLUMN_NAMA, $this->COLUMN_EMAIL, 
            $this->COLUMN_TELEPON, $this->COLUMN_PASSWORD)
            VALUES ('$this->nama', '$this->email', 
            '$this->telepon', '$this->password')";

    $this->result = mysqli_query($this->connection, $sql);

    if ($this->result) {
      $this->message = 'Data berhasil ditambahkan';
    } else {
      $this->message = 'Data gagal ditambahkan';
    }

    return $this->connection->insert_id;
  }

  public function UpdateUser()
  {
    $this->connect();
    $sql = "UPDATE $this->TABLE_PEMBELI
                    SET $this->COLUMN_NAMA = '$this->nama',
                        $this->COLUMN_EMAIL = '$this->email',
                        $this->COLUMN_PASSWORD = '$this->password',
                        $this->COLUMN_TELEPON = '$this->telepon'
                    WHERE $this->COLUMN_IDPEMBELI = '$this->IDpembeli'";

    $this->result = mysqli_query($this->connection, $sql);

    if ($this->result)
      $this->message = 'Data berhasil diubah';
    else
      $this->message = 'Data gagal diubah';
  }

  public function DeleteUser()
  {
    $this->connect();
    $sql = "DELETE FROM $this->TABLE_PEMBELI WHERE $this->COLUMN_IDPEMBELI = $this->IDpembeli";
    $this->result = mysqli_query($this->connection, $sql);

    if ($this->result)
      $this->message = 'Data berhasil dihapus';
    else
      $this->message = 'Data gagal dihapus';
  }

  public function getUser()
  {
    $this->connect();
    $sql = "SELECT * FROM $this->TABLE_PEMBELI WHERE $this->COLUMN_IDPEMBELI = $this->IDpembeli";
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
