<div class="modal fade" id="editUser<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Data User</h5>
        <button type="button" class="btn btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="function/user-edit.php" method="post" id="oksubmit">
        <div class="modal-body">
            <input type="hidden" name="id" class="form-control" value="<?php echo $row['id']; ?>">
            <div class="form-group">
                <label>Nama</label>
                <input type="text" name="nama" class="form-control" value="<?php echo $row['nama']; ?>">      
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="text" name="email" class="form-control" value="<?php echo $row['email']; ?>">      
            </div>
            <div class="form-group">
                <label>Jabatan</label>
                <select class="form-select" name="jabatan" id="jabatan" >
                  <option>Pilih Jabatan</option>
                  <option <?php if ($row['jabatan'] == 'admin') { echo 'selected'; }?> value="Admin">Admin</option>
                  <option <?php if ($row['jabatan'] == 'sales') { echo 'selected'; }?> value="Sales">Sales</option>
                </select>
            </div>
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control" value="<?php echo $row['username']; ?>">      
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="text" name="password" class="form-control" value="<?php echo $row['password']; ?>">      
            </div>
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