<div class="modal fade" id="uploadRetur" tabindex="-1" data-bs-backdrop="static" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Import File Daftar Retur</h5>
        <button type="button" class="btn btn-round btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="function/retur-import.php" method="post" enctype="multipart/form-data" id="oksubmit">
        <div class="modal-body">
        <a class="btn btn-sm btn-success" href="files/template-retur.xlsx" download>
            <i class="fas fa-download fa-sm text-whites"></i>
            Download template .xlsx
          </a>
          <input class="mt-2 form-control" type="file" name="file" accept=".xlsx">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-round btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <input type="submit" name="import" class="btn btn-round btn-info color-theme" value="Submit"></input>
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