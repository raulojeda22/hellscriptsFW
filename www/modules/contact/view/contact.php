<section class="probootstrap-slider flexslider">
    <ul class="slides">
        <li style="background-image: url(<? echo _PROJECT_URL_ ?>/view/img/slider_3.jpg);">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <div class="slides-text probootstrap-animate">
                            <h2>Contact</h2>
                        </div>
                    </div>
                </div>
            </div>
        </li>
    </ul>
</section>
<section class="probootstrap-section">
    <div class="container">
      <div class="row">
        <div class="col-md-8">
            <div class="contactError"></div>
          <form class="probootstrap-form mb60">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="name">First Name</label>
                  <input type="text" class="form-control contactFormElement" id="name" name="name">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="surname">Last Name</label>
                  <input type="text" class="form-control contactFormElement" id="surname" name="surname">
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="email">Email</label>
              <input type="email" class="form-control contactFormElement" id="email" name="email">
            </div>
            <div class="form-group">
              <label for="message">Message</label>
              <textarea cols="30" rows="10" class="form-control contactFormElement" id="message" name="message"></textarea>
            </div>
            <div class="form-group">
              <input type="button" class="btn btn-primary" id="submit" name="submit" value="Send Message">
            </div>
          </form>
        </div>
        <div class="col-md-3 col-md-push-1">
          <h4>Contact Details</h4>
          <ul class="with-icon colored">
            <li><i class="icon-location2"></i> <span>IES l'Estació, Ontinyent, València, Espanya</span></li>
            <li><i class="icon-mail"></i><span>raulojeda10g@gmail.com</span></li>
            <li><i class="icon-phone2"></i><span>+692 61 78 90</span></li>
          </ul>
        </div>
      </div>
    </div>
  </section>
  <div id="map"></div>
  
  <!-- Google Map -->
  <script src="https://maps.googleapis.com/maps/api/js?key=<? echo _GOOGLE_API_KEY_; ?>"></script>
  <script src="<? echo _PROJECT_URL_ ?>/view/js/google-map.js"></script>
  <script src="<? echo _PROJECT_URL_ ?>/modules/contact/view/js/contact.js"></script>
