<?php 
session_start();

if(!isset($_SESSION["login"])){
    header("Location: login-registrasi.php");
    exit;

}
require 'database-conn.php';

function userReqAccept($id){
  global $conn;
  mysqli_query($conn, "UPDATE users SET akses = '2' WHERE id=$id");

  return mysqli_affected_rows($conn);
}

$id = $_GET["id"];

if(userReqAccept($id)>0){
  echo "
  <script>
  sessionStorage.setItem('cekUser','accyes');
  document.location.href = '../menu-user.php';
  </script>
  ";
} else {
echo "
  <script>
  sessionStorage.setItem('cekUser','accno');
  document.location.href = '../menu-user.php';
  </script>
  ";
}
?>