<?php
session_start();

if (!isset($_SESSION["login"])) {
  header("Location: login.php");
  exit;
}

if ($_SESSION["jabatan"] == "sales") {
  header("Location: not-access.php");
  exit;
}

require 'function/database-conn.php';
$sku = query("SELECT * FROM tabel_sku  ");
$newUsers = query("SELECT * FROM users where status ='0' ORDER BY id DESC");
$newSKU = query("SELECT * FROM tabel_sku where status ='0' ");
$requestAcc = query("SELECT * FROM users where akses ='1' ");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>
    Agres ID - Daftar SKU
  </title>
  <?php require 'include/head-master-dasboard.php'; ?>
</head>

<body class="g-sidenav-show">
  <?php require 'include/preloader.php' ?>
  <?php require 'include/alert/sku.php'?>
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
              <div class="col-md-6 pb-0 pt-3 ps-5 bg-transparent">
                <h5 class="text-capitalize mb-0">Daftar SKU</h5>
              </div>
              <div class="col-md-6 d-flex pt-3 pe-5 ps-5 justify-content-end">
                <a href="#" class="d-sm-inline-block btn btn-round btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#uploadSku">
                  <i class="fas fa-download fa-sm text-dark"></i> Import File</a>&nbsp;
                <a href="#" class="d-sm-inline-block btn btn-round btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#exportSku">
                  <i class="fas fa-upload fa-sm text-dark"></i> Export File</a>&nbsp;
                <a href="#" class="d-sm-inline-block btn btn-round btn-sm btn-info color-theme" data-bs-toggle="modal" data-bs-target="#addSku">
                  <i class="fas fa-plus fa-sm text-white-50"></i> Add New</a>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row mt-4 ">
        <div class="col-lg mb-lg-0 mb-4">
          <div class="card h-100">
            <div class="card-body p-3">
              <div class="table-responsive">
                <table class="table font-size-md text-dark" id="dataUser" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>SKU</th>
                      <th>Item</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $i = 1 ?>
                    <?php foreach ($sku as $row) : ?>
                      <tr>
                        <td><?= $i ?></td>
                        <td><?= $row["sku"] ?> </td>
                        <td><?= $row["item"] ?> </td>
                        <td>

                          <?php $id_user = $_SESSION["id_user"];
                          $ambil_akses = mysqli_query($conn, "SELECT akses FROM users where id = $id_user ");

                          foreach ($ambil_akses as $acc) {
                            $akses_id = $acc["akses"];
                            if ($akses_id == 0) {
                          ?>
                              <a href="#" data-bs-toggle="modal" data-bs-target="#requestAcc" class="d-sm-inline-block btn btn-xs btn-round btn-success">
                                <i class="fas fa-edit fa-sm text-white"></i></a>
                            <?php
                              require 'include/request_access.php';
                            } elseif ($akses_id == 1) {
                            ?>
                              <a href="#" data-bs-toggle="modal" data-bs-target="#waitAcc" class="d-sm-inline-block btn btn-xs btn-round btn-success">
                                <i class="fas fa-edit fa-sm text-white"></i></a>
                            <?php
                              require 'include/wait_access.php';
                            } else {
                            ?>
                              <a href="#" data-bs-toggle="modal" data-bs-target="#editSKU<?php echo $row['id_sku']; ?>" class="d-sm-inline-block btn btn-xs btn-round btn-success">
                                <i class="fas fa-edit fa-sm text-white"></i></a>
                          <?php
                              require 'include/edit-sku-modal.php';
                            }
                          }
                          ?>

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
      <!-- Footer -->
      <?php require 'include/footer.php'; ?>
    </div>
  </main>
  <!--   Core JS Files   -->
  <?php require 'include/js-file-admin.php'; ?>
  <?php require 'include/js-change-color.php'; ?>
  <!-- Modal-->
  <?php require 'include/logout-modal.php'; ?>
  <?php require 'include/upload-sku-modal.php'; ?>
  <?php require 'include/export-sku-modal.php'; ?>
  <?php require 'include/change-color-modal.php'; ?>
  <?php require 'include/add-sku-modal.php'; ?>


</body>


</html>