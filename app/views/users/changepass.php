<?php require APPROOT . '/views/inc/header.php'; ?>
<a href="<?php echo URLROOT; ?>/courses" class="btn btn-light">
    <i class="fa fa-backward"></i> Back
</a>
<div class="card card-body bg-light mt-5">
    <h2>Edit Password</h2>
    <form action="<?php echo URLROOT; ?>/users/changepass/<?php echo $data['id']; ?>" method="post">
        <div class="form-group">
            <label for="old_password">Old Password: <sup>*</sup></label>
            <input type="password" name="old_password" class="form-control form-control-lg <?php echo (!empty($data['old_password_err'])) ? 'is-invalid' : '' ?>" value="<?php echo $data['old_password']; ?>">
            <span class="invalid-feedback"><?php echo $data['old_password_err']; ?></span>
        </div>
        <div class="form-group">
            <label for="new_password">New Password: <sup>*</sup></label>
            <input type="password" name="new_password" class="form-control form-control-lg <?php echo (!empty($data['new_password_err'])) ? 'is-invalid' : '' ?>" value="<?php echo $data['new_password']; ?>">
            <span class="invalid-feedback"><?php echo $data['new_password_err']; ?></span>
        </div>
        <div class="form-group">
            <label for="confirm_new_password">Confirm New Password: <sup>*</sup></label>
            <input type="password" name="confirm_new_password" class="form-control form-control-lg <?php echo (!empty($data['confirm_new_password_err'])) ? 'is-invalid' : '' ?>" value="<?php echo $data['confirm_new_password']; ?>">
            <span class="invalid-feedback"><?php echo $data['confirm_new_password_err']; ?></span>
        </div>
        <input type="submit" class="btn btn-danger mt-5" value="Submit">
    </form>
    
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>