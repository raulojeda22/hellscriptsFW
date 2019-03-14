<section class="probootstrap-slider flexslider">
    <ul class="slides">
        <li style="background-image: url(<? echo _PROJECT_URL_ ?>/view/img/slider_3.jpg);">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <div class="slides-text probootstrap-animate">
                            <h2>Log in</h2>
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
        <div class="col-md-6">
          <h2>Login</h2>
          <div class="loginError"></div>
          <form class="probootstrap-form mb60">
            <div class="form-group">
              <label for="email">Email</label>
              <input class="form-control loginFormElement" id="emailLogin" name="email">
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" class="form-control loginFormElement" id="passwordLogin" name="password">
            </div>
            <div class="form-group">
              <input type="button" class="btn btn-primary" id="loginSubmit" name="submit" value="Login">
            </div>
          </form>
        </div>
        <div class="col-md-6">
          <h2>Register</h2>
          <div class="registerError"></div>
          <form class="probootstrap-form mb60">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="userName">Username*</label>
                  <input type="text" class="form-control registerFormElement" id="userNameRegister" name="userName">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="name">Name*</label>
                  <input type="text" class="form-control registerFormElement" id="nameRegister" name="name">
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="email">Email*</label>
              <input type="email" class="form-control registerFormElement" id="emailRegister" name="email">
            </div>
            <div class="form-group">
              <label for="password">Password*</label>
              <input type="password" class="form-control registerFormElement" id="passwordRegister" name="password">
            </div>
            <div class="form-group">
              <label for="repeatPassword">Repeat Password*</label>
              <input type="password" class="form-control registerFormElement" id="repeatPasswordRegister" name="repeatPassword">
            </div>
            <div class="form-group">
              <input type="button" class="btn btn-primary" id="registerSubmit" name="submit" value="Register">
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>  
<script src="<? echo _PROJECT_URL_ ?>/modules/users/view/js/users.js?jsVersion=<? echo _JS_VERSION_ ?>"></script>