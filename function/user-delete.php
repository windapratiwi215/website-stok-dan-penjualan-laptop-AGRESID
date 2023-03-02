<?php
session_start();

if (!isset($_SESSION["login"])) {
  header("Location: login-registrasi.php");
  exit;
}
require 'database-conn.php';

$id = $_GET["id"];
function userDelete($id)
{
  global $conn;
  mysqli_query($conn, "SET FOREIGN_KEY_CHECKS = 0	");
  mysqli_query($conn, "DELETE FROM users WHERE id=$id");

  return mysqli_affected_rows($conn);
}

if (userDelete($id) > 0) {
  echo "
    <script>
    sessionStorage.setItem('cekUser','deleteyes');
    document.location.href = '../menu-user.php';
    </script>
    ";
} else {
  echo "
    <script>
    sessionStorage.setItem('cekUser','deleteno');
    document.location.href = '../menu-user.php';
    </script>
    ";
}
?>