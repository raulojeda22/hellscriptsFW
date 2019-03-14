<section class="probootstrap-slider flexslider">
    <ul class="slides">
        <li style="background-image: url(<? echo _PROJECT_URL_ ?>/view/img/slider_3.jpg);">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <div class="slides-text probootstrap-animate">
                            <h2>Projects</h2>
                        </div>
                    </div>
                </div>
            </div>
        </li>
    </ul>
</section>

<section class="probootstrap-section">
    <div id="projectPageContent">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="col-md-12 section-heading probootstrap-animate">
                        <h2 class="mb20">DO YOU HAVE AN AMAZING PROJECT IN MIND?</h2>
                        <button id="createProject" type="button" class="btn btn-primary">Create project</button>
                    </div>
                </div>
                <div id="resetApp" class="col-md-6">
                    <div class="col-md-12 section-heading probootstrap-animate">
                        <h2 class="mb20">RESET APP</h2>
                        <button id="deleteAllProjects" type="button" class="btn btn-primary">Remove all projects</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-12 section-heading probootstrap-animate">
                    <h2 class="mb20">Datatables</h2>
                </div>
            </div>
            <div class="table-responsive" id="allTableProjectsDiv">
                <table class="table table-condensed table-dark" id="allTableProjects">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Website</th>
                            <th>License</th>
                            <th>Privacy</th>
                            <th>Languages</th>
                            <th>Get</th>
                            <th>Update</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody id="allTableProjectsBody">

                    </tbody>
                </table>
            </div>
        </div>
        <script src="<? echo _PROJECT_URL_ ?>/modules/projects/view/js/projects.js?jsVersion=<? echo _JS_VERSION_ ?>"></script>
        <!-- END section -->
    </div>
</section>
<?
include_once (_PROJECT_PATH_.'/www/modules/projects/view/modal.php');
?>