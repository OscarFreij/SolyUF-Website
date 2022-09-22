<div class="container py-5">
  <div class="row my-3">
    <span class="fs-1 text-center text">
      Contact form
    </span>
  </div>
  <div class="row">
    <span class="fs-4 text-center text my-3">
      Write your contact information and we will contact you when the first possibility arises :)
    </span>
    <form class="container">
      <div class="mb-3">
        <label for="email" class="form-label">Email (Required)</label>
        <input type="email" class="form-control" id="email" placeholder="name@domain.com" require>
      </div>
      <div class="mb-3">
        <label for="phone" class="form-label">Phonenumber</label>
        <input type="tel" class="form-control" id="phone" placeholder="+46 123456789">
      </div>
      <div class="mb-3">
        <label for="message" class="form-label">Message (Required)</label>
        <textarea class="form-control" id="message" rows="5"></textarea>
      </div>
      <div class="col-12">
        <button type="button" onclick="sendMessage()" class="btn btn-success mb-3 col-12">Send message</button>
      </div>
    </form>
  </div>
</div>