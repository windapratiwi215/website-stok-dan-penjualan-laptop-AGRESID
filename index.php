<?php
session_start();


if (!isset($_SESSION["login"])) {
  header("Location: login.php");
  exit;
}
require 'function/database-conn.php';
$newUsers = query("SELECT * FROM users where status ='0' ORDER BY id DESC");
$newSKU = query("SELECT * FROM tabel_sku where status ='0' ");
$requestAcc = query("SELECT * FROM users where akses ='1' ");
$barang_lama = query("SELECT sku, item, COUNT(sku) FROM stok GROUP BY sku ORDER BY tgl_masuk ASC LIMIT 10");
$barang_baru = query("SELECT sku, item, COUNT(sku) FROM stok GROUP BY sku ORDER BY tgl_masuk DESC LIMIT 10");
$count_barangmasuk = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM barang_masuk WHERE tgl_masuk = CURRENT_DATE"));
$count_stok = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM stok"));
$count_barangkeluar = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM tabel_penjualan WHERE tgl_terjual = CURRENT_DATE"));
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>
    Agres ID - Dashboard
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
      <h2 class="text-white ms-3">
        Selamat Datang
        <?= $_SESSION["username"] ?>!
      </h2>
      <div class="row mt-4">
        <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Barang Masuk Hari Ini</p>
                    <h5 class="font-weight-bolder">
                      <?= $count_barangmasuk ?>
                    </h5>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape gradient-theme text-center rounded-circle">
                    <i class="fas fa-box text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Stok Barang Hari Ini</p>
                    <h5 class="font-weight-bolder">
                      <?= $count_stok ?>
                    </h5>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape gradient-theme text-center rounded-circle">
                    <i class="fas fa-laptop text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Barang Terjual Hari Ini</p>
                    <h5 class="font-weight-bolder">
                      <?= $count_barangkeluar ?>
                    </h5>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape gradient-theme text-center rounded-circle">
                    <i class="fas fa-box-open text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row mt-4">
        <div class="col-lg-12 mb-lg-0 mb-4">
          <div class="card ">
            <div class="card-header pb-0 p-3 color-theme-2">
              <div class="d-flex justify-content-between">
                <h6 class="text-lg mb-3 ms-2">TOP 10 BARANG LAMA</h6>
              </div>
            </div>
            <div class="table-responsive overflow-x-scroll">
              <table class="table align-items-center table-hover">
                <thead bgcolor="#F5F5F5">
                  <tr>
                    <th>
                      <div class="text-center">
                        <h6 class="text-sm mb-0">No</h6>
                      </div>
                    </th>
                    <th>
                      <div class="text-center">
                        <h6 class="text-sm mb-0">SKU</h6>
                      </div>
                    </th>
                    <th>
                      <div class="text-center">
                        <h6 class="text-sm mb-0">Item</h6>
                      </div>
                    </th>
                    <th>
                      <div class="text-center">
                        <h6 class="text-sm mb-0">Qty</h6>
                      </div>
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i = 1 ?>
                  <?php foreach ($barang_lama as $row) : ?>
                    <tr>
                      <td>
                        <div class="text-center">
                          <h6 class="text-sm mb-0"><?= $i ?></h6>
                        </div>
                      </td>
                      <td>
                        <h6 class="text-sm mb-0"><?= $row["sku"] ?></h6>
                      </td>
                      <td>
                        <h6 class="text-sm m  b-0"><?= $row['item'] ?></h6>
                      </td>
                      <td>
                        <div class="col text-center">
                          <h6 class="text-sm mb-0"><?= $row['COUNT(sku)'] ?></h6>
                        </div>
                      </td>
                    </tr>
                    <?php $i++ ?>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <div class="row mt-4">
        <div class="col-lg-12 mb-lg-0 mb-4">
          <div class="card ">
            <div class="card-header pb-0 p-3 color-theme-2">
              <div class="d-flex justify-content-between">
                <h6 class="text-lg mb-3 ms-2">TOP 10 BARANG BARU</h6>
              </div>
            </div>
            <div class="table-responsive overflow-x-scroll">
              <table class="table align-items-center table-hover">
                <thead bgcolor="#F5F5F5">
                  <tr>
                    <th>
                      <div class="text-center">
                        <h6 class="text-sm mb-0">No</h6>
                      </div>
                    </th>
                    <th>
                      <div class="text-center">
                        <h6 class="text-sm mb-0">SKU</h6>
                      </div>
                    </th>
                    <th>
                      <div class="text-center">
                        <h6 class="text-sm mb-0">Item</h6>
                      </div>
                    </th>
                    <th>
                      <div class="text-center">
                        <h6 class="text-sm mb-0">Qty</h6>
                      </div>
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i = 1 ?>
                  <?php foreach ($barang_baru as $row) : ?>
                    <tr>
                      <td>
                        <div class="text-center">
                          <h6 class="text-sm mb-0"><?= $i ?></h6>
                        </div>
                      </td>
                      <td>
                        <h6 class="text-sm mb-0"><?= $row["sku"] ?></h6>
                      </td>
                      <td>
                        <h6 class="text-sm m  b-0"><?= $row['item'] ?></h6>
                      </td>
                      <td>
                        <div class="col text-center">
                          <h6 class="text-sm mb-0"><?= $row['COUNT(sku)'] ?></h6>
                        </div>
                      </td>
                    </tr>
                    <?php $i++ ?>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="container-fluid py-4">
    </div>
  </main>
  <!--   Core JS Files   -->
  <?php require 'include/js-file-admin.php'; ?>
  <!-- Modal-->
  <?php require 'include/logout-modal.php'; ?>


</body>


</html>