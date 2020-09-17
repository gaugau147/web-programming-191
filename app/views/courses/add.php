<?php require APPROOT . '/views/inc/header.php'; ?>
<a href="<?php echo URLROOT; ?>/courses" class="btn btn-light">
    <i class="fa fa-backward"></i> Back
</a>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-body bg-light mt-5">
                <h1 class="text-center">Add New Course</h1><hr>
                <form action="<?php echo URLROOT; ?>/courses/add" method="post">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="course_id">Course ID <sup>*</sup></label>
                                <input type="text" name="course_id" class="form-control <?php echo (!empty($data['course_id_err'])) ? 'is-invalid' : '' ?>" id="course_id" placeholder="Course ID" value="<?php echo $data['course_id']; ?>">
                                <span class="invalid-feedback"><?php echo $data['course_id_err']; ?></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="privacy">Privacy Option <small class="text-muted">(default: public)</small></label>
                                <select name="privacy" class="form-control <?php echo (!empty($data['privacy_err'])) ? 'is-invalid' : '' ?>" id="privacy">
                                    <option value="">Please select</option>
                                    <option value="public" <?php echo $data['privacy'] == 'public' ? 'selected' : ''; ?>>Public</option>
                                    <option value="private" <?php echo $data['privacy'] == 'private' ? 'selected' : ''; ?>>Private</option>
                                </select>
                                <span class="invalid-feedback"><?php echo $data['privacy_err']; ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name">Course Name <sup>*</sup></label>
                        <input type="text" name="name" class="form-control <?php echo (!empty($data['name_err'])) ? 'is-invalid' : '' ?>" id="name" placeholder="Course Name" value="<?php echo $data['name']; ?>">
                        <span class="invalid-feedback"><?php echo $data['name_err']; ?></span>
                    </div>
                    <input type="submit" class="btn btn-success" value="Submit">
                </form>
            </div>
        </div>
    </div>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>