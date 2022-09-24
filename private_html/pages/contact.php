<div class="container py-5">
  <div class="row my-3">
    <span class="fs-1 text-center text">
      Kontaktformulär
    </span>
  </div>
  <div class="row">
    <span class="fs-4 text-center text my-3">
      Skriv dina kontaktuppgifter så kontaktar vi dig när första möjligheten dyker upp :)
    </span>
    <form class="container">
      <div class="mb-3">
        <label for="email" class="form-label">Epost (Krävs)</label>
        <input type="email" class="form-control" id="email" placeholder="namn@domän.com" require>
      </div>
      <div class="mb-3">
        <label for="phone" class="form-label">Telefonnummer</label>
        <input type="tel" class="form-control" id="phone" placeholder="+46 123456789">
      </div>
      <div class="mb-3">
        <label for="message" class="form-label">Meddelande (Krävs)</label>
        <textarea class="form-control" id="message" rows="5"></textarea>
      </div>
      <div class="col-12">
        <button type="button" onclick="sendMessage()" class="btn btn-success mb-3 col-12">Skicka meddelande</button>
      </div>
    </form>
  </div>
</div>