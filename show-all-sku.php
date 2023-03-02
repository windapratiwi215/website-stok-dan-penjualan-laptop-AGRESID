<?php
session_start();

if (!isset($_SESSION["login"])) {
  header("Location: login.php");
  exit;
}
require 'function/database-conn.php';

$users = query("SELECT * FROM users  where status ='0' ORDER BY id DESC");
$newUsers = query("SELECT * FROM users where status ='0' ORDER BY id DESC");
$newSKU = query("SELECT * FROM tabel_sku where status ='0' ");
$requestAcc = query("SELECT * FROM users where akses ='1' ");

if (isset($_GET['clear'])) {

  $result = mysqli_query($conn, "UPDATE tabel_sku SET status='1' WHERE status='0'");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>
    Agres ID - SKU Baru
  </title>
  <?php require 'include/head-master-dasboard.php' ?>
</head>

<body class="g-sidenav-show bg-gray-100">
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
        <div class="col-lg mb-lg-0 mb-4">
          <div class="card h-100">
            <div class="row pb-3">
              <div class="col-md-6 pb-0 pt-3 ps-5 bg-transparent">
                <h5 class="text-capitalize mb-0">Daftar SKU Baru</h5>
              </div>
              <div class="col-md-6 d-flex pt-3 pe-5 ps-5 justify-content-end">
                <form method='get'>
                  <input type="submit" name="clear" id="btn" class="btn btn-sm btn-round btn-danger" value="Clear All Notification">
                </form>
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
                    <?php foreach ($newSKU as $row) : ?>
                      <tr>
                        <td><?= $i ?></td>
                        <td><?= $row["sku"] ?> </td>
                        <td><?= $row["item"] ?> </td>
                        <td>
                          <a href="#" data-bs-toggle="modal" data-bs-target="#editSKU<?php echo $row['id_sku']; ?>" class="d-sm-inline-block btn btn-xs btn-round btn-success">
                            <i class="fas fa-edit fa-sm text-white"></i></a>
                          <!-- Modal Edit User (terpisah karena perlu dibuat per data) -->
                          <?php require 'include/edit-sku-modal.php'; ?>


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

  <?php require 'include/change-color-modal.php'; ?>
</body>

</html>