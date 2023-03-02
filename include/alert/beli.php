<script>
  var cekBeli = sessionStorage.getItem('cekBeli');
  if (cekBeli == 'deleteyes') {
    Swal.fire(
      'Data berhasil dihapus', '',
      'success'
    );
    sessionStorage.setItem('cekBeli', '');
  } else if (cekBeli == 'deleteno') {
    Swal.fire(
      'Data gagal dihapus', '',
      'error'
    );
    sessionStorage.setItem('cekBeli', '');
  } else if (cekBeli == 'edityes') {
    Swal.fire(
      'Data berhasil diedit', '',
      'success'
    );
    sessionStorage.setItem('cekBeli', '');
  } else if (cekBeli == 'editno') {
    Swal.fire(
      'Data gagal diedit', '',
      'error'
    );
    sessionStorage.setItem('cekBeli', '');
  } else if (cekBeli == 'addyes') {
    Swal.fire(
      'Data berhasil ditambahkan', '',
      'success'
    );
    sessionStorage.setItem('cekBeli', '');
  } else if (cekBeli == 'addno') {
    Swal.fire(
      'Data gagal ditambahkan', '',
      'error'
    );
    sessionStorage.setItem('cekBeli', '');
  } else if (cekBeli == 'snno') {
    Swal.fire(
      'Data gagal ditambahkan', 
      'Barang sudah ada di stok',
      'error'
    );
    sessionStorage.setItem('cekBeli', '');
  } else if (cekBeli == 'sntno') {
    Swal.fire(
      'Data gagal ditambahkan', 
      'Serial number dan tanggal tidak boleh sama',
      'error'
    );
    sessionStorage.setItem('cekBeli', '');
  } else if (cekBeli == 'importyes') {
    var nyes = sessionStorage.getItem('nyes');
    var nno = sessionStorage.getItem('nno');
    var nsku = sessionStorage.getItem('nsku');
    var arrayrow = sessionStorage.getItem('arrayrow');
    if (nno == 0) {
      Swal.fire(
        'Data berhasil diimport',
        'Sebanyak ' + nyes + ' baris berhasil diimport.<br>Sebanyak ' + nno + ' baris gagal diimport.',
        'success'
      );
    } else {
      Swal.fire(
        'Data berhasil diimport',
        'Sebanyak ' + nyes + ' baris berhasil diimport.<br>Ada ' + nsku + ' SKU baru ditambahkan.<br>Sebanyak ' + nno + ' baris gagal diimport.<br>Row excel yang gagal diimport ' + arrayrow + '.',
        'success'
      );
    }
    sessionStorage.setItem('cekBeli', '');
    sessionStorage.removeItem('nyes');
    sessionStorage.removeItem('nno');
    sessionStorage.removeItem('nsku');
    sessionStorage.removeItem('arrayrow');
  }

  var cekAkses = sessionStorage.getItem('cekAkses');
  if (cekAkses == 'accsent') {
    Swal.fire(
      'User berhasil mengirim permintaan akses', '',
      'success'
    );
    sessionStorage.setItem('cekAkses', '');
  } else if (cekAkses == 'accnotsent') {
    Swal.fire(
      'User gagal mengirim permintaan akses', '',
      'success'
    );
    sessionStorage.setItem('cekAkses', '');
  }
</script>