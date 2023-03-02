<?php 
session_start();

if(!isset($_SESSION["login"])){
    header("Location: login-registrasi.php");
    exit;

}
require 'database-conn.php';

function userDelete($id){
  global $conn;
  mysqli_query($conn, "UPDATE users SET akses = '0' WHERE id=$id");

  return mysqli_affected_rows($conn);
}

$id = $_GET["id"];

if(userDelete($id)>0){
  echo "
  <script>
  sessionStorage.setItem('cekUser','denyyes');
  document.location.href = '../menu-user.php';
  </script>
  ";
} else {
echo "
  <script>
  sessionStorage.setItem('cekUser','denyno');
  document.location.href = '../menu-user.php';
  </script>
  ";
}
?>