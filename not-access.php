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

if (!isset($_SESSION["login"])) {
  header("Location: login.php");
  exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>
    Agres ID - Oops!
  </title>
  <?php require 'include/head-master-dasboard.php'; ?>
</head>

<body class="">
  <?php require 'include/preloader.php' ?>
  <main class="main-content mt-0">
    <div class="page-header align-items-start min-vh-50 pt-5 pb-7 m-3 border-radius-lg" style="background-image: url(./assets/img/agres-banner.png); background-position: top;">
      <span class="mask bg-gradient-dark opacity-6"></span>
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-5 text-center mx-auto mt-5">
            <h1 class="text-white mb-2 mt-3">Oops!</h1>
            <p class="text-lead text-white text-lg">
              Anda tidak dapat mengakses halaman ini.
              Halaman ini memiliki batasan hak akses.
              Pastikan Anda login dengan akun yang tepat.
            </p>
            <br>
            <p class="text-lead text-white">
              <a class="text-lead text-white text-decoration-underline" href="login.php">Login</a>
              kembali?
            </p>
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