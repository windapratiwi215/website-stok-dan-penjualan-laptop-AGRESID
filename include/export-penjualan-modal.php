<!-- Modal -->
<div class="modal fade" id="exportPenjualan" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exportModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exportModalLabel">Export Penjualan</h5>
        <button type="button" class="btn btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="function/penjualan-export.php" method="post" enctype="multipart/form-data" id="oksubmit">
        <div class="modal-body">
          <input type="date" name="start-date">
          <input type="date" name="end-date">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-round btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <input type="submit" name="export" class="btn btn-round btn-info color-theme" value="Export by date"></input>
          <a class="btn btn-round btn-info color-theme" href="function/penjualan-export-all.php">Export all</a>
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