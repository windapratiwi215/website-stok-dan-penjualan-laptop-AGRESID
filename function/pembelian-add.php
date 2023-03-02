<?php
session_start();

if (!isset($_SESSION["login"])) {
  header("Location: login-registrasi.php");
  exit;
}
require 'database-conn.php';

function pembelianAdd()
{
  global $conn;
  $tgl_masuk = $_POST["tgl_masuk"];
  $no_nota = $_POST["no_nota"];
  $item = $_POST["item"];
  $serial_number = $_POST["serial_number"];
  $cn = $_POST["cn"];
  $spp1 = $_POST["spp"];
  $spp = strtoupper($spp1);
  $ket1 = $_POST["ket"];
  $ket = strtoupper($ket1);
  $modal = $_POST["modal"];
  $id_user = $_SESSION["id_user"];

  $cekresult = 0;

  $id_sekarang = mysqli_query($conn, "SELECT id_masuk FROM barang_masuk ORDER BY id_masuk DESC limit 1");
  $cek_item = mysqli_query($conn, "SELECT * FROM stok");

  $kode = explode(" ", $item); //Memecah $kalimat dengan tanda pemisah ialah spasi

  // cek item, kalo belum ada, add ke tabel sku dulu
  $cek_sku = mysqli_query($conn, "SELECT * FROM tabel_sku WHERE item = '$item' ");
  $getAllBrand = mysqli_query($conn, "SELECT * FROM tabel_sku WHERE UPPER (ITEM) LIKE '%$kode[0]%'");
  $createSku = "$kode[0]";
  $createSku .= strval(mysqli_num_rows($getAllBrand));

  //ambil nilai dari tanggal yang sama
  $tanggal_lama = mysqli_query($conn, "SELECT * FROM barang_masuk where tgl_masuk='$tgl_masuk'");

  if (mysqli_num_rows($tanggal_lama) > 0) {

    foreach ($tanggal_lama as $sn) {
      //cek sn sama pada stok, jika ada sn yang sama pada stok data tidak boleh masuk
      $sn_stok = mysqli_query($conn, "SELECT serial_number FROM stok where serial_number = '$serial_number'");
      //jika serial number tersebut ada di stok maka data tidak boleh masuk
      if (mysqli_num_rows($sn_stok) > 0) {
        echo "
          <script>
          sessionStorage.setItem('cekBeli','snno');
          document.location.href = '../menu-pembelian.php';
          </script>
        ";
        $cekresult = 0;
        break;
      } else {
        //cek sn ditiap data
        $sn_lama = $sn['serial_number'];
        if ($serial_number == $sn_lama) {
          echo "
            <script>
            sessionStorage.setItem('cekBeli','sntno');
            document.location.href = '../menu-pembelian.php';
            </script>
          ";
          $cekresult = 0;
          break;
        } else {
          if (mysqli_num_rows($cek_sku) == 0) {
            mysqli_query($conn, "INSERT INTO tabel_sku VALUES('','$createSku','$item', '0')");
          }
          $ambil_sku =  mysqli_query($conn, "SELECT sku FROM tabel_sku WHERE item = '$item' ");
          foreach ($ambil_sku as $sku) {
            $ambil =  $sku['sku'];
            $query = "INSERT INTO barang_masuk 
                      VALUES('','$tgl_masuk', '$no_nota', 
                      '$item', '$serial_number',
                      '$cn', '$spp', '$ket', 
                      '$modal', '$ambil', '$id_user')
                  ";
          }

          // 

          // 
          mysqli_query($conn, $query);
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
        $cekresult++;
      }
    }
  } else {
    //cek sn sama pada stok, jika ada sn yang sama pada stok data tidak boleh masuk
    $sn_stok = mysqli_query($conn, "SELECT serial_number FROM stok where serial_number = '$serial_number'");
    //jika serial number tersebut ada di stok maka data tidak boleh masuk
    if (mysqli_num_rows($sn_stok) > 0) {
      echo "
          <script>
          sessionStorage.setItem('cekBeli','snno');
          document.location.href = '../menu-pembelian.php';
          </script>
        ";
    } else {
      if (mysqli_num_rows($cek_sku) == 0) {
        mysqli_query($conn, "INSERT INTO tabel_sku VALUES('','$createSku','$item','0')");
      }
      $ambil_sku =  mysqli_query($conn, "SELECT sku FROM tabel_sku WHERE item = '$item' ");
      foreach ($ambil_sku as $sku) {
        $ambil =  $sku['sku'];
        $query = "INSERT INTO barang_masuk 
                      VALUES('','$tgl_masuk', '$no_nota', 
                      '$item', '$serial_number',
                      '$cn', '$spp', '$ket', 
                      '$modal', '$ambil', '$id_user')
                  ";
      }
      mysqli_query($conn, $query);

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
      $cekresult++;
    }
  }
  return $cekresult;
}

if (pembelianAdd() > 0) {
  echo "
  <script>
  sessionStorage.setItem('cekBeli','addyes');
  document.location.href = '../menu-pembelian.php';
  </script>
  ";
} else {
  echo "
  <script>
  sessionStorage.setItem('cekBeli','addno');
  document.location.href = '../menu-pembelian.php';
  </script>
  ";
}
