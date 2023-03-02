<?php 
session_start();

if(!isset($_SESSION["login"])){
    header("Location: login-registrasi.php");
    exit;

}
require 'database-conn.php';

function userEdit(){
  global $conn;
  $id = $_POST["id"];
  $nama= $_POST["nama"];
  $email= $_POST["email"];
  $jabatan= $_POST["jabatan"];
  $username= $_POST["username"];
  $password= $_POST["password"];

  $query = "UPDATE users SET
           nama = '$nama', 
           email = '$email', 
           jabatan = '$jabatan', 
           username = '$username', 
           password = '$password' 
           WHERE id=$id
        ";
  mysqli_query($conn, $query);

  return mysqli_affected_rows($conn);
}

if(userEdit()>0){
  echo "
  <script>
  sessionStorage.setItem('cekUser','edityes');
  document.location.href = '../menu-user.php';
  </script>
  ";
} else {
echo "
  <script>
  sessionStorage.setItem('cekUser','editno');
  document.location.href = '../menu-user.php';
  </script>
  ";
}
?>