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
				document.location.href = '../menu-pembelian.php';
                </script>";
		return false;
	}

	$newFileName = "data-pembelian" . "." . $fileExtension;
	if (is_file('../files/' . $newFileName)) // Jika file tersebut ada
		unlink('../files/' . $newFileName); // Hapus file tersebut

	$targetDirectory = "../files/" . $newFileName;
	move_uploaded_file($_FILES['file']['tmp_name'], $targetDirectory);

	error_reporting(0);
	ini_set('display_errors', 0);

	require '../assets/excelReader-main/excel_reader2.php';
	require '../assets/excelReader-main/SpreadsheetReader.php';

	$reader = new SpreadsheetReader($targetDirectory);
	$numrow = 0;
	$success = 0;
	$failed = 0;
	$skubaru = 0;
	$arrayrow = array();

	mysqli_query($conn, "SET FOREIGN_KEY_CHECKS = 0	");
	$id_sekarang = mysqli_query($conn, "SELECT id_masuk FROM barang_masuk ORDER BY id_masuk DESC limit 1");
	$cek_item = mysqli_query($conn, "SELECT * FROM stok");

	$barang_masuk =  mysqli_query($conn, "SELECT * FROM barang_masuk");
	//cek data didalm tabel barang masuk ada atau tidak
	if (mysqli_num_rows($barang_masuk) == 0) {

		foreach ($reader as $key => $row) {
			$numrow++;
			$tanggal1 = $row[0];
			$no_nota = $row[1];
			$item = $row[2];
			$sn = $row[3];
			$cn = $row[4];
			$spp1 = $row[5];
			$spp = strtoupper($spp1);
			$ket1 = $row[6];
			$ket = strtoupper($ket1);
			$modal = $row[7];
			$id_user = $_SESSION["id_user"];
			$kode = explode(" ", $item); //Memecah $kalimat dengan tanda pemisah ialah spasi

			//cek sn kosong data tidak boleh masuk
			if ($sn == null) {
				array_push($arrayrow, $numrow);
				$failed++;
				continue;
			} else {
				//mengubah format tanggal
				$tanggal = formatTanggal($tanggal1);

				if ($numrow > 1) {
					//cek sn sama pada stok, jika ada sn yang sama pada stok data tidak boleh masuk
					$sn_stok = mysqli_query($conn, "SELECT serial_number FROM stok where serial_number = '$sn'");
					//jika serial number tersebut ada di stok maka data tidak boleh masuk
					if (mysqli_num_rows($sn_stok) > 0) {
						array_push($arrayrow, $numrow);
						$failed++;
						continue;
					}
					// cek item, kalo belum ada, add ke tabel sku dulu
					// SELECT replace(CustomerName,' ', '') FROM Customers;
					$cek_sku = mysqli_query($conn, "SELECT * FROM tabel_sku where replace(UPPER(item),' ', '') = replace(UPPER('$item'),' ', '')");
					$getAllBrand = mysqli_query($conn, "SELECT * FROM tabel_sku WHERE UPPER (ITEM) LIKE '%$kode[0]%'");
					$createSku = "$kode[0]";
					$createSku .= strval(mysqli_num_rows($getAllBrand));
					//ambil nilai dari sn
					$sn_lama = mysqli_query($conn, "SELECT * FROM barang_masuk where serial_number='$sn'");

					//jika ada sn yg sama
					if (mysqli_num_rows($sn_lama) > 0) {
						//perulangan semua sn yang sama tadi	
						foreach ($sn_lama as $sn_cek) {
							//cek tanggal berdasarkan sn diperulangn dengan sn inputan
							$tanggal_lama = $sn_cek["tgl_masuk"];
							if ($tanggal == $tanggal_lama) {
								array_push($arrayrow, $numrow);
								$failed++;
								continue;
							} else {
								//maka inputan masuk dan stok juga bertambah
								if (mysqli_num_rows($cek_sku) == 0) {
									mysqli_query($conn, "INSERT INTO tabel_sku VALUES('','$createSku','$item', '0')");
									$skubaru++;
								}
								$ambil_sku =  mysqli_query($conn, "SELECT sku FROM tabel_sku where replace(UPPER(item),' ', '') = replace(UPPER('$item'),' ', '')");
								foreach ($ambil_sku as $sku) {
									$ambil =  $sku['sku'];
									// Buat query Insert
									mysqli_query($conn, "INSERT INTO barang_masuk VALUES('','$tanggal', '$no_nota', '$item', '$sn','$cn', '$spp', '$ket', '$modal', '$ambil', '$id_user')");
									$success++;
								}
							}
						}
						//jika tidak ada sn yang sama langsung masuk
					} else {
						//maka inputan masuk dan stok juga bertambah
						if (mysqli_num_rows($cek_sku) == 0) {
							mysqli_query($conn, "INSERT INTO tabel_sku VALUES('','$createSku','$item', '0')");
							$skubaru++;
						}
						$ambil_sku =  mysqli_query($conn, "SELECT sku FROM tabel_sku where replace(UPPER(item),' ', '') = replace(UPPER('$item'),' ', '')");
						foreach ($ambil_sku as $sku) {
							$ambil =  $sku['sku'];
							// Buat query Insert
							mysqli_query($conn, "INSERT INTO barang_masuk VALUES('','$tanggal', '$no_nota', '$item', '$sn','$cn', '$spp', '$ket', '$modal', '$ambil', '$id_user')");
							$success++;
						}
					}
				}
			}
		}
		if (mysqli_num_rows($cek_item) == 0) {
			mysqli_query($conn, "SET FOREIGN_KEY_CHECKS = 0	");
			mysqli_query($conn, "INSERT INTO stok(no_nota,sku,item,serial_number,ket, id_masuk,tgl_masuk,spp, modal) SELECT no_nota, sku,item,serial_number,ket,id_masuk,tgl_masuk,spp, modal FROM barang_masuk WHERE tgl_masuk=tgl_masuk ");
		} else {
			foreach ($id_sekarang as $id) {
				$id_noww = $id['id_masuk'];
				mysqli_query($conn, "SET FOREIGN_KEY_CHECKS = 0	");
				mysqli_query($conn, "INSERT INTO stok(no_nota, sku,item,serial_number,ket, id_masuk,tgl_masuk,spp,modal) SELECT no_nota, sku,item,serial_number,ket,id_masuk,tgl_masuk,spp, modal FROM barang_masuk WHERE id_masuk >'$id_noww' ");
			}
		}
	} else {
		foreach ($reader as $key => $row) {
			$numrow++;
			$tanggal1 = $row[0];
			$no_nota = $row[1];
			$item = $row[2];
			$sn = $row[3];
			$cn = $row[4];
			
			$spp1 = $row[5];
			$spp = strtoupper($spp1);
			$ket1 = $row[6];
			$ket = strtoupper($ket1);
			$modal = $row[7];
			$id_user = $_SESSION["id_user"];
			$kode = explode(" ", $item); //Memecah $kalimat dengan tanda pemisah ialah spasi

			//cek sn kosong data tidak boleh masuk
			if ($sn == null) {
				array_push($arrayrow, $numrow);
				$failed++;
				continue;
			} else {
				//mengubah format tanggal
				$tanggal = formatTanggal($tanggal1);

				if ($numrow > 1) {
					//cek sn sama pada stok, jika ada sn yang sama pada stok data tidak boleh masuk
					$sn_stok = mysqli_query($conn, "SELECT serial_number FROM stok where serial_number = '$sn'");
					//jika serial number tersebut ada di stok maka data tidak boleh masuk
					if (mysqli_num_rows($sn_stok) > 0) {
						array_push($arrayrow, $numrow);
						$failed++;
						continue;
					}
					// cek item, kalo belum ada, add ke tabel sku dulu
					$cek_sku = mysqli_query($conn, "SELECT * FROM tabel_sku where replace(UPPER(item),' ', '') = replace(UPPER('$item'),' ', '')");
					$getAllBrand = mysqli_query($conn, "SELECT * FROM tabel_sku WHERE UPPER (ITEM) LIKE '%$kode[0]%'");
					$createSku = "$kode[0]";
					$createSku = strval(mysqli_num_rows($getAllBrand));

					//ambil nilai dari sn
					$sn_lama = mysqli_query($conn, "SELECT * FROM barang_masuk where serial_number='$sn'");

					//jika ada sn yg sama
					if (mysqli_num_rows($sn_lama) > 0) {
						//perulangan semua sn yang sama tadi	
						foreach ($sn_lama as $sn_cek) {
							//cek tanggal berdasarkan sn diperulangn dengan sn inputan
							$tanggal_lama = $sn_cek["tgl_masuk"];
							if ($tanggal == $tanggal_lama) {
								array_push($arrayrow, $numrow);
								$failed++;
								continue;
							} else {
								//maka inputan masuk dan stok juga bertambah
								if (mysqli_num_rows($cek_sku) == 0) {
									mysqli_query($conn, "INSERT INTO tabel_sku VALUES('','$createSku','$item', '0')");
									$skubaru++;
								}
								$ambil_sku =  mysqli_query($conn, "SELECT sku FROM tabel_sku where replace(UPPER(item),' ', '') = replace(UPPER('$item'),' ', '')");
								foreach ($ambil_sku as $sku) {
									$ambil =  $sku['sku'];
									// Buat query Insert
									mysqli_query($conn, "INSERT INTO barang_masuk VALUES('','$tanggal', '$no_nota', '$item', '$sn','$cn', '$spp', '$ket', '$modal', '$ambil', '$id_user')");
									$success++;
								}
							}
						}
						//jika tidak ada sn yang sama langsung masuk
					} else {
						//maka inputan masuk dan stok juga bertambah
						if (mysqli_num_rows($cek_sku) == 0) {
							mysqli_query($conn, "INSERT INTO tabel_sku VALUES('','$createSku','$item', '0')");
							$skubaru++;
						}
						$ambil_sku =  mysqli_query($conn, "SELECT sku FROM tabel_sku where replace(UPPER(item),' ', '') = replace(UPPER('$item'),' ', '')");
						foreach ($ambil_sku as $sku) {
							$ambil =  $sku['sku'];
							// Buat query Insert
							mysqli_query($conn, "INSERT INTO barang_masuk VALUES('','$tanggal', '$no_nota', '$item', '$sn','$cn', '$spp', '$ket', '$modal', '$ambil', '$id_user')");
							$success++;
						}
					}
				}
			}
		}
		if (mysqli_num_rows($cek_item) == 0) {
			mysqli_query($conn, "SET FOREIGN_KEY_CHECKS = 0	");
			mysqli_query($conn, "INSERT INTO stok(no_nota,sku,item,serial_number,ket, id_masuk,tgl_masuk,cn,spp,modal) SELECT no_nota, sku,item,serial_number,ket,id_masuk,tgl_masuk,cn,spp,modal FROM barang_masuk WHERE tgl_masuk=tgl_masuk ");
		} else {
			foreach ($id_sekarang as $id) {
				$id_noww = $id['id_masuk'];
				mysqli_query($conn, "SET FOREIGN_KEY_CHECKS = 0	");
				mysqli_query($conn, "INSERT INTO stok(no_nota, sku,item,serial_number,ket, id_masuk,tgl_masuk,cn,spp,modal) SELECT no_nota, sku,item,serial_number,ket,id_masuk,tgl_masuk,cn,spp,modal FROM barang_masuk WHERE id_masuk >'$id_noww' ");
			}
		}
	}

	$encode = json_encode($arrayrow);

	echo
	"
	<script>
	sessionStorage.setItem('cekBeli','importyes');
	sessionStorage.setItem('nyes',$success);
	sessionStorage.setItem('nno',$failed);
	sessionStorage.setItem('nsku',$skubaru);
	sessionStorage.setItem('arrayrow',$encode);
	document.location.href = '../menu-pembelian.php';
	</script>
	";
}
