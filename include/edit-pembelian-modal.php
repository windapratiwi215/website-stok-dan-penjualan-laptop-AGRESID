<div class="modal fade" id="editPembelian<?php echo $row['id_masuk']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Data Pembelian</h5>
        <button type="button" class="btn btn-round btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="function/pembelian-edit.php" method="post" id="oksubmit">
        <div class="modal-body">
          <input type="hidden" name="id_masuk" class="form-control" value="<?php echo $row['id_masuk']; ?>">
          <div class="form-group">
            <label>Tanggal</label>
            <input type="text" name="tgl_masuk" class="form-control" value="<?php echo $row['tgl_masuk']; ?>">
          </div>
          <div class="form-group">
            <label>No Nota</label>
            <input type="text" name="no_nota" class="form-control" value="<?php echo $row['no_nota']; ?>">
          </div>
          <div class="form-group">
            <label>Item</label>
            <input type="text" name="item" class="form-control" value="<?php echo $row['item']; ?>">
          </div>
          <div class="form-group">
            <label>SN</label>
            <input type="text" name="serial_number" class="form-control" value="<?php echo $row['serial_number']; ?>">
          </div>
          <div class="form-group">
            <label>CN</label>
            <input type="text" name="cn" class="form-control" value="<?php echo $row['cn']; ?>">
          </div>
          <div class="form-group">
            <label>SPP</label>
            <input type="text" name="spp" class="form-control" value="<?php echo $row['spp']; ?>">
          </div>
          <div class="form-group">
            <label>Lokasi</label>
            <input type="text" name="ket" class="form-control" value="<?php echo $row['ket']; ?>">
          </div>
          <div class="form-group">
            <label>Modal</label>
            <input type="text" name="modal" class="form-control" value="<?php echo $row['modal']; ?>">
          </div>
          <input type="hidden" name="sku" class="form-control" value="<?php echo $row['sku']; ?>">
          <input type="hidden" name="id_user" class="form-control" value="<?php echo $row['id_user']; ?>">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-round btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <input type="submit" name="edit" class="btn btn-round btn-info color-theme" value="Save"></input>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  $(document).ready(function() {
    $('#oksubmit').submit(function() {
      $('#loadersubmit').css('visibility', 'visible');
      $('#loadersubmit').show();
    });
  })
</script>
<div class="lds-dual-ring" id="loadersubmit" style="visibility:hidden; display:none;"></div>