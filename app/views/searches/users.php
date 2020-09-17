<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="container">
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card card-body bg-light mt-5">
                <h1 class="text-center">Search for Lecturers</h1><hr>
                <small class="text-muted font-italic py-2">At least First Name must be filled</small>
                <form action="<?php echo URLROOT; ?>/searches/users" method="post">
                    <div class="form-group">
                        <label for="fname">First Name: *</label>
                        <input type="text" name="fname" class="form-control form-control-lg <?php echo (!empty($data['fname_err'])) ? 'is-invalid' : '' ?>" value="<?php echo $data['fname']; ?>">
                        <span class="invalid-feedback"><?php echo $data['fname_err']; ?></span>
                    </div>
                    <div class="form-group">
                        <label for="email">Email Address: </label>
                        <input type="email" name="email" class="form-control form-control-lg <?php echo (!empty($data['email_err'])) ? 'is-invalid' : '' ?>" value="<?php echo $data['email']; ?>">
                        <span class="invalid-feedback"><?php echo $data['email_err']; ?></span>
                    </div>
                    <div class="form-group">
                        <label for="lid">Lecturer ID: </label>
                        <input type="text" name="lid" class="form-control form-control-lg <?php echo (!empty($data['lid_err'])) ? 'is-invalid' : '' ?>" value="<?php echo $data['lid']; ?>">
                        <span class="invalid-feedback"><?php echo $data['lid_err']; ?></span>
                    </div>
                    <button type="submit" class="btn btn-danger btn-block"><i class="fa fa-search"></i></button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>