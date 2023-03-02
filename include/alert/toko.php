<script>
  var cekToko = sessionStorage.getItem('cekToko');
  if (cekToko == 'deleteyes') {
    Swal.fire(
      'Data berhasil dihapus', '',
      'success'
    );
    sessionStorage.setItem('cekToko', '');
  } else if (cekToko == 'deleteno') {
    Swal.fire(
      'Data gagal dihapus', '',
      'error'
    );
    sessionStorage.setItem('cekToko', '');
  } else if (cekToko == 'addyes') {
    Swal.fire(
      'Data berhasil ditambahkan', '',
      'success'
    );
    sessionStorage.setItem('cekToko', '');
  } else if (cekToko == 'addno') {
    Swal.fire(
      'Data gagal ditambahkan', '',
      'error'
    );
    sessionStorage.setItem('cekToko', '');
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