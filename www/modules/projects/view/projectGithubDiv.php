<div class="col alignColumn col-lg-2 col-md-3 col-sm-4">
    <div class="probootstrap-card">
        <div class="probootstrap-card-media responsive-square">
            <img src="<? echo $_POST['data']['image']; ?>" class="img-responsive responsive-square-content img-border"/>
        </div>
        <div class="probootstrap-card-text">
            <div class="row text-center" name="<? echo $_POST['data']['name']; ?>" id="project<? echo $_POST['data']['id']; ?>">
                <button class="btn btn-primary btn-sm btn-link githubGet" name="GET"><i class="icon-github"></i> Show</button>
            </div>
            <h4 class="max-line"><a class="text-white" target="_blank" href="<? echo $_POST['data']['url']; ?>"><? echo $_POST['data']['name']; ?></a></h4>
            <h6 class="category"><? echo $_POST['data']['languages']; ?></h6>
        </div>
    </div>
</div>