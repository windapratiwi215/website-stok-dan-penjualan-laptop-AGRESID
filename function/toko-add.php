<?php 
session_start();

if(!isset($_SESSION["login"])){
    header("Location: login-registrasi.php");
    exit;

}
require 'database-conn.php';

function tokoAdd(){
  global $conn;
  $nama= $_POST["nama"];
  $kode= $_POST["kode"];


  $query = "INSERT INTO toko 
            VALUES('','$nama', '$kode')
        ";
  mysqli_query($conn, $query);

  return mysqli_affected_rows($conn);
}

if(tokoAdd()>0){
  echo "
  <script>
  sessionStorage.setItem('cekToko','addyes');
  document.location.href = '../menu-toko.php';
  </script>
  ";
} else {
echo "
  <script>
  sessionStorage.setItem('cekToko','addno');
  document.location.href = '../menu-toko.php';
  </script>
  ";
}
?>