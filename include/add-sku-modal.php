<div class="modal fade" id="addSku" tabindex="-1" role="dialog" aria-labelledby="addSKULabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addSKULabel">Add Data SKU</h5>
        <button type="button" class="btn btn-round btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="function/sku-add.php" method="post" id="oksubmit">
        <div class="modal-body">
            <div class="form-group">
                <label>SKU</label>
                <input type="text" name="sku" class="form-control" required="true">      
            </div>
            <div class="form-group">
                <label>ITEM</label>
                <input type="text" name="item" class="form-control" required="true">      
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