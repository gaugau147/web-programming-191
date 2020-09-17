<?php require APPROOT . '/views/inc/header.php'; ?>
<a href="<?php echo URLROOT; ?>/topics/show/<?php echo $data['course_id']; ?> " class="btn btn-light py-2">
    <i class="fa fa-backward"></i> Back
</a>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-body bg-light mt-5">
                <h1 class="text-center">Create New Exam</h1><hr>
                <form action="<?php echo URLROOT; ?>/exams/create/<?php echo $data['course_id']; ?>" method="post">
                    <div class="form-group">
                        <label for="title">Exam Title <sup>*</sup></label>
                        <input type="text" name="title" class="form-control form-control-lg <?php echo (!empty($data['title_err'])) ? 'is-invalid' : '' ?>" id="title" value="<?php echo $data['title']; ?>">
                        <span class="invalid-feedback"><?php echo $data['title_err']; ?></span>
                    </div>
                    <div class="form-group">
                        <label for="description">Description </label>
                        <input type="text" name="description" class="form-control form-control-lg <?php echo (!empty($data['description_err'])) ? 'is-invalid' : '' ?>" id="description" value="<?php echo $data['description']; ?>">
                        <span class="invalid-feedback"><?php echo $data['description_err']; ?></span>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="date">Date taken <sup>*</sup></label>
                                <input type="date" name="date" class="form-control form-control-lg <?php echo (!empty($data['date_err'])) ? 'is-invalid' : '' ?>" value="<?php echo $data['date']; ?>" id="date">
                                <span class="invalid-feedback"><?php echo $data['date_err']; ?></span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="time">Start time <sup>*</sup></label>
                                <input type="text" name="time" class="form-control form-control-lg <?php echo (!empty($data['time_err'])) ? 'is-invalid' : '' ?>" id="time" placeholder="00:00" value="<?php echo $data['time']; ?>">
                                <span class="invalid-feedback"><?php echo $data['time_err']; ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="duration">Exam duration <sup>*</sup></label>
                                <input type="number" name="duration" class="form-control form-control-lg <?php echo (!empty($data['duration_err'])) ? 'is-invalid' : '' ?>" value="<?php echo $data['duration']; ?>" id="duration" placeholder="minutes">
                                <span class="invalid-feedback"><?php echo $data['duration_err']; ?></span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="class">Class: </label>
                                <input type="text" name="class" class="form-control form-control-lg <?php echo (!empty($data['class_err'])) ? 'is-invalid' : '' ?>" value="<?php echo $data['class']; ?>" id="class">
                                <span class="invalid-feedback"><?php echo $data['class_err']; ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="notes">Notes </label>
                        <input type="text" name="notes" class="form-control form-control-lg <?php echo (!empty($data['notes_err'])) ? 'is-invalid' : '' ?>" id="notes" value="<?php echo $data['notes']; ?>">
                        <span class="invalid-feedback"><?php echo $data['notes_err']; ?></span>
                    </div>
                    <div class="row">
                        <div class="col-sm-8">
                            <div class="form-group">
                                <label for="no_question">Number of Questions <sup>*</sup></label>
                                <input type="number" name="no_question" class="form-control form-control-lg <?php echo (!empty($data['no_question_err'])) ? 'is-invalid' : '' ?>" id="no_question" value="<?php echo $data['no_question']; ?>">
                                <span class="invalid-feedback"><?php echo $data['no_question_err']; ?></span>
                            </div>
                        </div>
                        <div class="col-sm-4 pt-4">
                            <!-- check the button position! -->
                            <input type="submit" class="btn btn-danger btn-block" value="Submit">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>