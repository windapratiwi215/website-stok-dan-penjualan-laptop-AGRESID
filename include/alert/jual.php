<script>
  var cekJual = sessionStorage.getItem('cekJual');
  if (cekJual == 'edityes') {
    Swal.fire(
      'Data berhasil diedit', '',
      'success'
    );
    sessionStorage.setItem('cekJual', '');
  } else if (cekJual == 'editno') {
    Swal.fire(
      'Data gagal diedit', '',
      'error'
    );
    sessionStorage.setItem('cekJual', '');
  } else if (cekJual == 'editsnyes') {
    Swal.fire(
      'SN berhasil ditukar', '',
      'success'
    );
    sessionStorage.setItem('cekJual', '');
  } else if (cekJual == 'editsnno') {
    Swal.fire(
      'SN gagal ditukar', '',
      'error'
    );
    sessionStorage.setItem('cekJual', '');
  }else if (cekJual == 'addyes') {
    Swal.fire(
      'Data berhasil ditambahkan', '',
      'success'
    );
    sessionStorage.setItem('cekJual', '');
  } else if (cekJual == 'addno') {
    Swal.fire(
      'Data gagal ditambahkan', '',
      'error'
    );
    sessionStorage.setItem('cekJual', '');
  } else if (cekJual == 'snno') {
    Swal.fire(
      'SN belum ada di stok', '',
      'error'
    );
    sessionStorage.setItem('cekJual', '');
  } else if (cekJual == 'importyes') {
    var nyes = sessionStorage.getItem('nyes');
    var nno = sessionStorage.getItem('nno');
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
        'Sebanyak ' + nyes + ' baris berhasil diimport.<br>Sebanyak ' + nno + ' baris gagal diimport.<br>Row excel yang gagal diimport ' + arrayrow + '.',
        'success'
      );
    }
    sessionStorage.setItem('cekJual', '');
    sessionStorage.removeItem('nyes');
    sessionStorage.removeItem('nno');
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