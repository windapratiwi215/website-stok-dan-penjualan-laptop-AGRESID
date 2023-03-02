<script>
  var cekUser = sessionStorage.getItem('cekUser');
  if (cekUser == 'deleteyes') {
    Swal.fire(
      'Data berhasil dihapus', '',
      'success'
    );
    sessionStorage.setItem('cekUser', '');
  } else if (cekUser == 'deleteno') {
    Swal.fire(
      'Data gagal dihapus', '',
      'error'
    );
    sessionStorage.setItem('cekUser', '');
  } else if (cekUser == 'edityes') {
    Swal.fire(
      'Data berhasil diedit', '',
      'success'
    );
    sessionStorage.setItem('cekUser', '');
  } else if (cekUser == 'editno') {
    Swal.fire(
      'Data gagal diedit', '',
      'error'
    );
    sessionStorage.setItem('cekUser', '');
  } else if (cekUser == 'addyes') {
    Swal.fire(
      'Data berhasil ditambahkan', '',
      'success'
    );
    sessionStorage.setItem('cekUser', '');
  } else if (cekUser == 'addno') {
    Swal.fire(
      'Data gagal ditambahkan', '',
      'error'
    );
    sessionStorage.setItem('cekUser', '');
  } else if (cekUser == 'confyes') {
    Swal.fire(
      'Data berhasil dikonfirmasi', '',
      'success'
    );
    sessionStorage.setItem('cekUser', '');
  } else if (cekUser == 'confno') {
    Swal.fire(
      'Data gagal dikonfirmasi', '',
      'error'
    );
    sessionStorage.setItem('cekUser', '');
  } else if (cekUser == 'accyes') {
    Swal.fire(
      'Berhasil memberi akses kepada user', '',
      'success'
    );
    sessionStorage.setItem('cekUser', '');
  } else if (cekUser == 'accno') {
    Swal.fire(
      'Gagal memberi akses kepada user', '',
      'error'
    );
    sessionStorage.setItem('cekUser', '');
  } else if (cekUser == 'denyyes') {
    Swal.fire(
      'Berhasil menolak akses user', '',
      'success'
    );
    sessionStorage.setItem('cekUser', '');
  } else if (cekUser == 'denyno') {
    Swal.fire(
      'Gagal menolak akses user', '',
      'error'
    );
    sessionStorage.setItem('cekUser', '');
  } else if (cekUser == 'importyes') {
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
    sessionStorage.setItem('cekUser', '');
    sessionStorage.removeItem('nyes');
    sessionStorage.removeItem('nno');
    sessionStorage.removeItem('arrayrow');
  }
</script>