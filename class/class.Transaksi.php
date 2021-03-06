<?php
class Transaksi extends Connection
{
  public $IDpenjual = 0;
  public $IDpembeli = 0;
  public $kodeTransaksi = 0;
  public $tanggalTransaksi = '';
  public $totalHarga = '';
  public $status = '';

  public $nama = '';
  public $alamat = '';
  public $telepon = '';

  public $result = false;
  public $message = '';
  public $count = 0;

  public $TABLE_TRANSAKSI = 'transaksi';
  public $COLUMN_KODETRANSAKSI = 'kodetransaksi';
  public $COLUMN_IDPEMBELI = 'IDpembeli';
  public $COLUMN_IDPENJUAL = 'IDpenjual';
  public $COLUMN_TGLTRANSAKSI = 'tanggal_transaksi';
  public $COLUMN_TOTALHARGA = 'total_harga';
  public $COLUMN_STATUS = 'status';

  public $COLUMN_NAMA = 'nama';
  public $COLUMN_TELEPON = 'telepon';
  public $COLUMN_ALAMAT = 'alamat';

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
    WHERE $this->COLUMN_IDPEMBELI = $this->IDpembeli ORDER BY $this->COLUMN_KODETRANSAKSI DESC";

    $result = mysqli_query($this->connection, $sql);

