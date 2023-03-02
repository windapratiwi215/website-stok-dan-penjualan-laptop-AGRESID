<?php 
session_start();

if(!isset($_SESSION["login"])){
    header("Location: login-registrasi.php");
    exit;

}
require 'database-conn.php';

function userDelete($id){
  global $conn;
  mysqli_query($conn, "SET FOREIGN_KEY_CHECKS = 0	");
  mysqli_query($conn, "DELETE FROM toko WHERE id_toko=$id");

  return mysqli_affected_rows($conn);
}

$id = $_GET["id"];

if(userDelete($id)>0){
  echo "
  <script>
  sessionStorage.setItem('cekToko','deleteyes');
  document.location.href = '../menu-toko.php';
  </script>
  ";
} else {
echo "
  <script>
  sessionStorage.setItem('cekToko','deleteno');
  document.location.href = '../menu-toko.php';
  </script>
  ";
}
?>