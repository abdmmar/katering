<?php
class Transaksi extends Connection
{
  public $IDpenjual = 0;
  public $IDpembeli = 0;
  public $kodeTransaksi = 0;
  public $tanggalTransaksi = '';
  public $totalHarga = '';
  public $status = '';

  public $result = false;
  public $message = '';

  public $TABLE_TRANSAKSI = 'transaksi';
  public $COLUMN_KODETRANSAKSI = 'kodetransaksi';
  public $COLUMN_IDPEMBELI = 'IDpembeli';
  public $COLUMN_IDPENJUAL = 'IDpenjual';
  public $COLUMN_TGLTRANSAKSI = 'tanggal_transaksi';
  public $COLUMN_TOTALHARGA = 'total_harga';
  public $COLUMN_STATUS = 'status';

  public function addTransaction()
  {
    $this->connect();
    $sql = "INSERT INTO $this->TABLE_TRANSAKSI
            ($this->COLUMN_IDPEMBELI, $this->COLUMN_IDPENJUAL, 
            $this->COLUMN_TOTALHARGA, $this->COLUMN_STATUS) VALUES ($this->IDpembeli, 
            $this->IDpenjual, $this->totalHarga, '$this->status')";

    $this->result = mysqli_query($this->connection, $sql);

    if ($this->result) {
      $this->message = 'Transaksi berhasil ditambahkan';
    } else {
      $this->message = 'Transaksi gagal ditambahkan';
    }

    return $this->connection->insert_id;
  }

  public function getOneTransaction()
  {
    $this->connect();
    $sql = "SELECT * FROM $this->TABLE_TRANSAKSI 
    WHERE $this->COLUMN_IDPEMBELI = $this->IDpembeli";

    $result = mysqli_query($this->connection, $sql);

    if (mysqli_num_rows($result) == 1) {
      $this->result = true;
      $data = mysqli_fetch_assoc($result);
      $this->kodeTransaksi = $data[$this->COLUMN_KODETRANSAKSI];
      $this->tanggalTransaksi = $data[$this->COLUMN_TGLTRANSAKSI];
      $this->IDpenjual = $data[$this->COLUMN_IDPENJUAL];
      $this->totalHarga = $data[$this->COLUMN_TOTALHARGA];
      $this->status = $data[$this->COLUMN_STATUS];
    }
  }

  public function updateTransacationTotalPrice()
  {
    $this->connect();
    $sql = "UPDATE $this->TABLE_TRANSAKSI
                    SET $this->COLUMN_TOTALHARGA = '$this->totalHarga'
                    WHERE $this->COLUMN_KODETRANSAKSI = '$this->kodeTransaksi'";

    $this->result = mysqli_query($this->connection, $sql);

    if ($this->result)
      $this->message = 'Harga berhasil diubah';
    else
      $this->message = 'Harga gagal diubah';
  }
}