    if (mysqli_num_rows($result) > 0) {
      $this->result = true;
      $data = mysqli_fetch_assoc($result);
      $this->kodeTransaksi = $data[$this->COLUMN_KODETRANSAKSI];
      $this->tanggalTransaksi = $data[$this->COLUMN_TGLTRANSAKSI];
      $this->IDpenjual = $data[$this->COLUMN_IDPENJUAL];
      $this->totalHarga = $data[$this->COLUMN_TOTALHARGA];
      $this->status = $data[$this->COLUMN_STATUS];
    }
  }

  public function getOneTransactionInChart()
  {
    $this->connect();
    $sql = "SELECT * FROM $this->TABLE_TRANSAKSI 
    WHERE $this->COLUMN_IDPEMBELI = $this->IDpembeli AND $this->COLUMN_STATUS = 'inChart'";

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

  public function getAllTransactionPayment()
  {
    $this->connect();

    $sql = "SELECT t.kodetransaksi, t.IDpembeli, t.tanggal_transaksi, 
      t.total_harga, t.status, p.nama, p.telepon, a.alamat 
      FROM transaksi AS t INNER JOIN pembeli as p ON p.IDpembeli = t.IDpembeli 
      INNER JOIN alamat_pembeli as a ON a.IDpembeli = p.IDpembeli 
      WHERE t.$this->COLUMN_IDPENJUAL = $this->IDpenjual AND NOT t.$this->COLUMN_STATUS = 'inChart' AND NOT t.$this->COLUMN_STATUS = 'finish'";

    $result = mysqli_query($this->connection, $sql);
    $arrayTransaction = array();
    $count = 0;

    if (mysqli_num_rows($result) > 0) {
      while ($data = mysqli_fetch_array($result)) {
        $Transaksi = new Transaksi();
        $Transaksi->kodeTransaksi = $data[$this->COLUMN_KODETRANSAKSI];
        $Transaksi->IDpembeli = $data[$this->COLUMN_IDPEMBELI];
        $Transaksi->tanggalTransaksi = $data[$this->COLUMN_TGLTRANSAKSI];
        $Transaksi->totalHarga = $data[$this->COLUMN_TOTALHARGA];
        $Transaksi->status = $data[$this->COLUMN_STATUS];
        $Transaksi->nama = $data[$this->COLUMN_NAMA];
        $Transaksi->telepon = $data[$this->COLUMN_TELEPON];
        $Transaksi->alamat = $data[$this->COLUMN_ALAMAT];
        $arrayTransaction[$count] = $Transaksi;
        $count++;
      }
      $this->result = true;
    } else {
      $this->message = 'Belum ada pemesanan nih!';
    }

    return $arrayTransaction;
  }

  public function getAllFinishTransaction()
  {
    $this->connect();
    $sql = "SELECT t.kodetransaksi, t.IDpembeli, t.tanggal_transaksi, 
    t.total_harga, t.status, p.nama, p.telepon, a.alamat 
    FROM transaksi AS t INNER JOIN pembeli as p ON p.IDpembeli = t.IDpembeli 
    INNER JOIN alamat_pembeli as a ON a.IDpembeli = p.IDpembeli 
    WHERE t.$this->COLUMN_IDPENJUAL = $this->IDpenjual AND t.$this->COLUMN_STATUS = 'finish'";

    $result = mysqli_query($this->connection, $sql);
    $arrayTransaction = array();
    $count = 0;

    if (mysqli_num_rows($result) > 0) {
      while ($data = mysqli_fetch_array($result)) {
        $Transaksi = new Transaksi();
        $Transaksi->kodeTransaksi = $data[$this->COLUMN_KODETRANSAKSI];
        $Transaksi->IDpembeli = $data[$this->COLUMN_IDPEMBELI];
        $Transaksi->tanggalTransaksi = $data[$this->COLUMN_TGLTRANSAKSI];
        $Transaksi->totalHarga = $data[$this->COLUMN_TOTALHARGA];
        $Transaksi->status = $data[$this->COLUMN_STATUS];
        $Transaksi->nama = $data[$this->COLUMN_NAMA];
        $Transaksi->telepon = $data[$this->COLUMN_TELEPON];
        $Transaksi->alamat = $data[$this->COLUMN_ALAMAT];
        $arrayTransaction[$count] = $Transaksi;
        $count++;
      }
      $this->result = true;
    } else {
      $this->message = 'Belum ada transaksi yang selesai nih!';
    }

    return $arrayTransaction;
  }

  public function getAllFinishTransactionPembeli()
  {
    $this->connect();
    $sql = "SELECT t.kodetransaksi, t.IDpembeli, t.tanggal_transaksi, 
    t.total_harga, t.status, p.nama, p.telepon, a.alamat 
    FROM transaksi AS t INNER JOIN pembeli as p ON p.IDpembeli = t.IDpembeli 
    INNER JOIN alamat_pembeli as a ON a.IDpembeli = p.IDpembeli 
    WHERE t.$this->COLUMN_IDPEMBELI = $this->IDpembeli AND t.$this->COLUMN_STATUS = 'finish'";

    $result = mysqli_query($this->connection, $sql);
    $arrayTransaction = array();
    $count = 0;

    if (mysqli_num_rows($result) > 0) {
      while ($data = mysqli_fetch_array($result)) {
        $Transaksi = new Transaksi();
        $Transaksi->kodeTransaksi = $data[$this->COLUMN_KODETRANSAKSI];
        $Transaksi->IDpembeli = $data[$this->COLUMN_IDPEMBELI];
        $Transaksi->tanggalTransaksi = $data[$this->COLUMN_TGLTRANSAKSI];
        $Transaksi->totalHarga = $data[$this->COLUMN_TOTALHARGA];
        $Transaksi->status = $data[$this->COLUMN_STATUS];
        $Transaksi->nama = $data[$this->COLUMN_NAMA];
        $Transaksi->telepon = $data[$this->COLUMN_TELEPON];
        $Transaksi->alamat = $data[$this->COLUMN_ALAMAT];
        $arrayTransaction[$count] = $Transaksi;
        $count++;
      }
      $this->result = true;
    } else {
      $this->message = 'Belum ada transaksi yang selesai nih!';
    }

    return $arrayTransaction;
  }

  public function getShipmentTransaction()
  {
    $this->connect();
    $sql = "SELECT t.kodetransaksi, t.IDpembeli, t.tanggal_transaksi, 
    t.total_harga, t.status, p.nama, p.telepon, a.alamat 
    FROM transaksi AS t INNER JOIN pembeli as p ON p.IDpembeli = t.IDpembeli 
    INNER JOIN alamat_pembeli as a ON a.IDpembeli = p.IDpembeli 
    WHERE t.$this->COLUMN_IDPEMBELI = $this->IDpembeli AND t.$this->COLUMN_STATUS = 'paid' OR t.$this->COLUMN_STATUS = 'inDelivery'";

    $result = mysqli_query($this->connection, $sql);
    $arrayTransaction = array();
    $count = 0;

    if (mysqli_num_rows($result) > 0) {
      while ($data = mysqli_fetch_array($result)) {
        $Transaksi = new Transaksi();
        $Transaksi->kodeTransaksi = $data[$this->COLUMN_KODETRANSAKSI];
        $Transaksi->IDpembeli = $data[$this->COLUMN_IDPEMBELI];
        $Transaksi->tanggalTransaksi = $data[$this->COLUMN_TGLTRANSAKSI];
        $Transaksi->totalHarga = $data[$this->COLUMN_TOTALHARGA];
        $Transaksi->status = $data[$this->COLUMN_STATUS];
        $Transaksi->nama = $data[$this->COLUMN_NAMA];
        $Transaksi->telepon = $data[$this->COLUMN_TELEPON];
        $Transaksi->alamat = $data[$this->COLUMN_ALAMAT];
        $arrayTransaction[$count] = $Transaksi;
        $count++;
      }
      $this->result = true;
    } else {
      $this->message = 'Belum ada transaksi yang selesai nih!';
    }

    return $arrayTransaction;
  }

  public function getTransactionPayment()
  {
    $this->connect();
    $sql = "SELECT * FROM $this->TABLE_TRANSAKSI 
    WHERE $this->COLUMN_IDPEMBELI = $this->IDpembeli AND $this->COLUMN_STATUS = 'pendingPayment'";

    $result = mysqli_query($this->connection, $sql);

    if (mysqli_num_rows($result) == 1) {
      $this->result = true;
      $data = mysqli_fetch_assoc($result);
      $this->tanggalTransaksi = $data[$this->COLUMN_TGLTRANSAKSI];
      $this->totalHarga = $data[$this->COLUMN_TOTALHARGA];
      $this->status = $data[$this->COLUMN_STATUS];
    }
  }

  public function getCountTransactionPending()
  {
    $this->connect();
    $sql = "SELECT COUNT(*) as countTransaction 
            FROM $this->TABLE_TRANSAKSI
            WHERE $this->COLUMN_IDPENJUAL = $this->IDpenjual 
            AND $this->COLUMN_STATUS = 'pendingPayment'";

    $this->result = mysqli_query($this->connection, $sql);
    $count = mysqli_fetch_assoc($this->result);
    if ($this->result) {
      return $count['countTransaction'];
    }
  }

  public function updateTransacationTotalPrice()
  {
    $this->connect();
    $sql = "UPDATE $this->TABLE_TRANSAKSI
                    SET $this->COLUMN_TOTALHARGA = $this->totalHarga
                    WHERE $this->COLUMN_KODETRANSAKSI = $this->kodeTransaksi 
                    AND $this->COLUMN_IDPEMBELI = $this->IDpembeli";

    $this->result = mysqli_query($this->connection, $sql);

    if ($this->result)
      $this->message = 'Data berhasil diubah';
    else
      $this->message = 'Data gagal diubah';
  }

  public function updateTransacationStatus()
  {
    $this->connect();
    $sql = "UPDATE $this->TABLE_TRANSAKSI
                    SET $this->COLUMN_STATUS = '$this->status'
                    WHERE $this->COLUMN_KODETRANSAKSI = $this->kodeTransaksi 
                    AND $this->COLUMN_IDPEMBELI = $this->IDpembeli";

    $this->result = mysqli_query($this->connection, $sql);

    if ($this->result)
      $this->message = 'Data berhasil diubah';
    else
      $this->message = 'Data gagal diubah';
  }

  public function updateTransacationStatusByPenjual()
  {
    $this->connect();
    $sql = "UPDATE $this->TABLE_TRANSAKSI
                    SET $this->COLUMN_STATUS = '$this->status'
                    WHERE $this->COLUMN_KODETRANSAKSI = $this->kodeTransaksi 
                    AND $this->COLUMN_IDPENJUAL = $this->IDpenjual";

    $this->result = mysqli_query($this->connection, $sql);

    if ($this->result)
      $this->message = 'Data berhasil diubah';
    else
      $this->message = 'Data gagal diubah';
  }
}
