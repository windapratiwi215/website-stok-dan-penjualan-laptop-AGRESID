<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

require 'function/database-conn.php';
$newUsers = query("SELECT * FROM users where status ='0' ORDER BY id DESC");
// $products = query("SELECT *, COUNT(sku), item FROM stok GROUP BY sku ORDER BY tgl_masuk DESC");
$newSKU = query("SELECT * FROM tabel_sku where status ='0' ");
$requestAcc = query("SELECT * FROM users where akses ='1' ");
$products = query("SELECT * FROM toko ORDER BY id_toko DESC");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>
        Agres ID - Daftar Toko
    </title>
    <?php require 'include/head-master-dasboard.php'; ?>
</head>

<body class="g-sidenav-show bg-gray-100">
    <?php require 'include/preloader.php' ?>
    <?php require 'include/alert/toko.php'?>
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
                                <h5 class="text-capitalize mb-0">Daftar Toko</h5>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="ro mt-4">
                <div class="col-lg mb-lg-0 mb-4">
                    <div class="card h-100">
                        <div class="card-body p-3">
                            <div class="table-responsive">
                                <table class="table font-size-md text-dark" id="dataUser" width="100%" cellspacing="0">

                            </div>
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Toko</th>
                                    <th>Kode Toko</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1 ?>
                                <?php foreach ($products as $row) : ?>
                                    <tr>
                                        <td><?= $i ?></td>
                                        <td><?= $row["nama_toko"] ?> </td>
                                        <td><?= $row['kode_toko'] ?></td>
                                        <td>
                                            <!-- cek user akses -->
                                            <?php $id_user = $_SESSION["id_user"];
                                            $ambil_akses = mysqli_query($conn, "SELECT akses FROM users where id = $id_user ");

                                            foreach ($ambil_akses as $acc) {
                                                $akses_id = $acc["akses"];
                                                if ($akses_id == 0) {
                                            ?>
                                                    <a href="#" data-bs-toggle="modal" data-bs-target="#requestAcc" class="d-sm-inline-block btn btn-xs btn-round btn-danger">
                                                        <i class="fas fa-trash fa-sm text-white"></i></a>
                                                <?php
                                                    require 'include/request_access.php';
                                                } elseif ($akses_id == 1) {
                                                ?>
                                                    <a href="#" data-bs-toggle="modal" data-bs-target="#waitAcc" class="d-sm-inline-block btn btn-xs btn-round btn-danger">
                                                        <i class="fas fa-trash fa-sm text-white"></i></a>
                                                <?php
                                                    require 'include/wait_access.php';
                                                } else {
                                                ?>
                                                    <a href=# class="d-sm-inline-block btn btn-xs btn-round btn-danger cDeleteToko" data-id="<?= $row["id_toko"] ?>" data-name="<?= $row["nama_toko"] ?>">
                                                        <i class="fas fa-trash fa-sm text-white"></i></a>
                                            <?php

                                                }
                                            }
                                            ?>


                                            <!-- end user akses -->

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
        <script>
            $('.cDeleteToko').click(function() {
                var id_toko = $(this).attr('data-id');
                var nama_toko = $(this).attr('data-name');
                Swal.fire({
                    title: 'Apakah kamu yakin?',
                    text: "Kamu akan menghapus toko " + nama_toko + ".",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#2dce89',
                    cancelButtonColor: '#f5365c',
                    confirmButtonText: 'Ya, hapus',
                    cancelButtonText: 'Tidak, batalkan'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "function/toko-delete.php?id=" + id_toko
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
    <?php require 'include/export-stok-modal.php'; ?>
    <?php require 'include/logout-modal.php'; ?>
    <?php require 'include/change-color-modal.php'; ?>

</body>

</html>