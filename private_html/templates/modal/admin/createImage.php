<!-- Modal -->
<div class="modal fade" id="createImageModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="createImageModalLable" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        <div class="modal-header">
                <h1 class="modal-title fs-5" id="createImageModalLable">Skapa Produkt</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="createImageModalInputImage" class="form-label">Bild</label>
                    <input type="file" class="form-control" id="createImageModalInputImage" name="image">
                </div>
            </div>
            <div class="modal-footer container justify-content-around">
                <button type="button" class="btn btn-danger col-5" data-bs-dismiss="modal">Avbryt</button>
                <button type="button" onclick="createImage();" class="btn btn-success col-5">Skapa</button>
            </div>
        </div>
    </div>
</div>