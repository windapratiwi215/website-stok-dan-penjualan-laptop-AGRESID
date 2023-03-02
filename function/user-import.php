<?php

//koneksi ke database
require 'database-conn.php';

if(isset($_POST["import"])){
	$fileName = $_FILES["file"]["name"];
	$fileExtension = explode('.', $fileName);
	$fileExtension = strtolower(end($fileExtension));
	$fileValidExtension = ['xlsx'];

	// cek
	if(!in_array($fileExtension, $fileValidExtension)){
        echo "<script> 
                alert ('File tidak valid. Import file dengan ekstensi .xlsx!')
				document.location.href = '../menu-user.php';
                </script>";
        return false;
    }

	$newFileName = "data-user" . "." . $fileExtension;
	if(is_file('files/'.$newFileName)) // Jika file tersebut ada
		unlink('files/'.$newFileName); // Hapus file tersebut

	$targetDirectory = "../files/" . $newFileName;
	move_uploaded_file($_FILES['file']['tmp_name'], $targetDirectory);

	error_reporting(0);
	ini_set('display_errors',0);

	require '../assets/excelReader-main/excel_reader2.php';
	require '../assets/excelReader-main/SpreadsheetReader.php';

	$reader = new SpreadsheetReader($targetDirectory);
	$numrow = 1;
	$success = 0;
	$failed = 0;
	$arrayrow = array();

	foreach($reader as $key => $row) {
		$nama = $row[0]; 
		$email = $row[1]; 
		$jabatan = $row[2];
        $username = $row[3];
		$password = $row[4]; 
        $status = $row[5]; 
		$akses = $row[6]; 

		if($numrow > 1){
            // Buat query Insert
			$cekUsername = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username' ");
			if (mysqli_num_rows($cekUsername) == 0 ){
				mysqli_query($conn, "INSERT INTO users VALUES('','$nama', '$email', '$jabatan', '$username','$password', '$status', '$akses')");
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
	sessionStorage.setItem('cekUser','importyes');
	sessionStorage.setItem('nyes',$success);
	sessionStorage.setItem('nno',$failed);
	sessionStorage.setItem('arrayrow',$encode);
	document.location.href = '../menu-user.php';
	</script>
	";
}

?>