<?php
session_start();

if (!isset($_SESSION["login"])) {
  header("Location: login-registrasi.php");
  exit;
}
require 'database-conn.php';

function requestAccept($id)
{
  global $conn;
  mysqli_query($conn, "UPDATE users SET akses = '1' WHERE id=$id");

  return mysqli_affected_rows($conn);
}

$id = $_SESSION["id_user"];

if (requestAccept($id) > 0) {
  echo "
  <script>
  sessionStorage.setItem('cekAkses','accsent');
  window.history.back();
  </script>
  ";
} else {
  echo "
  <script>
  sessionStorage.setItem('cekAkses','accnotsent');
  window.history.back();
  </script>
  ";
}
