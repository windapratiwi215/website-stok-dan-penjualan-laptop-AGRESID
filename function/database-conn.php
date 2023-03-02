<?php 

//koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "agres_database");

function query($query){
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while($row = mysqli_fetch_assoc($result)){
        $rows[] = $row;
    }
    return $rows;
}

//format tanggal
function formatTanggal($date){
    // ubah string menjadi format tanggal
    return date('Y-m-d', strtotime($date));
   }

?>