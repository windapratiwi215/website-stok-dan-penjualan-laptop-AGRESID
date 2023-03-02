<?php 
session_start();

if(!isset($_SESSION["login"])){
    header("Location: login-registrasi.php");
    exit;

}
require 'database-conn.php';

function userAccept($id){
  global $conn;
  mysqli_query($conn, "UPDATE users SET status = '1' WHERE id=$id");

  return mysqli_affected_rows($conn);
}

$id = $_GET["id"];

if(userAccept($id)>0){
  echo "
  <script>
  sessionStorage.setItem('cekUser','confyes');
  document.location.href = '../menu-user.php';
  </script>
  ";
} else {
echo "
  <script>
  sessionStorage.setItem('cekUser','confno');
  document.location.href = '../menu-user.php';
  </script>
  ";
}
?>