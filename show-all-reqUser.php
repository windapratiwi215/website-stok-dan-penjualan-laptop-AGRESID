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
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>
    Agres ID - Konfirmasi User
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
                <h5 class="text-capitalize mb-0">Daftar User</h5>
              </div>
              <div class="col-md-6 d-flex pt-3 pe-5 ps-5 justify-content-end">
                <a href="#" data-toggle="modal" data-target="#uploadUser" class="d-sm-inline-block btn btn-round btn-sm btn-light">
                  <i class="fas fa-download fa-sm text-dark"></i> Import File</a>&nbsp;
                <a href="#" class="d-sm-inline-block btn btn-round btn-sm btn-light">
                  <i class="fas fa-upload fa-sm text-dark"></i> Export File</a>&nbsp;
                <a href="#" class="d-sm-inline-block btn btn-round btn-sm btn-info color-theme">
                  <i class="fas fa-plus fa-sm text-white-50"></i> Add New</a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row mt-4">
        <div class="col-lg mb-lg-0 mb-4">
          <div class="card h-100">
            <div class="card-body p-3">
              <div class="table-responsive">
                <table class="table font-size-md text-dark" id="dataUser" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th id="name_col_head">Nama</th>
                      <th id="email_col_head">Email</th>
                      <th id="username_col_head">Username</th>
                      <th id="password_col_head">Password</th>
                      <th id="jabatan_col_head">Jabatan</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $i = 1 ?>
                    <?php foreach ($users as $row) : ?>
                      <tr>
                        <td><?= $i ?></td>
                        <td class="name_col"><?= $row["nama"] ?> </td>
                        <td class="email_col"><?= $row["email"] ?> </td>
                        <td class="username_col"><?= $row["username"] ?> </td>
                        <td class="password_col">
                          <div class="row ml-2">
                            <input class="show-password" type='password' value=' <?= $row["password"] ?>' disabled=disabled>
                            &nbsp;<div class="toggle"><i class="fa fa-eye"></i></div>
                          </div>
                        </td>
                        <td class="jabatan_col"><?= $row["jabatan"] ?> </td>
                        <td>
                        <td>
                          <a href=# class="btn btn-xs bg-success text-white cAccUser" data-id="<?= $newUsers[$i]["id"] ?>" data-name="<?= $newUsers[$i]["username"] ?>">Terima</a>
                          <a href=# class="btn btn-xs bg-danger text-white cDeleteUser" data-id="<?= $newUsers[$i]["id"] ?>" data-name="<?= $newUsers[$i]["username"] ?>">Tolak</a>
                        </td>
                      </tr>
                      <?php $i++ ?>
                    <?php endforeach; ?>
                    <!-- javascript untuk hide and show password -->
                    <script>
                      const toggle = document.querySelectorAll(".toggle"),
                        input = document.querySelectorAll(".show-password");
                      for (let i = 0; i < toggle.length; i++) {
                        toggle[i].addEventListener("click", () => {
                          if (input[i].type === "password") {
                            input[i].type = "text";
                            toggle.classList.replace("uil-eye-slash", "uil-eye");
                          } else {
                            input[i].type = "password";
                          }
                        })
                      }
                    </script>


                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      <script>
        $('.cDeleteUser').click(function() {
          var id_user = $(this).attr('data-id');
          var username = $(this).attr('data-name');
          Swal.fire({
            title: 'Apakah kamu yakin?',
            text: "Kamu akan menghapus user dengan nama " + username + ".",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#2dce89',
            cancelButtonColor: '#f5365c',
            confirmButtonText: 'Ya, hapus',
            cancelButtonText: 'Tidak, batalkan'
          }).then((result) => {
            if (result.isConfirmed) {
              window.location.href = "function/user-delete.php?id=" + id_user
            }
          })
        });

        $('.cAccUser').click(function() {
          var id_user = $(this).attr('data-id');
          var username = $(this).attr('data-name');
          Swal.fire({
            title: 'Apakah kamu yakin?',
            text: "Kamu akan mengonfirmasi user dengan nama " + username + ".",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#2dce89',
            cancelButtonColor: '#f5365c',
            confirmButtonText: 'Ya, konfirmasi',
            cancelButtonText: 'Tidak, hapus',
            reverseButtons: true
          }).then((result) => {
            if (result.isConfirmed) {
              window.location.href = "function/user-accept.php?id=" + id_user
            }
          })
        });
      </script>
      <!-- Footer -->
      <?php require 'include/footer.php'; ?>
    </div>
  </main>
  <!--   Core JS Files   -->
  <?php require 'include/js-file-admin.php'; ?>
  <?php require 'include/js-change-color.php'; ?>
  <!-- Modal-->
  <?php require 'include/logout-modal.php'; ?>
  <?php require 'include/edit-user-modal.php'; ?>
  <?php require 'include/change-color-modal.php'; ?>
</body>

</html>