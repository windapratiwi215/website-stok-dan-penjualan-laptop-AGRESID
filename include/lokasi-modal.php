<div class="modal fade" id="lokasi<?php echo $row['sku']; ?>" tabindex="-1" role="dialog"
  aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Lokasi Item</h5>

        <button type="button" class="btn btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p class="overflow-auto"><?= $row["item"] ?></p>
        <?php $sku = $row['sku'];
        $lokasi = query("SELECT count(ket), ket from stok WHERE sku = '$sku' GROUP BY(ket)");
        foreach ($lokasi as $lok) : ?>
        <?php if($lok['ket'] =='') :?>
          <label class="font-size-md">Gudang : <?= $lok['count(ket)']; ?></label>
        <?php else:?>
          <label class="font-size-md"><?= $lok['ket'] ?>: <?= $lok['count(ket)']; ?></label>
        <?php endif;?>
        
        <br>
        <?php endforeach; ?>
        <!-- coba -->


        <!-- end coba -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-round btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>