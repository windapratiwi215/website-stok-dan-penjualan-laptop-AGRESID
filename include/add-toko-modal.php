<div class="modal fade" id="addToko" tabindex="-1" role="dialog" aria-labelledby="addTokoLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addTokoLabel">Add Data Toko</h5>
        <button type="button" class="btn btn-round btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="function/toko-add.php" method="post" id="oksubmit">
        <div class="modal-body">
            <div class="form-group">
                <label>Nama Toko</label>
                <input type="text" name="nama" class="form-control" required="true">      
            </div>
            <div class="form-group">
                <label>Kode Toko</label>
                <input type="text" name="kode" class="form-control" required="true">      
            </div>
         
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