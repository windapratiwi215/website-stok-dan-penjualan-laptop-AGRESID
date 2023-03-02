<?php 
session_start();

if(!isset($_SESSION["login"])){
    header("Location: login-registrasi.php");
    exit;

}
require 'database-conn.php';

function pembelianEdit(){
  global $conn;
  $id = $_POST["id_masuk"];
  $tgl= $_POST["tgl_masuk"];
  $no_nota = $_POST["no_nota"];
  $item= $_POST["item"];
  $sn= $_POST["serial_number"];
  $cn= $_POST["cn"];
  $spp1 = $_POST["spp"];
  $spp = strtoupper($spp1);
  $ket1 = $_POST["ket"];
  $ket = strtoupper($ket1);
  $modal= $_POST["modal"];

  $kode = explode(" ",$item); //Memecah $kalimat dengan tanda pemisah ialah spasi
  

  $cek_sku = mysqli_query($conn, "SELECT * FROM tabel_sku WHERE item = '$item' ");
  $getAllBrand = mysqli_query($conn,"SELECT * FROM tabel_sku WHERE UPPER (ITEM) LIKE '%$kode[0]%'"); 
  $createSku = "$kode[0]";
  $createSku.= strval(mysqli_num_rows($getAllBrand));
  
  $id_user= $_SESSION["id_user"];

  if(mysqli_num_rows($cek_sku) == 0) {
    mysqli_query($conn, "INSERT INTO tabel_sku VALUES('','$createSku','$item', '0')");
  }
  $ambil_sku =  mysqli_query($conn, "SELECT sku FROM tabel_sku WHERE item = '$item' ");
  foreach($ambil_sku as $sku){
    $ambil =  $sku['sku'];
    
  

  mysqli_query($conn, "SET FOREIGN_KEY_CHECKS = 0	");	
  $query = "UPDATE barang_masuk 
            INNER JOIN stok ON stok.id_masuk = barang_masuk.id_masuk
            SET barang_masuk.tgl_masuk = '$tgl', stok.tgl_masuk = '$tgl',
                barang_masuk.no_nota = '$no_nota', stok.no_nota = '$no_nota',
                barang_masuk.item = '$item', stok.item = '$item',
                barang_masuk.serial_number = '$sn',  stok.serial_number = '$sn', 
                barang_masuk.cn = '$cn', stok.cn = '$cn',
                barang_masuk.spp = '$spp',  stok.spp = '$spp', 
                barang_masuk.ket = '$ket',  stok.ket = '$ket', 
                barang_masuk.modal = '$modal',  stok.modal = '$modal', 
                barang_masuk.sku = '$ambil',  stok.sku = '$ambil', 
                barang_masuk.id_user = '$id_user',  stok.id_user = '$id_user'

            WHERE barang_masuk.id_masuk=$id
          ";
  }
  mysqli_query($conn, $query);

  return mysqli_affected_rows($conn);
}

if(pembelianEdit()>0){
  echo "
  <script>
  sessionStorage.setItem('cekBeli','edityes');
  document.location.href = '../menu-pembelian.php';
  </script>
  ";
} else {
echo "
  <script>
  sessionStorage.setItem('cekBeli','editno');
  document.location.href = '../menu-pembelian.php';
  </script>
  ";
}