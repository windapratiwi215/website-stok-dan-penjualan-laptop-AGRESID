<?php 
session_start();

if(!isset($_SESSION["login"])){
    header("Location: login-registrasi.php");
    exit;

}
require 'database-conn.php';

function userAdd(){
  global $conn;
  $nama= $_POST["nama"];
  $email= $_POST["email"];
  $jabatan= $_POST["jabatan"];
  $username= $_POST["username"];
  $password= $_POST["password"];

  $query = "INSERT INTO users 
            VALUES('','$nama', '$email', 
            '$jabatan', '$username',
            '$password', 0, 0)
        ";
  mysqli_query($conn, $query);

  return mysqli_affected_rows($conn);
}

if(userAdd()>0){
  echo "
  <script>
  sessionStorage.setItem('cekUser','addyes');
  document.location.href = '../menu-user.php';
  </script>
  ";
} else {
echo "
  <script>
  sessionStorage.setItem('cekUser','addno');
  document.location.href = '../menu-user.php';
  </script>
  ";
}
