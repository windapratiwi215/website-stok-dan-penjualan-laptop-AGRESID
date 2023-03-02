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

	$newFileName = "data-sku" . "." . $fileExtension;
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
		$sku = $row[0];
		$item = $row[1];
		$status = 0;

		if ($numrow > 1) {
			$cekSku = mysqli_query($conn, "SELECT * FROM tabel_sku WHERE sku = '$sku' ");
			if ($item != "" && mysqli_num_rows($cekSku) == 0) {
				// Buat query Insert
				mysqli_query($conn, "INSERT INTO tabel_sku VALUES('','$sku', '$item', '$status')");
				$success++;
			} else {
				array_push($arrayrow,$numrow);
				$failed++;
			}
		}
		$numrow++;
	}

	$encode = json_encode($arrayrow);
	
	echo
	"
	<script>
	sessionStorage.setItem('cekSku','importyes');
	sessionStorage.setItem('nyes',$success);
	sessionStorage.setItem('nno',$failed);
	sessionStorage.setItem('arrayrow',$encode);
	document.location.href = '../menu-sku.php';
	</script>
	";
}
