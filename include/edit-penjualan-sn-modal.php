<div class="modal fade" id="editSNPenjualan<?php echo $row['id_penjualan']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Retur Barang Dari User</h5>
        <button type="button" class="btn btn-round btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="function/penjualan-sn-edit.php" method="post" id="oksubmit">
        <div class="modal-body">
          <?php
          global $conn;
          $skuNow = $row['sku'];
          $ambilSku = mysqli_query($conn, "SELECT * FROM stok WHERE sku = '$skuNow' ")
          ?>
          <input type="hidden" name="id_penjualan" class="form-control" value="<?php echo $row['id_penjualan']; ?>">
          <div class="form-group">
                <label>Tanggal</label>
                <input type="date" name="tgl_jual" class="form-control" value="<?php echo date("Y-m-d"); ?>">    
            </div>
            <div class="form-group">
                <label>Nota Tukar Barang</label>
                <input type="input" name="nota_jual" class="form-control" required="true">    
            </div>
           
          <div class="form-group">
            <label>SKU</label>
            <input type="text" name="sku" class="form-control" value="<?php echo $row['sku']; ?>" disabled>
          </div>
          <div class="form-group">
            <label>SN</label>
            <select class="form-select" name="serial_number" id="serial_number">
              <option value="<?php echo $row['serial_number'] ?>"> <?php echo $row['serial_number'] ?> </option>
              <?php foreach ($ambilSku as $num) : ?>
                <option value="<?php echo $num['serial_number'] ?>"> <?php echo $num['serial_number'] ?> </option>
              <?php endforeach; ?>
            </select>
          </div>
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