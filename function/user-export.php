<?php 

require 'database-conn.php';

function filterData(&$str){ 
    $str = preg_replace("/\t/", "\\t", $str); 
    $str = preg_replace("/\r?\n/", "\\n", $str); 
    if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"'; 
}

// Excel file name for download 
$fileName = "users-data_" . date('Y-m-d') . ".xls"; 
 
// Column names 
$fields = array('nama', 'email', 'username', 'password', 'jabatan', 'status'); 
 
// Display column names as first row 
$excelData = implode("\t", array_values($fields)) . "\n"; 
 
// Fetch records from database 
$query = mysqli_query($conn, "SELECT * FROM users ORDER BY id DESC");
if($query->num_rows > 0){ 
    // Output each row of the data 
    $i=1;
    while($row = $query->fetch_assoc()){ 
        $status = ($row['status'] == 1)?'Active':'Inactive'; 
        $lineData = array( $row['nama'], $row['email'], $row['username'], $row['password'],$row['jabatan'], $status); 
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


?>