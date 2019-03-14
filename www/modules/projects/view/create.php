<div class="container">
    <div class="projectError"></div>
    <form action="#" method="post" class="probootstrap-form mb60">
        <div class="form-group">
            <label for="fname">Name*</label>
            <input type="text" name="name" class="form-control projectFormElement" id="fname" name="fname" placeholder="My innovative idea">
        </div>
        <div class="form-group">
            <label for="message">Description*</label>
            <textarea cols="30" rows="10" class="form-control projectFormElement" id="message" name="description" placeholder="The amazing features of my idea..."></textarea>
        </div>
        <div class="form-group">
            <label for="email">Website*</label>
            <input type="email" class="form-control projectFormElement" id="email" name="website" placeholder="https://hellscripts.com">
        </div>
        <div class="form-group">
            <label for="image">Image url*</label>
            <input type="url" class="form-control projectFormElement" id="image" name="image" placeholder="https://screenshotlayer.com/images/assets/placeholder.png">
        </div>
        <div class="form-group">
            <label for="price">Price*</label>
            <input type="number" class="form-control projectFormElement" id="price" name="price" placeholder="50">
        </div>
        <div class="form-group">
            <label>License</label>
            <select class="form-control projectFormElement" name="license" id="license">
                <option value="Apache">Apache License 2.0</option>
                <option value="GNU">GNU General Public License</option>
                <option value="MIT">MIT license</option>
                <option value="CDDL">Common Development and Distribution License</option>
            </select>
        </div>
            
        <div class="form-group">
            <label>Privacy</label>
            <div class="toggle_radio">
                <input type="radio" checked class="toggle_option" id="first_toggle" name="privacy" value="public">
                <input type="radio" class="toggle_option" id="second_toggle" name="privacy" value="protected">
                <input type="radio" class="toggle_option" id="third_toggle" name="privacy" value="private">
                <label for="first_toggle"><p>Public</p></label>
                <label for="second_toggle"><p>Protected</p></label>
                <label for="third_toggle"><p>Private</p></label>
                <span hidden id="checkBoxValue" class="projectFormElement" name="privacy" value="public"></span> 
                <div class="toggle_option_slider"></div>
            </div>
        </div>
            
        <div class="form-group">
            <label>Programming languages: *</label> <h4 class="text-muted">(Separate them in commas)</h4>
            <textarea cols="30" rows="10" class="form-control projectFormElement" placeholder="PHP, Javascript, CSS, HTML" id="message" name="languages"></textarea>
        </div>
        <div class="form-group"> <!-- Date input -->
            <label class="control-label" for="date">Expected end date*</label>
            <input class="form-control datePicker projectFormElement" id="date" name="endDate" placeholder="YYYY-MM-DD" type="text"/>
        </div>
        <div class="form-group">
            <button type="button" class="btn btn-primary" id="projectFormButton" name="submit">Create</button>
        </div>
    </form>
</div>
<script src="<? echo _PROJECT_URL_; ?>/modules/projects/view/js/radioButton.js?jsVersion=<? echo _JS_VERSION_ ?>"></script>