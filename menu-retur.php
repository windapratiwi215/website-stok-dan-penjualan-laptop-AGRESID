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

$products = query("SELECT retur_barang.*, tabel_sku.item FROM retur_barang INNER JOIN tabel_sku ON retur_barang.sku = tabel_sku.sku ORDER BY retur_barang.tgl_retur DESC");
$newUsers = query("SELECT * FROM users where status ='0' ORDER BY id DESC");
$newSKU = query("SELECT * FROM tabel_sku where status ='0' ");
$requestAcc = query("SELECT * FROM users where akses ='1' ");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>
    Agres ID - Daftar Retur
  </title>
  <?php require 'include/head-master-dasboard.php'; ?>
</head>

<body class="g-sidenav-show bg-gray-100">
  <?php require 'include/preloader.php' ?>
  <?php require 'include/alert/retur.php' ?>
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
                <h5 class="text-capitalize mb-0">Daftar Retur (Barang yang dikembalikan ke pusat)</h5>
              </div>
              <div class="col-md-6 d-flex pt-3 pe-5 ps-5 justify-content-end">
                <a href="#" data-bs-toggle="modal" data-bs-target="#uploadRetur" class="d-sm-inline-block btn btn-round btn-sm btn-light">
                  <i class="fas fa-download fa-sm text-dark"></i> Import File</a>&nbsp;
                <a href="#" data-bs-toggle="modal" data-bs-target="#exportRetur" class="d-sm-inline-block btn btn-round btn-sm btn-light">
                  <i class="fas fa-upload fa-sm text-dark"></i> Export File</a>&nbsp;
                <a href="#" data-bs-toggle="modal" data-bs-target="#addRetur" class="d-sm-inline-block btn btn-round btn-sm btn-info color-theme">
                  <i class="fas fa-plus fa-sm text-white-50"></i> Add New</a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- hide -->
      <div class="row mt-4">
        <div class="col-lg mb-lg">
          <div class="card h-100">
            <div class="card-body p-3 font-size-sm text-dark">
              <div class="form-check form-check-inline ps-0 mb-0">
                <label><input type="checkbox" value="hide" id="tanggal_col" onchange="hide_show_table(this.id);" class="form-check-input align-middle ms-2 me-2" checked>Tanggal Retur</label>
                <label><input type="checkbox" value="hide" id="sn_col" onchange="hide_show_table(this.id);" class="form-check-input align-middle ms-2 me-2" checked>SN</label>
                <label><input type="checkbox" value="hide" id="item_col" onchange="hide_show_table(this.id);" class="form-check-input align-middle ms-2 me-2" checked>Item</label>
                <label><input type="checkbox" value="hide" id="sku_col" onchange="hide_show_table(this.id);" class="form-check-input align-middle ms-2 me-2" checked>SKU</label>
                <label><input type="checkbox" value="hide" id="ket_col" onchange="hide_show_table(this.id);" class="form-check-input align-middle ms-2 me-2" checked>Ket</label>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!--  -->
      <div class="ro mt-4">
        <div class="col-lg mb-lg-0 mb-4">
          <div class="card h-100">
            <div class="card-body p-3">
              <div class="table-responsive">
                <table class="table font-size-md text-dark" id="dataUser" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th id="tanggal_col_head">Tanggal Retur</th>
                      <th id="sn_col_head">SN</th>
                      <th id="item_col_head">Item</th>
                      <th id="sku_col_head">SKU</th>
                      <th id="ket_col_head">Lokasi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $i = 1 ?>
                    <?php foreach ($products as $row) : ?>
                      <tr>
                        <td><?= $i ?></td>
                        <td class="tanggal_col"><?= $row["tgl_retur"] ?> </td>
                        <td class="sn_col"><?= $row["serial_number"] ?> </td>
                        <td class="item_col"><?= $row["item"] ?> </td>
                        <td class="sku_col"><?= $row["sku"] ?> </td>
                        <td class="ket_col"><?= $row["keterangan"] ?> </td>

                      </tr>
                      <?php $i++ ?>
                    <?php endforeach; ?>
                    <!-- javascript untuk hide and show column table -->
                    <script type="text/javascript">
                      function hide_show_table(col_name) {
                        var checkbox_val = document.getElementById(col_name).value;
                        if (checkbox_val == "hide") {
                          var all_col = document.getElementsByClassName(col_name);
                          for (var i = 0; i < all_col.length; i++) {
                            all_col[i].style.display = "none";
                          }
                          document.getElementById(col_name + "_head").style.display = "none";
                          document.getElementById(col_name).value = "show";
                        } else {
                          var all_col = document.getElementsByClassName(col_name);
                          for (var i = 0; i < all_col.length; i++) {
                            all_col[i].style.display = "table-cell";
                          }
                          document.getElementById(col_name + "_head").style.display = "table-cell";
                          document.getElementById(col_name).value = "hide";
                        }
                      }
                    </script>
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
  <?php require 'include/export-retur-modal.php'; ?>
  <?php require 'include/upload-retur-modal.php'; ?>
  <?php require 'include/add-retur-modal.php'; ?>

</body>

</html>