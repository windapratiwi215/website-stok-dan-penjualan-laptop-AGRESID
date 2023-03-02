<div class="modal fade" id="changeColor" data-bs-backdrop="static" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="logoutModalLabel">Ganti Warna</h5>
                <button type="button" class="btn btn-round btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <label class="form-label" for="favcolor">Select your favorite color:</label>
                <input type="color" class="form-control" id="favcolor" name="favcolor" value="#11cdef"><br><br>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-round btn-secondary" data-bs-dismiss="modal" onclick="change()">OK</button>
                <input type="button" class="btn btn-round btn-info color-theme" onclick="change()" value="Apply">
            </div>
        </div>
    </div>
</div>