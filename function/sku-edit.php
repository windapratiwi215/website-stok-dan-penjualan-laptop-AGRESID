<?php 
session_start();

if(!isset($_SESSION["login"])){
    header("Location: login-registrasi.php");
    exit;

}
require 'database-conn.php';





function skuEdit(){
  global $conn;

  $id = $_POST["id_sku"];
  $sku_new = $_POST["sku"];
  

  $sku_sekarang = mysqli_query($conn, "SELECT sku FROM tabel_sku WHERE id_sku=$id");



  foreach($sku_sekarang as $s){
    $sku_old = $s['sku'];
    mysqli_query($conn, "SET FOREIGN_KEY_CHECKS = 0	");	

    $cek_tabel_penjualan = mysqli_query($conn, "SELECT * FROM tabel_penjualan where sku='$sku_old'");
    $cek_retur = mysqli_query($conn, "SELECT * FROM retur_barang  where sku='$sku_old'");
    $cek_stok = mysqli_query($conn, "SELECT * FROM stok where sku='$sku_old' " );
    $cek_tabel_pembelian = mysqli_query($conn, "SELECT * FROM barang_masuk where sku='$sku_old'");

      //jika tabel pembelian,  stok, retur, penjualan == 0
      if(mysqli_num_rows($cek_tabel_pembelian) == 0 &  mysqli_num_rows($cek_stok) == 0 & mysqli_num_rows($cek_retur) == 0  & mysqli_num_rows($cek_tabel_penjualan) == 0 ) {   
        $query = "UPDATE tabel_sku
            SET tabel_sku.sku='$sku_new' 
            WHERE tabel_sku.sku='$sku_old'";  
      //jika tabel pembelian !=0, stok!=0, retur!=0, penjualan !=0
      }elseif(mysqli_num_rows($cek_tabel_pembelian) != 0 &  mysqli_num_rows($cek_stok) != 0 & mysqli_num_rows($cek_retur) != 0  & mysqli_num_rows($cek_tabel_penjualan) != 0){
        $query = "UPDATE tabel_sku
              INNER JOIN barang_masuk ON tabel_sku.sku = barang_masuk.sku
              INNER JOIN stok ON tabel_sku.sku = stok.sku
              INNER JOIN retur_barang ON tabel_sku.sku = retur_barang.sku
              INNER JOIN tabel_penjualan ON tabel_sku.sku = tabel_penjualan.sku
                SET tabel_sku.sku='$sku_new',barang_masuk.sku = '$sku_new', stok.sku = '$sku_new' , retur_barang.sku= '$sku_new', tabel_penjualan.sku= '$sku_new'  
                WHERE tabel_sku.sku='$sku_old' AND stok.sku='$sku_old' AND barang_masuk.sku='$sku_old'AND retur_barang.sku='$sku_old' AND tabel_penjualan.sku='$sku_old'";   
      }
      //jika tabel pembelian !=0, stok!=0, retur!=0, penjualan ==0
      elseif(mysqli_num_rows($cek_tabel_pembelian) != 0 &  mysqli_num_rows($cek_stok) != 0 & mysqli_num_rows($cek_retur) != 0  & mysqli_num_rows($cek_tabel_penjualan) == 0){
        $query = "UPDATE tabel_sku
              INNER JOIN barang_masuk ON tabel_sku.sku = barang_masuk.sku
              INNER JOIN stok ON tabel_sku.sku = stok.sku
              INNER JOIN retur_barang ON tabel_sku.sku = retur_barang.sku
                SET tabel_sku.sku='$sku_new',barang_masuk.sku = '$sku_new', stok.sku = '$sku_new' , retur_barang.sku= '$sku_new'
                WHERE tabel_sku.sku='$sku_old' AND stok.sku='$sku_old' AND barang_masuk.sku='$sku_old'AND retur_barang.sku='$sku_old'";   
      }
      //jika tabel pembelian !=0, stok!=0, retur==0, penjualan !=0
      elseif(mysqli_num_rows($cek_tabel_pembelian) != 0 &  mysqli_num_rows($cek_stok) != 0 & mysqli_num_rows($cek_retur) == 0  & mysqli_num_rows($cek_tabel_penjualan) != 0){
        $query = "UPDATE tabel_sku
            INNER JOIN barang_masuk ON tabel_sku.sku = barang_masuk.sku
            INNER JOIN stok ON tabel_sku.sku = stok.sku
            INNER JOIN tabel_penjualan ON tabel_sku.sku = tabel_penjualan.sku
              SET tabel_sku.sku='$sku_new',barang_masuk.sku = '$sku_new', stok.sku = '$sku_new', tabel_penjualan.sku= '$sku_new'  
              WHERE tabel_sku.sku='$sku_old' AND stok.sku='$sku_old' AND barang_masuk.sku='$sku_old' AND tabel_penjualan.sku='$sku_old'";  
      }
      //jika tabel pembelian !=0, stok!=0, retur==0, penjualan ==0
      elseif(mysqli_num_rows($cek_tabel_pembelian) != 0 &  mysqli_num_rows($cek_stok) != 0 & mysqli_num_rows($cek_retur) == 0  & mysqli_num_rows($cek_tabel_penjualan) == 0){
        $query = "UPDATE tabel_sku
            INNER JOIN barang_masuk ON tabel_sku.sku = barang_masuk.sku
            INNER JOIN stok ON tabel_sku.sku = stok.sku
              SET tabel_sku.sku='$sku_new',barang_masuk.sku = '$sku_new', stok.sku = '$sku_new'  
              WHERE tabel_sku.sku='$sku_old' AND stok.sku='$sku_old' AND barang_masuk.sku='$sku_old'";  
      }
      //jika tabel pembelian !=0, stok==0, retur!=0, penjualan !=0
      elseif(mysqli_num_rows($cek_tabel_pembelian) != 0 &  mysqli_num_rows($cek_stok) == 0 & mysqli_num_rows($cek_retur) != 0  & mysqli_num_rows($cek_tabel_penjualan) != 0){
        $query = "UPDATE tabel_sku
              INNER JOIN barang_masuk ON tabel_sku.sku = barang_masuk.sku
              INNER JOIN retur_barang ON tabel_sku.sku = retur_barang.sku
              INNER JOIN tabel_penjualan ON tabel_sku.sku = tabel_penjualan.sku
                SET tabel_sku.sku='$sku_new',barang_masuk.sku = '$sku_new', retur_barang.sku= '$sku_new', tabel_penjualan.sku= '$sku_new'  
                WHERE tabel_sku.sku='$sku_old'  AND barang_masuk.sku='$sku_old'AND retur_barang.sku='$sku_old' AND tabel_penjualan.sku='$sku_old'";   
      }
      //jika tabel pembelian !=0, stok==0, retur!=0, penjualan ==0
      elseif(mysqli_num_rows($cek_tabel_pembelian) != 0 &  mysqli_num_rows($cek_stok) == 0 & mysqli_num_rows($cek_retur) != 0  & mysqli_num_rows($cek_tabel_penjualan) == 0){
        $query = "UPDATE tabel_sku
            INNER JOIN barang_masuk ON tabel_sku.sku = barang_masuk.sku
            INNER JOIN retur_barang ON tabel_sku.sku = retur_barang.sku
              SET tabel_sku.sku='$sku_new',barang_masuk.sku = '$sku_new', retur_barang.sku= '$sku_new'
              WHERE tabel_sku.sku='$sku_old'  AND barang_masuk.sku='$sku_old'AND retur_barang.sku='$sku_old' ";   
          }
      //jika tabel pembelian !=0, stok==0, retur==0, penjualan !=0
      elseif(mysqli_num_rows($cek_tabel_pembelian) != 0 &  mysqli_num_rows($cek_stok) == 0 & mysqli_num_rows($cek_retur) == 0  & mysqli_num_rows($cek_tabel_penjualan) != 0){
        $query = "UPDATE tabel_sku
            INNER JOIN barang_masuk ON tabel_sku.sku = barang_masuk.sku
            INNER JOIN tabel_penjualan ON tabel_sku.sku = tabel_penjualan.sku
              SET tabel_sku.sku='$sku_new',barang_masuk.sku = '$sku_new', tabel_penjualan.sku= '$sku_new'  
              WHERE tabel_sku.sku='$sku_old'  AND barang_masuk.sku='$sku_old' AND tabel_penjualan.sku='$sku_old'";  
      }
      //jika tabel pembelian !=0, stok==0, retur==0, penjualan ==0
      elseif(mysqli_num_rows($cek_tabel_pembelian) != 0 &  mysqli_num_rows($cek_stok) == 0 & mysqli_num_rows($cek_retur) == 0  & mysqli_num_rows($cek_tabel_penjualan) == 0){
        $query = "UPDATE tabel_sku
            INNER JOIN barang_masuk ON tabel_sku.sku = barang_masuk.sku
              SET tabel_sku.sku='$sku_new',barang_masuk.sku = '$sku_new'
              WHERE tabel_sku.sku='$sku_old'  AND barang_masuk.sku='$sku_old'";  
      }else{
        echo "
        <script>
          alert('SKU gagal diedit');
          document.location.href = '../menu-sku.php';
        </script>
      ";
      }
      
    mysqli_query($conn, $query);
  
    return mysqli_affected_rows($conn);
    }
      
}
if(skuEdit()>0){
  echo "
  <script>
  sessionStorage.setItem('cekSku','edityes');
  document.location.href = '../menu-sku.php';
  </script>
  ";
} else {
echo "
  <script>
  sessionStorage.setItem('cekSku','editno');
  document.location.href = '../menu-sku.php';
  </script>
  ";
}
