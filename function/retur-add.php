<?php
session_start();

if (!isset($_SESSION["login"])) {
  header("Location: login-registrasi.php");
  exit;
}
require 'database-conn.php';

function returAdd()
{
  global $conn;
  if ($_POST["serial_number1"] != "") {
    $serial_number = $_POST["serial_number1"];
  } else if ($_POST["serial_number2"] != "") {
    $serial_number = $_POST["serial_number2"];
  } else {
    $serial_number = "";
  }
  $tgl_retur = $_POST["tgl_retur"];

  $cek_sn = mysqli_query($conn, "SELECT * FROM stok where serial_number='$serial_number'");

  if (mysqli_num_rows($cek_sn) == 0) {
    echo "
    <script>
    sessionStorage.setItem('cekJual','snno');
    document.location.href = '../menu-penjualan.php';
    </script>
  ";
  }

  foreach ($cek_sn as $row) {
    $tanggal = $tgl_retur;
    $ket = $row["ket"];
    $sn = $row["serial_number"];
    $sku = $row["sku"];
    $id_user = $_SESSION["id_user"];

    $cek_id_masuk = mysqli_query($conn, "SELECT id_masuk FROM stok WHERE serial_number = '$sn'");
    $cek = mysqli_fetch_row($cek_id_masuk);
    $id_masuk = $cek[0];

    mysqli_query($conn, "SET FOREIGN_KEY_CHECKS = 0 ");
    // Buat query Insert
    mysqli_query($conn, "INSERT INTO retur_barang VALUES('','$tanggal', '$ket', '$sn', '$sku', '$id_user','$id_masuk')");
    // hapus stok yang dijual
    mysqli_query($conn, "DELETE FROM stok WHERE	serial_number='$sn'");
  }
  return mysqli_affected_rows($conn);
}

if (returAdd() > 0) {
  echo "
  <script>
  sessionStorage.setItem('cekRetur','addyes');
  document.location.href = '../menu-retur.php';
  </script>
  ";
} else {
  echo "
  <script>
  sessionStorage.setItem('cekRetur','addno');
  document.location.href = '../menu-retur.php';
  </script>
  ";
}
