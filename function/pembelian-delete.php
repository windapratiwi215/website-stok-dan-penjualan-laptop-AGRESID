<?php 
session_start();

if(!isset($_SESSION["login"])){
    header("Location: login-registrasi.php");
    exit;

}
require 'database-conn.php';

function pembelianDelete($id){
  global $conn;
  mysqli_query($conn, "SET FOREIGN_KEY_CHECKS = 0	");
  mysqli_query($conn, "DELETE a.*, b.* FROM barang_masuk a , stok b where a.id_masuk = b.id_masuk AND a.id_masuk= '$id'");

  return mysqli_affected_rows($conn);
}

$id = $_GET["id"];

if(pembelianDelete($id)>0){
  echo "
  <script>
  sessionStorage.setItem('cekBeli','deleteyes');
  document.location.href = '../menu-pembelian.php';
  </script>
  ";
} else {
echo "
  <script>
  sessionStorage.setItem('cekBeli','deleteno');
  document.location.href = '../menu-pembelian.php';
  </script>
  ";
}