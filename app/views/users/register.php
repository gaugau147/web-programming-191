<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="row">
    <div class="col-md-6 mx-auto">
        <div class="card card-body bg-light mt-5">
            <h2>Create An Account</h2>
            <hr>
            <p>Please fill out this form</p>
            <form action="<?php echo URLROOT; ?>/users/register" method="post">
                <div class="form-group">
                    <label for="fname">First Name: <sup>*</sup></label>
                    <input type="text" name="fname" class="form-control form-control-lg <?php echo (!empty($data['fname_err'])) ? 'is-invalid' : '' ?>" value="<?php echo $data['fname']; ?>">
                    <span class="invalid-feedback"><?php echo $data['fname_err']; ?></span>
                </div>
                <div class="form-group">
                    <label for="lname">Last Name: <sup>*</sup></label>
                    <input type="text" name="lname" class="form-control form-control-lg <?php echo (!empty($data['lname_err'])) ? 'is-invalid' : '' ?>" value="<?php echo $data['lname']; ?>">
                    <span class="invalid-feedback"><?php echo $data['lname_err']; ?></span>
                </div>
                <div class="form-group">
                    <label for="lid">Lecturer ID: <sup>*</sup></label>
                    <input type="text" name="lid" class="form-control form-control-lg <?php echo (!empty($data['lid_err'])) ? 'is-invalid' : '' ?>" value="<?php echo $data['lid']; ?>">
                    <span class="invalid-feedback"><?php echo $data['lid_err']; ?></span>
                </div>
                <div class="form-group">
                    <label for="email">Email: <sup>*</sup></label>
                    <input type="email" name="email" class="form-control form-control-lg <?php echo (!empty($data['email_err'])) ? 'is-invalid' : '' ?>" value="<?php echo $data['email']; ?>">
                    <span class="invalid-feedback"><?php echo $data['email_err']; ?></span>
                </div>
                <div class="form-group">
                    <label for="password">Password: <sup>*</sup></label>
                    <input type="password" name="password" class="form-control form-control-lg <?php echo (!empty($data['password_err'])) ? 'is-invalid' : '' ?>" value="<?php echo $data['password']; ?>">
                    <span class="invalid-feedback"><?php echo $data['password_err']; ?></span>
                </div>
                <div class="form-group py-2">
                    <label for="confirm_password">Confirm Password: <sup>*</sup></label>
                    <input type="password" name="confirm_password" class="form-control form-control-lg <?php echo (!empty($data['confirm_password_err'])) ? 'is-invalid' : '' ?>" value="<?php echo $data['confirm_password']; ?>">
                    <span class="invalid-feedback"><?php echo $data['confirm_password_err']; ?></span>
                </div> <hr>
                <div class="row py-2">
                    <div class="col">
                        <input type="submit" value="Register" class="btn btn-danger btn-block">
                    </div>
                    <div class="col">
                        <a href="<?php echo URLROOT; ?>/users/login" class="btn btn-outline-secondary btn-block"> Have an account? Login</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div> <br> <br>
<?php require APPROOT . '/views/inc/footer.php'; ?>