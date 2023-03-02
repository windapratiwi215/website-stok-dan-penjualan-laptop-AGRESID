<div class="modal fade" id="editToko<?php echo $row['id_toko']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Toko</h5>
        <button type="button" class="btn btn-round btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="function/toko-edit.php" method="post" id="oksubmit">
        <div class="modal-body">
         
          <div class="form-group">
            <label>Nama Toko</label>
            <input type="text" name="nama" class="form-control" value="<?php echo $row['sku']; ?>" >
          </div>
          <div class="form-group">
            <label>Kode Toko</label>
            <input type="text" name="kode" class="form-control" value="<?php echo $row['item']; ?>">
          </div>
         
          <input type="hidden" name="id_toko" class="form-control" value="<?php echo $row['id_toko']; ?>">  
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-round btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <input type="submit" name="edit" class="btn btn-round btn-info" value="Save"></input>
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