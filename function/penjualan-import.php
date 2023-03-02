<?php

require 'database-conn.php';

if (isset($_POST["import"])) {
	$fileName = $_FILES["file"]["name"];
	$fileValidExtension = ['xlsx'];
	$fileExtension = explode('.', $fileName);
	$fileExtension = strtolower(end($fileExtension));
	// cek
	if (!in_array($fileExtension, $fileValidExtension)) {
		echo "<script> 
                alert ('yang anda upload bukan file .xlsx!')
				document.location.href = '../menu-penjualan.php';
                </script>";
		return false;
	}

	$newFileName = "data-penjualan" . "." . $fileExtension;
	if (is_file('../files/' . $newFileName)) // Jika file tersebut ada
		unlink('../files/' . $newFileName); // Hapus file tersebut

	$targetDirectory = "../files/" . $newFileName;
	move_uploaded_file($_FILES['file']['tmp_name'], $targetDirectory);

	error_reporting(0);
	ini_set('display_errors', 0);

	require '../assets/excelReader-main/excel_reader2.php';
	require '../assets/excelReader-main/SpreadsheetReader.php';

	$reader = new SpreadsheetReader($targetDirectory);
	$numrow = 1;
	$success = 0;
	$failed = 0;
	$arrayrow = array();

	mysqli_query($conn, "SET FOREIGN_KEY_CHECKS = 0	");

	foreach ($reader as $key => $row) {
		$tanggal1 = $row[0];
		$kode = $row[1];
		$notajual = $row[2];
		$sn = $row[3];
		$ket = '';

		$cek_sn = mysqli_query($conn, "SELECT * FROM stok where serial_number='$sn'");
		foreach ($cek_sn as $row1) {
			$notabeli = $row1["no_nota"];
			$ket = $row1["ket"];

			// $sku = $row[6];
			$id_user = $_SESSION["id_user"];

			//membuat sku
			$sku = "";
			$sku_cek = mysqli_query($conn, "SELECT sku FROM barang_masuk WHERE serial_number = '$sn'");
			foreach ($sku_cek as $sku1) {
				$sku = $sku1['sku'];
			}

			//membuat ket lokasi baru	
			$cek_kode = mysqli_query($conn, "SELECT nama_toko FROM toko WHERE kode_toko = '$kode' ");
			if (mysqli_num_rows($cek_kode) == 0) {
				array_push($arrayrow, $numrow);
				$failed++;
			}

			$cek_id_masuk = mysqli_query($conn, "SELECT id_masuk FROM stok WHERE serial_number = '$sn'");
			$cek = mysqli_fetch_row($cek_id_masuk);
			$id_masuk = $cek[0];
			//mengubah format tanggal
			$tanggal = formatTanggal($tanggal1);
			//cek sn apakah ada di tabel stok
			//kalau ada ambil semua datanya dan masuk ke table penjualan
			if ($numrow > 1) {
				if ($sn != "" && mysqli_num_rows($cek_id_masuk) != 0) {

					// Buat query Insert
					mysqli_query($conn, "INSERT INTO tabel_penjualan VALUES('','$tanggal', '$kode', '$notajual', '$notabeli', '$sn', '$ket', '$sku', '$id_user', '$id_masuk')");
					$success++;

					// hapus stok yang dijual
					mysqli_query($conn, "DELETE FROM stok WHERE	serial_number='$sn'");
				} else {
					array_push($arrayrow, $numrow);
					$failed++;
				}
			}
		}
		$numrow++;
	}

	$encode = json_encode($arrayrow);

	echo
	"
	<script>
	sessionStorage.setItem('cekJual','importyes');
	sessionStorage.setItem('nyes',$success);
	sessionStorage.setItem('nno',$failed);
	sessionStorage.setItem('arrayrow',$encode);
	document.location.href = '../menu-penjualan.php';
	</script>
	";
}
