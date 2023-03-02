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

$products = [];
if (isset($_POST["search-date"])) {
    global $products;
    $tanggal_stok = $_POST["tanggal_stok"];
    $products = query("SELECT DISTINCT serial_number, sku, item, COUNT(sku) AS jumlah
    FROM barang_masuk
    WHERE tgl_masuk <= '$tanggal_stok'
    AND id_masuk NOT IN (
        SELECT id_masuk
        FROM tabel_penjualan
        WHERE tgl_terjual <= '$tanggal_stok'
    )
    GROUP BY sku
    ORDER BY tgl_masuk DESC");
} elseif (isset($_POST["all-date"])) {
    global $products;
    $products  = query("SELECT DISTINCT serial_number, sku, item, COUNT(sku) AS jumlah FROM stok GROUP BY sku ORDER BY tgl_masuk DESC");
} else {
    global $products;
    $products  = query("SELECT DISTINCT serial_number, sku, item, COUNT(sku) AS jumlah FROM stok GROUP BY sku ORDER BY tgl_masuk DESC");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>
        Agres ID - Daftar Stok
    </title>
    <?php require 'include/head-master-dasboard.php'; ?>
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
                                <h5 class="text-capitalize mb-0">Daftar Stok</h5>
                            </div>
                            <div class="col-md-6 d-flex pt-3 pe-5 ps-5 justify-content-end">
                                <a href="#" class="d-sm-inline-block btn btn-round btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#exportStok">
                                    <i class="fas fa-upload fa-sm text-dark"></i> Export File</a>
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
                                <label><input type="checkbox" value="hide" id="sku_col" onchange="hide_show_table(this.id);" class="form-check-input align-middle ms-2 me-2" checked>SKU</label>
                                <label><input type="checkbox" value="hide" id="item_col" onchange="hide_show_table(this.id);" class="form-check-input align-middle ms-2 me-2" checked>Item</label>
                                <label><input type="checkbox" value="hide" id="total_col" onchange="hide_show_table(this.id);" class="form-check-input align-middle ms-2 me-2" checked>Total</label>
                                <label><input type="checkbox" value="hide" id="ket_col" onchange="hide_show_table(this.id);" class="form-check-input align-middle ms-2 me-2" checked>Ket</label>
                                <label><input type="checkbox" value="hide" id="modal_col" onchange="hide_show_table(this.id);" class="form-check-input align-middle ms-2 me-2" checked>Modal</label>
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
                                    <form action="" method="post"></form>
                                    <div class="container align-items-center">
                                        <form action="" method="post">
                                            <div class="row">
                                                <div class="col-9 form-group">
                                                    <label for="inputTanggalStok" class="font-weight-bold">Tanggal:</label>
                                                    <input type="date" id="inputTanggalStok" class="form-control" name="tanggal_stok" value="<?php echo $tanggal_stok ?>">
                                                </div>
                                                <div class="col form-group">
                                                    <button type="submit" name="search-date" class="btn btn-secondary mt-4 mb-3 btn-sm btn-round">Tampilkan</button>&nbsp;
                                                    <input type="submit" name="all-date" class="btn btn-secondary mt-4 mb-3 btn-sm btn-round" value="Current">
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th id="sku_col_head">SKU</th>
                                            <th id="item_col_head">Item</th>
                                            <th id="total_col_head">Total</th>
                                            <th id="ket_col_head">Ket</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1 ?>
                                        <?php foreach ($products as $row) : ?>
                                            <tr>
                                                <td><?= $i ?></td>
                                                <td class="sku_col"><?= $row["sku"] ?> </td>
                                                <td class="item_col"><?= $row['item'] ?></td>
                                                <td class="total_col"><?= $row['jumlah'] ?> </td>
                                                <td class="ket_col">
                                                    <a href="#" data-bs-toggle="modal" data-bs-target="#lokasi<?php echo $row['sku']; ?>" class="d-sm-inline-block btn btn-xs btn-round btn-info color-theme">Lokasi</a>
                                                    <!-- Modal Edit Pembelian/barang (terpisah karena perlu dibuat per data) -->
                                                    <?php require 'include/lokasi-modal.php'; ?>
                                                </td>
                                            </tr>
                                            <?php $i++ ?>
                                        <?php endforeach; ?>
                                        <!-- javascript untuk hide and show password -->

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
    <?php require 'include/export-stok-modal.php'; ?>
    <?php require 'include/logout-modal.php'; ?>
    <?php require 'include/change-color-modal.php'; ?>

</body>

</html>