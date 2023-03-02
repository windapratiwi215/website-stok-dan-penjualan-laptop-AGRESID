<?php 
session_start();

if(!isset($_SESSION["login"])){
    header("Location: login-registrasi.php");
    exit;

}
require 'database-conn.php';

function penjualanEdit(){
  global $conn;
  $id = $_POST["id_penjualan"];
  $tgl= $_POST["tgl_jual"];
  $kode = $_POST["kode"];
  $nota= $_POST["nota_jual"];


  mysqli_query($conn, "SET FOREIGN_KEY_CHECKS = 0	");	
  $query = "UPDATE tabel_penjualan SET tgl_terjual='$tgl', kode_toko='$kode', nota_penjualan='$nota'
            WHERE id_penjualan=$id
          ";
  mysqli_query($conn, $query);

  return mysqli_affected_rows($conn);
}

if(penjualanEdit()>0){
  echo "
  <script>
  sessionStorage.setItem('cekJual','edityes');
  document.location.href = '../menu-penjualan.php';
  </script>
  ";
} else {
echo "
  <script>
  sessionStorage.setItem('cekJual','editno');
  document.location.href = '../menu-penjualan.php';
  </script>
  ";
}
?>