<?php
include '../inc.connection.php';

class Penjual extends Connection
{
    public $IDPenjual = 0;
    public $nama = '';
    public $email = '';
    public $telepon = '';
    public $password = '';
    public $alamat = '';

    public $result = false;
    public $message = '';

    public $TABLE_PENJUAL = 'penjual';
    public $COLUMN_IDPENJUAL = 'IDPenjual';
    public $COLUMN_NAMA = 'nama';
    public $COLUMN_EMAIL = 'email';
    public $COLUMN_TELEPON = 'telepon';
    public $COLUMN_PASSWORD = 'password';
    public $COLUMN_ALAMAT = 'alamat';

    public function ValidateEmailPenjual($inputEmail)
    {
        $this->connect();

        $sql = "SELECT * FROM $this->TABLE_PENJUAL
            WHERE $this->COLUMN_EMAIL = '$inputEmail'";

        $result = mysqli_query($this->connection, $sql);

        if (mysqli_num_rows($result) == 1) {
            $this->result = true;
            $data = mysqli_fetch_assoc($result);
            $this->IDPenjual = $data['IDPenjual'];
            $this->nama = $data['nama'];
            $this->email = $data['email'];
            $this->password = $data['password'];
            $this->telepon = $data['telepon'];
            $this->alamat = $data['alamat'];
        }
    }

    public function addPenjual()
    {
        $this->connect();
        $sql = "INSERT INTO '$this->TABLE_PENJUAL' 
            ('$this->COLUMN_NAMA', '$this->COLUMN_EMAIL', 
            '$this->COLUMN_TELEPON', '$this->COLUMN_PASSWORD', 
            '$this->COLUMN_ALAMAT')
            VALUES ('$this->name', '$this->email', 
            '$this->telpon', '$this->password', '$this->alamat')";

        $this->result = mysqli_query($this->connection, $sql);

        if ($this->result) {
            $this->message = 'Data berhasil ditambahkan';
        } else {
            $this->message = 'Data gagal ditambahkan';
        }

        return $this->connection->insert_id;
    }

    public function UpdatePenjual()
    {
        $this->connect();
        $sql = "UPDATE '$this->TABLE_PENJUAL'
                    SET $this->COLUMN_NAMA = '$this->nama',
                        $this->COLUM_EMAIL = '$this->email',
                        $this->COLUMN_PASSWORD = '$this->password',
                        $this->COLUMN_TELEPON = '$this->telepon',
                        $this->COLUMN_ALAMAT = '$this->alamat',
                    WHERE $this->COLUMN_IDPENJUAL = '$this->IDPenjual'";

        $this->result = mysqli_query($this->connection, $sql);

        if ($this->result)
            $this->message = 'Data berhasil diubah';
        else
            $this->message = 'Data gagal diubah';
    }

    public function DeletePenjual()
    {
        $this->connect();
        $sql = "DELETE FROM '$this->TABLE_PENJUAL' WHERE '$this->COLUMN_IDPENJUAL' = '$this->IDPenjual'";
        $this->result = mysqli_query($this->connection, $sql);

        if ($this->result)
            $this->message = 'Data berhasil dihapus';
        else
            $this->message = 'Data gagal dihapus';
    }

    public function SelectPenjual()
    {
        $this->connect();
        $sql = "SELECT * FROM '$this->TABLE_PENJUAL' WHERE '$this->COLUMN_IDPENJUAL' = '$this->IDPenjual'";
        $result = mysqli_query($this->connection, $sql);

        if (mysqli_num_rows($result) == 1) {
            $this->result = true;
            $data = mysqli_fetch_assoc($result);
            $this->nama = $data['nama'];
            $this->email = $data['email'];
            $this->password = $data['password'];
            $this->telepon = $data['telepon'];
            $this->alamat = $data['alamat'];
        }
    }
}