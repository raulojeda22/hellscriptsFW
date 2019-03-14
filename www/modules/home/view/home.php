<section class="probootstrap-slider flexslider border-bottom">
  <ul class="slides">
    <li class="py-2" style="background-image: url(<? echo _PROJECT_URL_ ?>/view/img/slider_3.jpg);">
      <div class="container">
        <div class="row">
          <div class="col-md-12 text-center">
            <div class="slides-text">
              <h4 class="translate" data-original="Join other developers." >Join other developers.</h4>
              <p><a href="<? echo _PUBLIC_URL_.'/projects' ?>" class="btn btn-primary btn-sm translate" data-original="Start now!">Start now!</a></p>
            </div>
          </div>
        </div>
      </div>
    </li>
    <li style="background-image: url(<? echo _PROJECT_URL_ ?>/view/img/slider_2.jpg);">
      <div class="container">
        <div class="row">
          <div class="col-md-12 text-center">
            <div class="slides-text">
              <h3 class="translate" data-original="Help build something big.">Help build something big.</h3>
              <p><a href="<? echo _PUBLIC_URL_.'/projects' ?>" class="btn btn-primary translate" data-original="Start now!">Start now!</a></p>
            </div>
          </div>
        </div>
      </div>
    </li>
    <li style="background-image: url(<? echo _PROJECT_URL_ ?>/view/img/slider_3.jpg);">
      <div class="container">
        <div class="row">
          <div class="col-md-12 text-center">
            <div class="slides-text">
              <h3 class="translate" data-original="Learn and share knowledge." >Learn and share knowledge.</h3>
              <p><a href="<? echo _PUBLIC_URL_.'/projects' ?>" class="btn btn-primary translate" data-original="Start now!">Start now!</a></p>
            </div>
          </div>
        </div>
      </div>
    </li>
    <li style="background-image: url(<? echo _PROJECT_URL_ ?>/view/img/bike.png);">
      <div class="container">
        <div class="row">
          <div class="col-md-12 text-center">
            <div class="slides-text">
              <h3 class="translate" data-original="Improve the world with your contributions." >Improve the world with your contributions.</h3>
              <p><a href="<? echo _PUBLIC_URL_.'/projects' ?>" class="btn btn-primary translate" data-original="Start now!">Start now!</a></p>
            </div>
          </div>
        </div>
      </div>
    </li>
    <li style="background-image: url(<? echo _PROJECT_URL_ ?>/view/img/slider_3.jpg);">
      <div class="container">
        <div class="row">
          <div class="col-md-12 text-center">
            <div class="slides-text">
              <h3 class="translate" data-original="Start your own project and get helped by the community." >Start your own project and get helped by the community.</h3>
              <p><a href="<? echo _PUBLIC_URL_.'/projects' ?>" class="btn btn-primary translate" data-original="Start now!">Start now!</a></p>
            </div>
          </div>
        </div>
      </div>
    </li>
  </ul>
</section>
<!-- END: slider  -->
<div id="homePageContent">
  <section class="probootstrap-section">
    <div class="container">
      <div class="row">
        <div class="col-md-12 probootstrap-animate">
          <form class="probootstrap-form">
            <div class="input-group  float-right">
              <div class="input-group-btn form-field">              
                <input list="suggestionsLicense" type="text" class="form-control typeahead border-primary" name="licenseSearch" id="licenseSearch" placeholder="Search the license..." autocomplete="off">
                <datalist id="suggestionsLicense"></datalist>
              </div>
              <div class="input-group-btn form-field">              
                <input list="suggestionsLanguages" type="text" class="form-control typeahead border-primary" name="languagesSearch" id="languagesSearch" placeholder="Search the languages..." autocomplete="off">
                <datalist id="suggestionsLanguages"></datalist>
              </div>
              <div class="input-group-btn form-field">              
                <input list="suggestionsName" type="text" class="form-control typeahead border-primary" name="nameSearch" id="nameSearch" placeholder="Search by name..." autocomplete="off">
                <datalist id="suggestionsName"></datalist>
              </div>
            </div>
          </form>
          <div class="text-center">
            <button class="btn btn-primary" id="projectSearch" type="button">Search <img src="<? echo _PROJECT_URL_ ?>/view/img/search.png" /></button>
          </div>
        </div>
        <div class="col-md-12 section-heading probootstrap-animate">
          <h2>The Projects</h2>
        </div>
      </div>
      <div class="row probootstrap-animate" id="allHomeProjects"></div>
    </div>
  </section>
  <section class="probootstrap-section">
    <div class="container">
        <div class="col-md-12 section-heading probootstrap-animate">
            <h2>Github Projects</h2>
        </div>
        <div class="row row-eq-height probootstrap-animate" id="githubHomeProjects">
            

        </div>
    </div>
</section>
</div>
<script src="<? echo _PROJECT_URL_ ?>/modules/home/view/js/home.js?jsVersion=<? echo _JS_VERSION_ ?>"></script>
<?
include_once (_PROJECT_PATH_.'/www/modules/projects/view/modal.php');
?>