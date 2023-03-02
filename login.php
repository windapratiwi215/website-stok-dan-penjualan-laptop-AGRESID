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

//tambahkan pengguna ke database
if (isset($_POST["login"])) {
  $username = $_POST["username"];
  $password = $_POST["password"];

  $result = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");

  //cek username
  if (mysqli_num_rows($result) === 1) {
    $row = mysqli_fetch_assoc($result);
    //cek status
    if ($row["status"] == 1) {
      //cek password         
      if ($password == $row["password"]) {
        //set session
        $_SESSION["login"] = true;
        $_SESSION["username"] = $row["username"];
        $_SESSION["id_user"] = $row["id"];
        $_SESSION["jabatan"] = $row["jabatan"];
        $_SESSION["akses"] = $row["akses"];

        header("Location: index.php");
        exit;
      }
      $error = true;
    }
    $errorConfirm = true;
  }
  $userNotExist = true;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>
    Agres ID - Login
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
            <p class="text-lead text-white">Silakan masuk untuk melanjutkan.</p>
          </div>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row mt-lg-n10 mt-md-n11 mt-n10 justify-content-center">
        <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
          <div class="card z-index-0">
            <div class="card-header text-center pt-4 pb-0">
              <h5>Masuk</h5>
            </div>
            <div class="card-body mb-3">
              <form method="POST">
                <?php if (isset($error)) : ?>
                  <div class="card-text text-danger text-center font-size-md" style="color: red;"><em>Password Anda salah!</em></div>
                  <?php unset($errorConfirm); ?>
                  <?php unset($userNotExist); ?>
                  <br>
                <?php endif; ?>
                <?php if (isset($errorConfirm)) : ?>
                  <div class="card-text text-danger text-center font-size-md" style="color: red;"><em>User belum dikonfirmasi oleh Master</em></div>
                  <?php unset($userExist); ?>
                  <br>
                <?php endif; ?>
                <?php if (isset($userNotExist)) : ?>
                  <div class="card-text text-danger text-center font-size-md" style="color: red;"><em>Username tidak terdaftar!</em></div>
                  <br>
                <?php endif; ?>
                <div class="mb-3">
                  <input type="text" class="form-control form-round" placeholder="Username" name="username">
                </div>
                <div class="mb-3">
                  <input type="password" class="form-control form-round" placeholder="Password" name="password">
                </div>
                <div class="text-center">
                  <input type="submit" name="login" class="btn btn-round bg-gradient-dark w-100 my-4 mb-2" value="Masuk">
                </div>
                <p class="text-sm mt-3 mb-0">Anda belum memliki akun? <a href="signup.php" class="text-dark font-weight-bolder">Registrasi</a></p>
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