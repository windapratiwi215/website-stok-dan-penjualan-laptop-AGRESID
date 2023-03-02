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
$newUsers = query("SELECT * FROM users where status ='0' ORDER BY id DESC");
$newSKU = query("SELECT * FROM tabel_sku where status ='0'  ");
$requestAcc = query("SELECT * FROM users where akses ='1' ");


$products = [];
if (isset($_POST["search-date"])) {
    global $products;
    $tanggal_mulai = $_POST["mulai_tanggal"];
    $tanggal_akhir = $_POST["sampai_tanggal"];

    $products  = query("SELECT * FROM barang_masuk where tgl_masuk Between '$tanggal_mulai' and '$tanggal_akhir ' ORDER BY tgl_masuk DESC");
} elseif (isset($_POST["all-date"])) {
    global $products;
    $products  = query("SELECT * FROM barang_masuk  ORDER BY tgl_masuk DESC");
} else {
    global $products;
    $products  = query("SELECT * FROM barang_masuk  ORDER BY tgl_masuk DESC");
    // global $products;
    // $tahun_sekarang = date('Y');
    // $products  = query("SELECT * FROM barang_masuk WHERE tgl_masuk  LIKE '%$tahun_sekarang%' ORDER BY tgl_masuk DESC limit 100");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>
        Agres ID - Daftar Pembelian
    </title>
    <?php require 'include/head-master-dasboard.php'; ?>
</head>

<body class="g-sidenav-show bg-gray-100">
    <?php require 'include/preloader.php' ?>
    <?php require 'include/alert/beli.php' ?>
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
                                <h5 class="text-capitalize mb-0">Daftar Pembelian (Barang Masuk)</h5>
                            </div>
                            <div class="col-md-6 d-flex pt-3 pe-5 ps-5 justify-content-end">

                                <a href="#" data-bs-toggle="modal" data-bs-target="#uploadPembelian" class="d-sm-inline-block btn btn-round btn-sm btn-light">
                                    <i class="fas fa-download fa-sm text-dark"></i> Import File</a>&nbsp;
                                <a href="#" data-bs-toggle="modal" data-bs-target="#exportPembelian" class="d-sm-inline-block btn btn-round btn-sm btn-light">
                                    <i class="fas fa-upload fa-sm text-dark"></i> Export File</a>&nbsp;
                                <a href="#" data-bs-toggle="modal" data-bs-target="#addPembelian" class="d-sm-inline-block btn btn-round btn-sm btn-info color-theme">
                                    <i class="fas fa-plus fa-sm text-white-50"></i> Add New</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-lg mb-lg">
                    <div class="card h-100">
                        <div class="card-body p-3 font-size-sm text-dark">
                            <div class="form-check form-check-inline ps-0 mb-0">
                                <label><input type="checkbox" value="hide" id="tanggal_col" onchange="hide_show_table(this.id);" class="form-check-input align-middle ms-2 me-2" checked>Tanggal</label>
                                <label><input type="checkbox" value="hide" id="noNota_col" onchange="hide_show_table(this.id);" class="form-check-input align-middle ms-2 me-2" checked>No.Nota</label>
                                <label><input type="checkbox" value="hide" id="item_col" onchange="hide_show_table(this.id);" class="form-check-input align-middle ms-2 me-2" checked>Item</label>
                                <label><input type="checkbox" value="hide" id="sn_col" onchange="hide_show_table(this.id);" class="form-check-input align-middle ms-2 me-2" checked>SN</label>
                                <label><input type="checkbox" value="hide" id="cn_col" onchange="hide_show_table(this.id);" class="form-check-input align-middle ms-2 me-2" checked>CN</label>
                                <label><input type="checkbox" value="hide" id="spp_col" onchange="hide_show_table(this.id);" class="form-check-input align-middle ms-2 me-2" checked>SPP</label>
                                <label><input type="checkbox" value="hide" id="ket_col" onchange="hide_show_table(this.id);" class="form-check-input align-middle ms-2 me-2" checked>Ket</label>
                                <label><input type="checkbox" value="hide" id="modal_col" onchange="hide_show_table(this.id);" class="form-check-input align-middle ms-2 me-2" checked>Modal</label>
                                <label><input type="checkbox" value="hide" id="sku_col" onchange="hide_show_table(this.id);" class="form-check-input align-middle ms-2 me-2" checked>SKU</label>
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
                                    <form action="" method="post"></form>
                                    <div class="container align-items-center">
                                        <form action="" method="post">
                                            <div class="row">
                                                <div class="col-5 form-group">
                                                    <label for="inputMulaiTanggal" class="font-weight-bold">Mulai
                                                        Tanggal :</label>
                                                    <input type="date" id="inputMulaiTanggal" class="form-control" name="mulai_tanggal" value="<?php echo $mulai_tanggal ?>">
                                                </div>
                                                <div class="col-5 form-group">
                                                    <label for="inputSampaiTanggal" class="font-weight-bold">Sampai
                                                        Tanggal :</label>
                                                    <input type="date" id="inputSampaiTanggal" class="form-control" name="sampai_tanggal" value="<?php echo $sampai_tanggal ?>">
                                                </div>
                                                <div class="col form-group">
                                                    <button type="submit" name="search-date" class="btn btn-secondary mt-4 mb-3 btn-sm btn-round">Tampilkan</button>&nbsp;
                                                    <input type="submit" name="all-date" class="btn btn-secondary mt-4 mb-3 btn-sm btn-round" value="All">
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th id="tanggal_col_head">Tanggal</th>
                                            <th id="noNota_col_head">No.Nota</th>
                                            <th id="item_col_head">Item</th>
                                            <th id="sn_col_head">SN</th>
                                            <th id="sku_col_head">SKU</th>
                                            <th id="cn_col_head">CN</th>
                                            <th id="spp_col_head">SPP</th>
                                            <th id="ket_col_head">Lokasi</th>
                                            <th id="modal_col_head">Modal</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1 ?>
                                        <?php foreach ($products as $row) : ?>
                                            <tr>
                                                <td><?= $i ?></td>
                                                <td class="tanggal_col"><?= $row["tgl_masuk"] ?> </td>
                                                <td class="noNota_col"><?= $row["no_nota"] ?> </td>
                                                <td class="item_col"><?= $row['item'] ?></td>
                                                <td class="sn_col"><?= $row["serial_number"] ?> </td>
                                                <td class="sku_col"><?= $row["sku"] ?> </td>
                                                <td class="cn_col"><?= $row["cn"] ?> </td>
                                                <td class="spp_col"><?= $row["spp"] ?> </td>
                                                <td class="ket_col"><?= $row["ket"] ?> </td>
                                                <td class="modal_col"><?= $row["modal"] ?> </td>
                                                <td>
                                                    <!-- cek user akses -->
                                                    <?php $id_user = $_SESSION["id_user"];
                                                    $ambil_akses = mysqli_query($conn, "SELECT akses FROM users where id = $id_user ");

                                                    foreach ($ambil_akses as $acc) {
                                                        $akses_id = $acc["akses"];
                                                        if ($akses_id == 0) {
                                                    ?>
                                                            <a href="#" data-bs-toggle="modal" data-bs-target="#requestAcc" class="d-sm-inline-block btn btn-xs btn-round btn-success">
                                                                <i class="fas fa-edit fa-sm text-white"></i></a>
                                                            <a href="#" data-bs-toggle="modal" data-bs-target="#requestAcc" class="d-sm-inline-block btn btn-xs btn-round btn-danger">
                                                                <i class="fas fa-trash fa-sm text-white"></i></a>
                                                        <?php
                                                            require 'include/request_access.php';
                                                        } elseif ($akses_id == 1) {
                                                        ?>
                                                            <a href="#" data-bs-toggle="modal" data-bs-target="#waitAcc" class="d-sm-inline-block btn btn-xs btn-round btn-success">
                                                                <i class="fas fa-edit fa-sm text-white"></i></a>
                                                            <a href="#" data-bs-toggle="modal" data-bs-target="#waitAcc" class="d-sm-inline-block btn btn-xs btn-round btn-danger">
                                                                <i class="fas fa-trash fa-sm text-white"></i></a>
                                                        <?php
                                                            require 'include/wait_access.php';
                                                        } else {
                                                        ?>
                                                            <a href="#" data-bs-toggle="modal" data-bs-target="#editPembelian<?php echo $row['id_masuk']; ?>" class="d-sm-inline-block btn btn-xs btn-round btn-success">
                                                                <i class="fas fa-edit fa-sm text-white"></i></a>
                                                            <!-- Modal Edit Pembelian/barang (terpisah karena perlu dibuat per data) -->
                                                            <?php require 'include/edit-pembelian-modal.php'; ?>
                                                            <a href="#" class="d-sm-inline-block btn btn-xs btn-danger btn-round cDeleteBeli" data-id="<?= $row["id_masuk"] ?>" data-name="<?= $row["item"] ?>">
                                                                <i class="fas fa-trash fa-sm text-white"></i></a>

                                                    <?php

                                                        }
                                                    }
                                                    ?>


                                                </td>
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
                                                    document.getElementById(col_name + "_head").style.display =
                                                        "table-cell";
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
            <script>
                $('.cDeleteBeli').click(function() {
                    var id_beli = $(this).attr('data-id');
                    var item = $(this).attr('data-name');
                    Swal.fire({
                        title: 'Apakah kamu yakin?',
                        text: "Kamu akan menghapus data pembelian " + item + ".",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#2dce89',
                        cancelButtonColor: '#f5365c',
                        confirmButtonText: 'Ya, hapus',
                        cancelButtonText: 'Tidak, batalkan'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "function/pembelian-delete.php?id=" + id_beli
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
    <?php require 'include/upload-pembelian-modal.php'; ?>
    <?php require 'include/export-pembelian-modal.php'; ?>
    <?php require 'include/add-pembelian-modal.php'; ?>
    <?php require 'include/change-color-modal.php'; ?>

</body>

</html>