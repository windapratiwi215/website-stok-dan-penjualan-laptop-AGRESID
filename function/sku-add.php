<?php 
session_start();

if(!isset($_SESSION["login"])){
    header("Location: login-registrasi.php");
    exit;

}
require 'database-conn.php';

function skuAdd(){
  global $conn;
  $sku= $_POST["sku"];
  $item= $_POST["item"];

  $query = "INSERT INTO tabel_sku 
            VALUES('', '$sku', 
            '$item', 0)
        ";
  mysqli_query($conn, $query);

  return mysqli_affected_rows($conn);
}

if(skuAdd()>0){
  echo "
  <script>
  sessionStorage.setItem('cekSku','addyes');
  document.location.href = '../menu-sku.php';
  </script>
  ";
} else {
echo "
  <script>
  sessionStorage.setItem('cekSku','addno');
  document.location.href = '../menu-sku.php';
  </script>
  ";
}
?>