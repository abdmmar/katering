<?php

class Menu extends Connection
{
    public $menuID = 0;
    public $nama = '';
    public $gambar = '';
    public $deskripsi = '';
    public $harga = 0;
    public $IDpenjual = 0;

    public $result = false;
    public $message = '';

    public $TABLE_MENU = 'menu';
    public $COLUMN_MENUID = 'menuID';
    public $COLUMN_NAMA = 'nama';
    public $COLUMN_DESKRIPSI = 'deskripsi';
    public $COLUMN_GAMBAR = 'gambar';
    public $COLUMN_HARGA = 'harga';
    public $COLUMN_IDPENJUAL = 'IDpenjual';

    public function addMenu()
    {
        $this->connect();
        $sql = "INSERT INTO $this->TABLE_MENU
            ($this->COLUMN_NAMA, $this->COLUMN_DESKRIPSI, $this->COLUMN_GAMBAR, $this->COLUMN_HARGA, $this->COLUMN_IDPENJUAL) 
            VALUES ('$this->nama', '$this->deskripsi', '$this->gambar', $this->harga, $this->IDpenjual)";

        $this->result = mysqli_query($this->connection, $sql);

        if ($this->result) {
            $this->message = 'Data berhasil ditambahkan';
        } else {
            $this->message = 'Data gagal ditambahkan';
        }

        return $this->connection->insert_id;
    }
}
