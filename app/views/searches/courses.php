<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="container">
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card card-body bg-light mt-5">
                <h1 class="text-center">Search for Courses</h1><hr>
                <small class="text-muted font-italic py-2">At least "Courses Name" must be filled</small>
                <form action="<?php echo URLROOT; ?>/searches/courses" method="post">
                    <div class="form-group">
                        <label for="course_id">Course ID: </label>
                        <input type="text" name="course_id" class="form-control form-control-lg <?php echo (!empty($data['course_id_err'])) ? 'is-invalid' : '' ?>" value="<?php echo $data['course_id']; ?>">
                        <span class="invalid-feedback"><?php echo $data['course_id_err']; ?></span>
                    </div>
                    <div class="form-group">
                        <label for="name">Course Name: *</label>
                        <input type="text" name="name" class="form-control form-control-lg <?php echo (!empty($data['name_err'])) ? 'is-invalid' : '' ?>" value="<?php echo $data['name']; ?>">
                        <span class="invalid-feedback"><?php echo $data['name_err']; ?></span>
                    </div>
                    <div class="form-group">
                        <label for="owner">Owner First Name: </label>
                        <input type="email" name="owner" class="form-control form-control-lg <?php echo (!empty($data['owner_err'])) ? 'is-invalid' : '' ?>" value="<?php echo $data['owner']; ?>">
                        <span class="invalid-feedback"><?php echo $data['owner_err']; ?></span>
                    </div>
                    <button type="submit" class="btn btn-danger btn-block"><i class="fa fa-search"></i></button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>