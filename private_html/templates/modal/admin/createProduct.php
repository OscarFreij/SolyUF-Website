<!-- Modal -->
<div class="modal fade" id="createProductModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="createProductModalLable" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        <div class="modal-header">
                <h1 class="modal-title fs-5" id="createProductModalLable">Skapa Produkt</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="createProductModalInputTitle" class="form-label">Titel</label>
                    <input type="text" class="form-control" id="createProductModalInputTitle" name="name" placeholder="Produktnamn">
                </div>
                <div class="mb-3">
                    <label for="createProductModalInputImage" class="form-label">Bilder</label>
                    <input type="text" class="form-control" id="createProductModalInputImage" name="image">
                </div>
                <div class="mb-3">
                    <label for="createProductModalInputDescription" class="form-label">Beskrivning</label>
                    <textarea class="form-control" id="createProductModalInputDescription" name="description" placeholder="Produktbeskrivning" rows="5"></textarea>
                </div>
                <div class="mb-3">
                    <label for="createProductModalInputPrice" class="form-label">Pris</label>
                    <input type="number" class="form-control" id="createProductModalInputPrice" name="price" placeholder="0">
                </div>
            </div>
            <div class="modal-footer container justify-content-around">
                <button type="button" class="btn btn-danger col-5" data-bs-dismiss="modal">Avbryt</button>
                <button type="button" onclick="createProduct();" class="btn btn-success col-5">Skapa</button>
            </div>
        </div>
    </div>
</div>