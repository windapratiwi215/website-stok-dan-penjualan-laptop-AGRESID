<script>
  var cekSku = sessionStorage.getItem('cekSku');
  if (cekSku == 'edityes') {
    Swal.fire(
      'Data berhasil diedit', '',
      'success'
    );
    sessionStorage.setItem('cekSku', '');
  } else if (cekSku == 'editno') {
    Swal.fire(
      'Data gagal diedit', '',
      'error'
    );
    sessionStorage.setItem('cekSku', '');
  } else if (cekSku == 'addyes') {
    Swal.fire(
      'Data berhasil ditambahkan', '',
      'success'
    );
    sessionStorage.setItem('cekSku', '');
  } else if (cekSku == 'addno') {
    Swal.fire(
      'Data gagal ditambahkan', '',
      'error'
    );
    sessionStorage.setItem('cekSku', '');
  } else if (cekSku == 'importyes') {
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
    sessionStorage.setItem('cekSku', '');
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