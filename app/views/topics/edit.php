<?php require APPROOT . '/views/inc/header.php'; ?>
<a href="<?php echo URLROOT; ?>/topics/show/<?php echo $data['course_id']; ?>" class="btn btn-light">
    <i class="fa fa-backward"></i> Back
</a>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-body bg-light mt-5">
                <?php flash('edit_failed'); ?>
                <h1 class="text-center">Edit Topic</h1><hr>
                <form action="<?php echo URLROOT; ?>/topics/edit/<?php echo $data['id']; ?>" method="post">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="title">Topic Title <sup>*</sup></label>
                                <input type="text" name="title" class="form-control <?php echo (!empty($data['title_err'])) ? 'is-invalid' : '' ?>" id="title" placeholder="Topic Title" value="<?php echo $data['title']; ?>">
                                <span class="invalid-feedback"><?php echo $data['title_err']; ?></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Topic Name <sup>*</sup></label>
                                <input type="text" name="name" class="form-control <?php echo (!empty($data['name_err'])) ? 'is-invalid' : '' ?>" id="name" placeholder="Topic Name" value="<?php echo $data['name']; ?>">
                                <span class="invalid-feedback"><?php echo $data['name_err']; ?></span>
                            </div>
                        </div>
                    </div>
                    <input type="submit" class="btn btn-danger" value="Submit">
                </form>
            </div>
        </div>
    </div>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>