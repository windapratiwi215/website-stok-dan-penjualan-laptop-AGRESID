<script src="assets/js/html5-qrcode.min.js"></script>

<div class="modal fade" id="addPenjualan" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tambah Data Penjualan</h5>
        <button type="button" class="btn btn-round btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="function/penjualan-add.php" method="post" id="oksubmit">
        <div class="modal-body">
          <div class="form-group">
            <label>Tanggal</label>
            <input type="date" name="tgl_jual" class="form-control" value="<?php echo date("Y-m-d"); ?>">
          </div>
          <div class="form-group">
            <label>Nota Jual</label>
            <input type="input" name="nota_jual" class="form-control" required="true">
          </div>
          <div class="form-group mb-0">
            <label>Lokasi Terjual</label>
            <select class="form-select" name="kode" id="kode">
              <!-- panggil nama toko -->
              <?php
              global $conn;

              $ambilToko = mysqli_query($conn, "SELECT * FROM toko ")
              ?>
              <option required="true">Pilih Kode</option>
              <?php foreach ($ambilToko as $num) : ?>
                <option value="<?php echo $num['kode_toko'] ?>"> <?php echo $num['nama_toko'] ?> </option>
              <?php endforeach; ?>

            </select>
          </div>
          <label class="mb-3"><a href="#" class="d-sm-inline-block text-decoration-underline" data-bs-toggle="modal" data-bs-target="#addToko">
              <i class="fas fa-plus fa-sm text-dark"></i> Add Toko</a></label>

          <div id="select">
            <div class="form-group">
              <label>Item</label>
              <select class="form-select" id="item">
                <?php
                global $conn;

                $ambilItem = mysqli_query($conn, "SELECT DISTINCT sku, item FROM stok ORDER BY item")
                ?>
                <option required="true">Pilih Item</option>
                <?php foreach ($ambilItem as $num) : ?>
                  <option value="<?php echo $num['sku'] ?>"> <?php echo $num['item'] ?> </option>
                <?php endforeach; ?>

              </select>
            </div>
            <div class="form-group">
              <label>Serial Number</label>
              <select class="form-select" name="serial_number1" id="sn">
                <option value="">---SELECT ITEM FIRST---</option>
              </select>
            </div>
          </div>

          <div id="scan" style="display: none;">
            <div class="form-group">
              <label>Serial Number</label>
              <input id="coba" name="serial_number2" class="form-control">
            </div>
            <div class="form-group">
              <div class="form-control" style="width:462px;" id="reader"></div>
            </div>
          </div>

          <div class="form-group">
            <div class="btn btn-round btn-light" onclick="showSelect()">Manual</div>
            <div class="btn btn-round btn-light" onclick="showScan()">Scan</div>
          </div>

          <input type="hidden" name="id_user" class="form-control" value="14">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-round btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <input type="submit" name="edit" class="btn btn-round btn-info color-theme" value="Add"></input>
        </div>
      </form>
    </div>
  </div>
</div>

<?php require 'add-toko-modal.php'; ?>

<script>
  function showSelect() {
    var id = document.getElementById("select");
    var ids = document.getElementById("scan");
    if (id.style.display === "none"){
      id.style.display = "block";
      ids.style.display = "none"
      document.getElementById("coba").value = "";
    } else {
      id.style.display = "none";
      ids.style.display = "block"
    }
  }

  function showScan() {
    var id = document.getElementById("scan");
    var ids = document.getElementById("select");
    if (id.style.display === "none"){
      id.style.display = "block";
      ids.style.display = "none"
      document.getElementById("sn").innerHTML = "<option value=''>---SELECT ITEM FIRST---</option>";
    } else {
      id.style.display = "none";
      ids.style.display = "block"
    }
  }
</script>

<script type="text/javascript">
  function onScanSuccess(qrCodeMessage) {
    document.getElementById("coba").value = qrCodeMessage;

  }

  function onScanError(errorMessage) {
    //handle scan error
  }

  var html5QrcodeScanner = new Html5QrcodeScanner(
    "reader", {
      fps: 10,
      qrbox: 250
    });
  html5QrcodeScanner.render(onScanSuccess, onScanError);
</script>

<script type="text/javascript">
  $(document).ready(function() {
    $('#item').on('change', function() {
      var item = $(this).val();
      if (item) {
        $.ajax({
          type: 'POST',
          url: 'function/penjualan-option.php',
          data: 'q=' + item,
          success: function(html) {
            $('#sn').html(html);

          }
        });
      } else {
        $('#sn').html('<option value="">Select category first</option>');
      }
    });
  });
</script>

<script>
  $(document).ready(function() {
    $('#oksubmit').submit(function() {
      $('#loadersubmit').css('visibility', 'visible');
      $('#loadersubmit').show();
    });
  })
</script>
<div class="lds-dual-ring" id="loadersubmit" style="visibility:hidden; display:none;"></div>