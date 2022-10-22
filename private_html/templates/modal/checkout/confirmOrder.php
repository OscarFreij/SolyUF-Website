<!-- Modal -->
<div class="modal fade" id="confirmOrderModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="confirmOrderModalLable" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="confirmOrderModalLable">Lägg beställning</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="confirmOrderModalInputEmail" class="form-label">Mejladress</label>
                    <input type="email" class="form-control" id="confirmOrderModalInputEmail" name="email" placeholder="namn@domän.com">
                </div>
                <div class="mb-3">
                    <label for="confirmOrderModalInputPhone" class="form-label">Telefonnummer</label>
                    <input type="tel" class="form-control" id="confirmOrderModalInputPhone" name="phone" placeholder="0123456789 eller +46 123456789">
                </div>
                <div class="mb-3">
                    <label for="confirmOrderModalInputAdress" class="form-label">Adress</label>
                    <input type="address" class="form-control" id="confirmOrderModalInputAdress" name="address" placeholder="Gångvägen 1A">
                </div>
                <div class="mb-3">
                    <label for="confirmOrderModalInputPostalCode" class="form-label">Postkod</label>
                    <input type="text" class="form-control" id="confirmOrderModalInputPostalCode" name="postalcode" placeholder="12345">
                </div>
                <div class="mb-3">
                    <label for="confirmOrderModalInputCity" class="form-label">Ort</label>
                    <input type="text" class="form-control" id="confirmOrderModalInputCity" name="city" placeholder="Stockholm">
                </div>
            </div>
            <div class="modal-footer container justify-content-around">
                <button type="button" class="btn btn-danger col-5" data-bs-dismiss="modal">Avbryt</button>
                <button type="button" onclick="placeOrder();" class="btn btn-success col-5">Skicka beställning</button>
            </div>
        </div>
    </div>
</div>