<?php $this->load->view('sign/header'); ?>
<div class="content">
    <form id="signin" class="login-form" method="post">
        <h3>Sign In</h3>
        <p> Enter your status student below: </p>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Status Student</label>
            <select name="student_type" id="" class="select2 form-control">
                <option value="" selected>New Student</option>
                <option value="">Transfer Student</option>
            </select>
        </div>
        <p> Enter your personal details below: </p>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Full Name</label>
            <div class="input-icon">
                <i class="fa fa-font"></i>
                <input required class="form-control placeholder-no-fix" type="text" placeholder="Full Name" name="fullname" /> </div>
        </div>
        <div class="form-group">
            <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
            <label class="control-label visible-ie8 visible-ie9">Date of Birth</label>
            <div class="input-icon">
                <i class="fa fa-calendar"></i>
                <input required class="form-control placeholder-no-fix" type="date" placeholder="Date of Birth" name="dateofbirth" /> </div>
        </div>
        <div class="form-group">
            <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
            <label class="control-label visible-ie8 visible-ie9">Email</label>
            <div class="input-icon">
                <i class="fa fa-envelope"></i>
                <input required class="form-control placeholder-no-fix" type="mail" placeholder="Email" name="email" /> </div>
        </div>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Address</label>
            <div class="input-icon">
                <i class="fa fa-check"></i>
                <input required class="form-control placeholder-no-fix" type="text" placeholder="Address" name="address" /> </div>
        </div>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Previous School</label>
            <div class="input-icon">
                <i class="fa fa-location-arrow"></i>
                <input required class="form-control placeholder-no-fix" type="text" placeholder="Previous School" name="previousschool" /> </div>
        </div>
        <div class="form-actions">
            <button type="submit" id="register-submit-btn" class="btn green"> Sign In </button>
        </div>
    </form>
</div>
<?php $this->load->view('sign/footer'); ?>       