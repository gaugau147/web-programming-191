<?php require APPROOT . '/views/inc/header.php'; ?>
<a href="<?php echo URLROOT; ?>/courses" class="btn btn-light">
    <i class="fa fa-backward"></i> Back
</a>
<div class="card card-body bg-light mt-5">
    <h2>Edit Profile</h2>
    <form action="<?php echo URLROOT;?>/users/edit/<?php echo $data['id'];?>" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="fname">First Name: <sup>*</sup></label>
            <input type="text" name="fname" class="form-control form-control-lg <?php echo (!empty($data['fname_err'])) ? 'is-invalid' : '' ?>" value="<?php echo $data['fname']; ?>" id="fname" >
            <span class="invalid-feedback"><?php echo $data['fname_err']; ?></span>
        </div>
        <div class="form-group">
            <label for="lname">Last Name: <sup>*</sup></label>
            <input type="text" name="lname" class="form-control form-control-lg <?php echo (!empty($data['lname_err'])) ? 'is-invalid' : '' ?>" value="<?php echo $data['lname']; ?>" id="lname" >
            <span class="invalid-feedback"><?php echo $data['lname_err']; ?></span>
        </div>
        <div class="form-group">
            <label for="lid">Lecturer ID: <sup>*</sup></label>
            <input type="text" name="lid" class="form-control form-control-lg <?php echo (!empty($data['lid_err'])) ? 'is-invalid' : '' ?>" value="<?php echo $data['lid']; ?>" id="lid" >
            <span class="invalid-feedback"><?php echo $data['lid_err']; ?></span>
        </div>
        <div class="form-group">
            <label for="dob">Date Of Birth: </label>
            <input type="date" name="dob" class="form-control form-control-lg <?php echo (!empty($data['dob_err'])) ? 'is-invalid' : '' ?>" value="<?php echo $data['dob']; ?>" id="dob" >
            <span class="invalid-feedback"><?php echo $data['dob_err']; ?></span>
        </div>
        <div class="form-group">
            <label for="phone">Phone Number: </label>
            <input type="text" name="phone" class="form-control form-control-lg <?php echo (!empty($data['phone_err'])) ? 'is-invalid' : '' ?>" value="<?php echo $data['phone']; ?>" id="phone" >
            <span class="invalid-feedback"><?php echo $data['phone_err']; ?></span>
        </div>
        <div class="form-group">
            <label for="faculty">Faculty: </label>
            <input type="text" name="faculty" class="form-control form-control-lg <?php echo (!empty($data['faculty_err'])) ? 'is-invalid' : '' ?>" value="<?php echo $data['faculty']; ?>" id="faculty" >
            <span class="invalid-feedback"><?php echo $data['faculty_err']; ?></span>
        </div>
        <div class="form-group">
            <label for="avatar">Avatar: </label>
            <input type="file" name="avatar" class="form-control form-control-lg <?php echo (!empty($data['avatar_err'])) ? 'is-invalid' : '' ?>"  id="avatar">
            <span class="invalid-feedback"><?php echo $data['avatar_err']; ?></span>
        </div>
        <div class="form-group">
            <label for="password">Confirm Your Password: <sup>*</sup></label>
            <input type="password" name="password" class="form-control form-control-lg <?php echo (!empty($data['password_err'])) ? 'is-invalid' : '' ?>" id="password" value="">
            <span class="invalid-feedback"><?php echo $data['password_err']; ?></span>
        </div>
        <input type="submit" class="btn btn-danger mt-5" value="Submit">
    </form>
    
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>