<?php
session_start();

if (!isset($_SESSION["login"])) {
  header("Location: login.php");
  exit;
}
require 'function/database-conn.php';
$users = query("SELECT * FROM users ORDER BY id DESC");
$newUsers = query("SELECT * FROM users where status ='0' ORDER BY id DESC");
$newSKU = query("SELECT * FROM tabel_sku where status ='0' ");
$requestAcc = query("SELECT * FROM users where akses ='1' ");


if (isset($_POST["save"])) {
  $passwordLama = $_POST["passwordl"];
  $passwordBaru = $_POST["passwordb1"];
  $konfpassBaru = $_POST["passwordb2"];
  $id_user = $_SESSION["id_user"];

  //cek pasword lama
  $ps_lama = mysqli_query($conn, "SELECT password FROM users WHERE id = '$id_user'");

  foreach($ps_lama as $ps){
    $passLama = $ps["password"];
    //cek kesamaan password
    if ($passwordLama == $passLama) {
      //cek pass baru dan konfirmasi pass baru
      if ($passwordBaru == $konfpassBaru) {
        mysqli_query($conn, "UPDATE `users` SET `password`='$passwordBaru' WHERE id='$id_user'");
        header("Location: index.php");
        exit;
      }
      $diffPassword = true;//konfirmsi password salah
    }
    $diffOldPassword = true;//password lama anda salah
  }


}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>
    Agres ID - Setting
  </title>
  <?php require 'include/head-master-dasboard.php'; ?>

</head>

<body class="g-sidenav-show">
  <?php require 'include/preloader.php' ?>
  <div class="min-height-300 gradient-theme position-absolute w-100"></div>

  <!-- Sidebar -->
  <?php require 'include/sidebar.php'; ?>

  <main class="main-content position-relative border-radius-lg ">
    <!-- Navbar -->
    <?php require 'include/navbar-dasboard.php'; ?>
    <!-- End Navbar -->

    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-lg mb-lg-0 ">
          <div class="card h-100">
            <div class="row pb-3">
              <div class="col-12 pb-0 pt-3 ps-5 bg-transparent">
                <h5 class="text-capitalize mb-0">Setting</h5>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row mt-4">
        <div class="col-lg mb-lg-0 mb-4">
          <div class="card h-100">
            <div class="card-header pb-0 pt-3 bg-transparent">
              <h6 class="text-capitalize">Ganti Password</h6>
            </div>
              <?php if (isset($diffPassword)) : ?>
                  <div class="card-text text-danger text-center font-size-md" style="color: red;"><em>Konfirmasi password gagal, silakah cek kembali.</em></div>
                  <?php unset($diffOldPassword); ?>
                  <br>
                <?php endif; ?>
                <?php if (isset($diffOldPassword)) : ?>
                  <div class="card-text text-danger text-center font-size-md" style="color: red;"><em>password lama anda</em></div>
                  <br>
                <?php endif; ?>
            <div class="card-body p-3 ms-1">
              <form method="post" class="col-8">
                <div class="mb-3">
                  <input type="password" class="form-control form-round" placeholder="Password Lama" name="passwordl">
                </div>
                <div class="mb-1">
                  <input type="password" class="form-control form-round" placeholder="Password Baru" name="passwordb1">
                </div>
                <div class="mb-3">
                  <input type="password" class="form-control form-round" placeholder="Konfirmasi Password Baru" name="passwordb2">
                </div>
                <input type="submit" name="save" class="btn btn-round btn-info color-theme color-theme" value="Save">
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="row mt-4 ">
        <div class="col-lg mb-lg-0 mb-4">
          <div class="card h-100">
            <div class="card-header pb-0 pt-3 bg-transparent">
              <h6 class="text-capitalize">Appearance</h6>
            </div>
            <div class="card-body p-3">
              <label class="form-label font-size-xl" for="favcolor">Pilih warna:</label><br>
              <input type="color" class="ms-1" id="favcolor" name="favcolor"><br><br>
              <script>
                document.getElementById("favcolor").value = sessionStorage.getItem('oric');
              </script>
              <input type="button" class="btn btn-round btn-info color-theme color-theme" onclick="change()" value="Apply">
            </div>
          </div>
        </div>
      </div>
      <!-- Footer -->
      <?php require 'include/footer.php'; ?>
    </div>
  </main>
  <!--   Core JS Files   -->
  <?php require 'include/js-file-admin.php'; ?>
  <?php require 'include/js-change-color.php'; ?>
  <!-- Modal-->
  <?php require 'include/logout-modal.php'; ?>

</body>

</html>