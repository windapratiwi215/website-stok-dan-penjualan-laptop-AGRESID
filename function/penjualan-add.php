<?php
session_start();

if (!isset($_SESSION["login"])) {
  header("Location: login-registrasi.php");
  exit;
}
require 'database-conn.php';

function penjualanAdd()
{
  global $conn;
  if ($_POST["serial_number1"] != "") {
    $serial_number = $_POST["serial_number1"];
  } else if ($_POST["serial_number2"] != "") {
    $serial_number = $_POST["serial_number2"];
  } else {
    $serial_number = "";
  }

  $tgl_jual = $_POST["tgl_jual"];
  $lokasi_terjual = $_POST["kode"];
  $nota_jual = $_POST["nota_jual"];

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
    $tanggal = $tgl_jual;
    $kode = $lokasi_terjual;
    $notajual = $nota_jual;
    $notabeli = $row["no_nota"];
    $sn = $row["serial_number"];
    $ket = $row["ket"];
    $sku = $row["sku"];
    $id_user = $_SESSION["id_user"];

    $cek_id_masuk = mysqli_query($conn, "SELECT id_masuk FROM stok WHERE serial_number = '$sn'");
    $cek = mysqli_fetch_row($cek_id_masuk);
    $id_masuk = $cek[0];

    mysqli_query($conn, "SET FOREIGN_KEY_CHECKS = 0	");
    // Buat query Insert
    mysqli_query($conn, "INSERT INTO tabel_penjualan VALUES('','$tanggal', '$kode', '$notajual', '$notabeli', '$sn', '$ket', '$sku', '$id_user', '$id_masuk')");
    // hapus stok yang dijual
    mysqli_query($conn, "DELETE FROM stok WHERE	serial_number='$sn'");
  }
  return mysqli_affected_rows($conn);
}

if (penjualanAdd() > 0) {
  echo "
  <script>
  sessionStorage.setItem('cekJual','addyes');
  document.location.href = '../menu-penjualan.php';
  </script>
  ";
} else {
  echo "
  <script>
  sessionStorage.setItem('cekJual','addno');
  document.location.href = '../menu-penjualan.php';
  </script>
  ";
}
