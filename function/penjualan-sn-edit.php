<?php 
session_start();

if(!isset($_SESSION["login"])){
    header("Location: login-registrasi.php");
    exit;

}
require 'database-conn.php';

function penjualanSNEdit(){
  global $conn;
  $id = $_POST["id_penjualan"];
  $tgl_baru= $_POST["tgl_jual"];
  $sn_baru= $_POST["serial_number"];
  $nota_baru = $_POST["nota_jual"];
  
  //ambil sn lama dimasukkan ke stok
  $sn_lama = mysqli_query($conn, "SELECT serial_number FROM tabel_penjualan WHERE id_penjualan='$id' limit 1");
  foreach($sn_lama as $lama){
     $ambil_sn_lama = $lama["serial_number"];

      //ambil semua data di barang masuk yang ada di sn_lama untuk di insert ke tabel stok
     $barang_balik = mysqli_query($conn,"SELECT * FROM barang_masuk WHERE serial_number='$ambil_sn_lama'");
      foreach($barang_balik as $balik){
        $tgl_masuk= $balik["tgl_masuk"];
        $no_nota= $balik["no_nota"];
        $item= $balik["item"];
        $serial_number= $balik["serial_number"];
        $cn= $balik["cn"];
        $spp= $balik["spp"];
        $ket= $balik["ket"];
        $modal= $balik["modal"];
        $sku= $balik["sku"];
        $id_masuk=$balik["id_masuk"];
        $id_user= $balik["id_user"];

        mysqli_query($conn, "SET FOREIGN_KEY_CHECKS = 0	");	
        $query_balik = "INSERT INTO stok 
              VALUES('','$tgl_masuk', '$no_nota', 
              '$item', '$serial_number',
              '$cn', '$spp', '$ket', 
              '$modal','','','', '$sku', '$id_masuk','$id_user')
          ";

        mysqli_query($conn, $query_balik); 
    }
  }
  
  //edit tabel penjualan
  mysqli_query($conn, "SET FOREIGN_KEY_CHECKS = 0	");	
  $barang_baru = mysqli_query($conn, "SELECT * FROM barang_masuk WHERE serial_number='$sn_baru'");

  foreach($barang_baru as $baru){
    $nota_beli_baru = $baru["no_nota"];
    $ket_baru = $baru["ket"];
    $id_user_baru = $baru["id_user"];

    //edit data penjualan menggunakan SN baru
    $query = "UPDATE tabel_penjualan SET tgl_terjual='$tgl_baru', nota_penjualan='$nota_baru', no_nota='$nota_beli_baru', serial_number='$sn_baru', ket='$ket_baru', id_user='$id_user_baru' WHERE id_penjualan='$id'";
    mysqli_query($conn, $query);
  }

   //hapus stok dari SN baru
   $hapus_sn = "DELETE FROM stok WHERE serial_number = '$sn_baru' ";
   mysqli_query($conn, $hapus_sn);

  return mysqli_affected_rows($conn);
}
if(penjualanSNEdit()>0){
  echo "
  <script>
  sessionStorage.setItem('cekJual','editsnyes');
  document.location.href = '../menu-penjualan.php';
  </script>
  ";
} else {
echo "
  <script>
  sessionStorage.setItem('cekJual','editsnno');
  document.location.href = '../menu-penjualan.php';
  </script>
  ";
}
?>