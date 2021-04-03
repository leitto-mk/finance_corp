<?php $this->load->view('sign/header'); ?>
<div class="content">
    <form id="signinnew" class="" method="post" role="form">
        <h3>Sign In</h3>
        <p> School Enrollment: </p>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Status Student</label>
            <select required name="student_type" id="student_type" class="select2 form-control">
                <option value="">-- Student Type --</option>
                <option value="New">New Student</option>
                <option value="Transfer">Transfer Student</option>
            </select>
        </div>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Registering to:</label>
            <select required name="school" id="school" class="select2 form-control">
                <option value="">-- Choose School --</option>
                <?php foreach($schools as $row) : ?>
                    <option value="<?= $row->School_Desc ?>"><?= $row->SchoolName?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <p> Enter your personal details below: </p>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">First Name</label>
            <div class="input-icon">
                <i class="fa fa-font"></i>
                <input required class="form-control placeholder-no-fix" type="text" placeholder="First Name" name="firstname"/> 
            </div>
        </div>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Last Name</label>
            <div class="input-icon">
                <i class="fa fa-font"></i>
                <input required class="form-control placeholder-no-fix" type="text" placeholder="Last Name" name="lastname"/> 
            </div>
        </div>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Date of Birth</label>
            <div class="input-icon">
                <i class="fa fa-calendar"></i>
                <input required class="form-control placeholder-no-fix" type="date" placeholder="Date of Birth" name="dateofbirth"/> 
            </div>
        </div>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Email</label>
            <div class="input-icon">
                <i class="fa fa-envelope"></i>
                <input required class="form-control placeholder-no-fix" type="mail" placeholder="Email" name="email"/> 
            </div>
        </div>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Previous School</label>
            <div class="input-icon">
                <i class="fa fa-location-arrow"></i>
                <input required class="form-control placeholder-no-fix" type="text" placeholder="Previous School" name="previousschool"/> 
            </div>
        </div>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Phone Number</label>
            <div class="input-icon">
                <i class="fa fa-phone"></i>
                <input required class="form-control placeholder-no-fix" type="text" placeholder="Phone Number" name="handheldnumber"/> 
            </div>
        </div>
        <div class="form-actions">
            <button type="submit" class="btn green"> Sign In </button>
        </div>
    </form>
</div>
<?php $this->load->view('sign/footer'); ?>