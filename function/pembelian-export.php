<?php 

require 'database-conn.php';
if(isset($_POST["export"])){

    //ambil nilai tanggal awal; dan tanggal akhir
    $start_date = $_POST["start-date"];
    $end_date= $_POST["end-date"];
     
    function filterData(&$str){ 
        $str = preg_replace("/\t/", "\\t", $str); 
        $str = preg_replace("/\r?\n/", "\\n", $str); 
        if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"'; 
    }
    
    // Excel file name for download 
    $fileName = "pembelian-data_" . date('Y-m-d') . ".xls"; 
     
    // Column names 
    $fields = array('TANGGAL', 'NO.NOTA', 'ITEM', 'SERIAL NUMBER', 'CN', 'SPP','KETERANGAN', 'MODAL'); 
     
    // Display column names as first row 
    $excelData = implode("\t", array_values($fields)) . "\n"; 
     
    // Fetch records from database       
        $query = mysqli_query($conn, "SELECT * FROM barang_masuk where tgl_masuk Between '$start_date' and '$end_date' ORDER BY tgl_masuk DESC");
        
        if($query->num_rows > 0){ 
            // Output each row of the data 
            $i=1;
            while($row = $query->fetch_assoc()){ 
                $lineData = array( $row['tgl_masuk'], $row['no_nota'], $row['item'], $row['serial_number'],$row['cn'], $row['spp'], $row['ket'], $row['modal']); 
                array_walk($lineData, 'filterData'); 
                $excelData .= implode("\t", array_values($lineData)) . "\n";
                $i++; 
            } 
        }else{ 
            $excelData .= 'No records found...'. "\n"; 
        } 
        
        // Headers for download 
        header("Content-Type: application/vnd.ms-excel"); 
        header("Content-Disposition: attachment; filename=\"$fileName\""); 
         
        // Render excel data 
        echo $excelData; 
         
        exit;    

}

?>


