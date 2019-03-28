<section class="probootstrap-slider flexslider">
    <ul class="slides">
        <li style="background-image: url(<? echo _PROJECT_URL_ ?>/view/img/slider_3.jpg);">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <div class="slides-text probootstrap-animate">
                            <h2>Profile</h2>
                        </div>
                    </div>
                </div>
            </div>
        </li>
    </ul>
</section>

<section class="page-title">
    <div class="container">
        <h1 class="userProfile"></h1>
    </div>
</section>
<section class="probootstrap-section">
    <div class="container">
        <button class="btn btn-primary" id="updateProfile" >Update Profile</button>
        <button class="btn btn-primary" id="likes" >Liked projects</button>
        <button class="btn btn-primary" id="purchases" >Purchased projects</button>
    </div>
    <br>
    <br>
    <div id="profileOptions" class="container"></div>
</section>
<section class="probootstrap-section">
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <p><img src="" class="imageProfile" alt="" class="img-responsive img-border"></p>
                <h2 class="emailProfile"></h2>
                <p class="nameProfile"></p>
            </div>
            <div class="col-md-3">
                <div class="panel-group probootstrap-panel" id="accordion" role="tablist" aria-multiselectable="true">
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingOne">
                            <h4 class="panel-title">
                                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne"
                                    aria-expanded="true" aria-controls="collapseOne">
                                    Email
                                </a>
                            </h4>
                        </div>
                        <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                            <div class="panel-body">
                                <p class="emailProfile"></a>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingTwo">
                            <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo"
                                    aria-expanded="false" aria-controls="collapseTwo">
                                    Name
                                </a>
                            </h4>
                        </div>
                        <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                            <div class="panel-body">
                                <p class="nameProfile" ></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="probootstrap-section">
    <div class="container">
        <div class="col-md-12 section-heading probootstrap-animate">
            <h2>My Projects</h2>
        </div>
        <div class="row row-eq-height probootstrap-animate" id="allProfileProjects"></div>
    </div>
</section>

<script src="<? echo _PROJECT_URL_ ?>/modules/profile/view/js/profile.js?jsVersion=<? echo _JS_VERSION_ ?>"></script>

<!-- END section -->