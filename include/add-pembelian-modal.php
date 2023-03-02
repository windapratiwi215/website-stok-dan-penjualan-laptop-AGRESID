<div class="modal fade" id="addPembelian" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Data Pembelian</h5>
        <button type="button" class="btn btn-round btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="function/pembelian-add.php" method="post" id="oksubmit">
        <div class="modal-body">
            <div class="form-group">
                <label>Tanggal</label>
                <input type="date" name="tgl_masuk" class="form-control" value="<?php echo date("Y-m-d"); ?>">    
            </div>
            <div class="form-group">
                <label>No Nota</label>
                <input type="text" name="no_nota" class="form-control" required="true">      
            </div>
            <div class="form-group">
                <label>Item</label>
                <input type="text" name="item" class="form-control" required="true">      
            </div>
            <div class="form-group">
                <label>SN</label>
                <input type="text" name="serial_number" class="form-control" required="true">      
            </div>
            <div class="form-group">
                <label>CN</label>
                <input type="text" name="cn" class="form-control">      
            </div>
            <div class="form-group">
                <label>SPP</label>
                <input type="text" name="spp" class="form-control">      
            </div>
            <div class="form-group">
                <label>Lokasi Barang</label>
                <input type="text" name="ket" class="form-control">      
            </div>
            <div class="form-group">
                <label>Modal</label>
                <input type="text" name="modal" class="form-control">      
            </div>
      
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-round btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <input type="submit" name="edit" class="btn btn-round btn-info color-theme" value="Add"></input>
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