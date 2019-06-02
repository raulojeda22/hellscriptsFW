<div class="updateError"></div>
<form class="probootstrap-form mb60">
    <div class="row">
        <div class="col-md-6">
        <div class="form-group">
            <label for="userName">Username</label>
            <input ng-model="update.username" type="text" class="form-control updateFormElement" id="usernameUpdate" name="username">
        </div>
        </div>
        <div class="col-md-6">
        <div class="form-group">
            <label for="name">Name</label>
            <input ng-model="update.name" type="text" class="form-control updateFormElement" id="nameUpdate" name="name">
        </div>
        </div>
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input ng-model="update.email" type="email" class="form-control updateFormElement" id="emailUpdate" name="email">
    </div>
    <div class="form-group">
        <input type="button" class="btn btn-primary" id="updateSubmit" name="submit" value="Update">
    </div>
</form>
