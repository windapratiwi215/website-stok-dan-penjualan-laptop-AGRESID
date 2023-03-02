<!--
=========================================================
* Argon Dashboard 2 - v2.0.4
=========================================================

* Product Page: https://www.creative-tim.com/product/argon-dashboard
* Copyright 2022 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://www.creative-tim.com/license)
* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->

<?php

session_start();

require 'function/database-conn.php';

//Register
if (isset($_POST["register"])) {
  $name = $_POST["name"];
  $email = $_POST["email"];
  $jabatan = $_POST["jabatan"];
  $username = $_POST["username"];
  $password = $_POST["pass1"];
  $password2 = $_POST["pass2"];
  $status = $_POST["status"];
  $akses = $_POST["akses"];

  //cek username udah ada atau belum
  $result = mysqli_query($conn, "SELECT username FROM users WHERE username = '$username'");
  if (mysqli_num_rows($result) < 1) {
    if ($password == $password2) {
      mysqli_query($conn, "INSERT INTO users VALUES('','$name', '$email', '$jabatan', '$username','$password', '$status', '$akses')");
      header("Location: index.php");
      exit;
    }
    $diffPassword = true;
  }
  $unameExist = true;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>
    Agres ID - Sign Up
  </title>
  <?php require 'include/head-master-dasboard.php'; ?>
</head>

<body class="">
  <?php require 'include/preloader.php' ?>
  <main class="main-content mt-0">
    <div class="page-header align-items-start min-vh-50 pt-5 pb-11 m-3 border-radius-lg" style="background-image: url(./assets/img/agres-banner.png); background-position: top;">
      <span class="mask bg-gradient-dark opacity-6"></span>
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-5 text-center mx-auto">
            <h1 class="text-white mb-2 mt-3">Selamat Datang!</h1>
            <p class="text-lead text-white">Silakan buat akun untuk melanjutkan.</p>
          </div>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row mt-lg-n10 mt-md-n11 mt-n10 justify-content-center">
        <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
          <div class="card z-index-0">
            <div class="card-header text-center pt-4 pb-0">
              <h5>Registrasi</h5>
            </div>
            <div class="card-body mb-3">
              <form method="POST">
                <?php if (isset($diffPassword)) : ?>
                  <div class="card-text text-danger text-center font-size-md" style="color: red;"><em>Konfirmasi password gagal, silakah cek kembali.</em></div>
                  <?php unset($unameExist); ?>
                  <br>
                <?php endif; ?>
                <?php if (isset($unameExist)) : ?>
                  <div class="card-text text-danger text-center font-size-md" style="color: red;"><em>Username sudah dipakai.</em></div>
                  <br>
                <?php endif; ?>
                <div class="mb-3">
                  <input type="text" class="form-control form-round" placeholder="Nama Lengkap" name="name">
                </div>
                <div class="mb-3">
                  <input type="text" class="form-control form-round" placeholder="Username" name="username">
                </div>
                <div class="mb-3">
                  <input type="email" class="form-control form-round" placeholder="Email" name="email">
                </div>
                <div class="mb-3">
                  <input type="password" class="form-control form-round" placeholder="Password" name="pass1">
                </div>
                <div class="mb-3">
                  <input type="password" class="form-control form-round" placeholder="Konfirmasi Password" name="pass2">
                </div>
                <div class="mb-3">
                  <select class="form-select form-round" name="jabatan" id="jabatan">
                    <option>Pilih Jabatan</option>
                    <option value="Admin">Admin</option>
                    <option value="Sales">Sales</option>
                  </select>
                </div>
                <input type="hidden" name="status" value="0" />
                <input type="hidden" name="akses" value="0" />
                <div class="text-center">
                  <input type="submit" name="register" class="btn btn-round bg-gradient-dark w-100 my-4 mb-2" value="Daftar">
                </div>
                <p class="text-sm mt-3 mb-0">Anda sudah memliki akun? <a href="login.php" class="text-dark font-weight-bolder">Masuk</a></p>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
  <footer class="footer py-3">
    <div class="container">
      <div class="row">
        <div class="col-8 mx-auto text-center mt-1">
          <p class="mb-2 text-secondary font-size-sm">
            Agres ID Yogyakarta
          </p>
        </div>
      </div>
    </div>
  </footer>
</body>

</html>