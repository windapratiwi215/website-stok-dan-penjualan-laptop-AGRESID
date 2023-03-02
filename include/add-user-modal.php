<div class="modal fade" id="addUser" tabindex="-1" role="dialog" aria-labelledby="addUserLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addUserLabel">Add Data User</h5>
        <button type="button" class="btn btn-round btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="function/user-add.php" method="post" id="oksubmit">
        <div class="modal-body">
          <div class="form-group">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control" required="true">
          </div>
          <div class="form-group">
            <label>Email</label>
            <input type="text" name="email" class="form-control" required="true">
          </div>
          <div class="form-group">
            <label>Jabatan</label>
            <select class="form-select" name="jabatan" id="jabatan" required="true">
              <option>Pilih Jabatan</option>
              <option value="Admin">Admin</option>
              <option value="Sales">Sales</option>
            </select>
          </div>
          <div class="form-group">
            <label>Username</label>
            <input type="text" name="username" class="form-control" required="true">
          </div>
          <div class="form-group">
            <label>Password</label>
            <input type="text" name="password" class="form-control" required="true">
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