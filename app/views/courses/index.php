<?php require APPROOT . '/views/inc/header.php'; ?><br>
<!-- Change flash message appearance in helpers/section_helper.php -->
<?php flash('course_message'); ?>
<?php flash('profile_edit'); ?>
<?php flash('change_pass'); ?>
<div class="container border py-2" id="Diep-author-container">
    <div class="row">
        <!-- Side bar -->
        <div class="col-lg-4 border-right">
            <!-- Check the img data later -->
            <img class="img-fluid rounded-circle mb-3 mt-3" width=200px src="<?php echo URLROOT; ?>/img/uploads/<?php echo $data['user_data']->avatar; ?>" alt="profile-picture">
            <h3><?php echo $data['user_data']->fname . ' ' . $data['user_data']->lname; ?></h3> <hr>
            <br>
            <p>
                <span><i class="fa fa-user"></i></span>
                <span>Lecturer ID: <?php echo $data['user_data']->lid; ?></span>
            </p>
            <?php if (!empty($data['user_data']->faculty)) : ?>
                <p>
                    <span><i class="fa fa-code"></i></span>
                    <span><?php echo $data['user_data']->faculty; ?></span>
                </p>
            <?php else : ?>
            <?php endif ?>
            <p>
                <span><i class="fa fa-university"></i></span>
                <span><?php echo University; ?></span>
            </p>
            <p>
                <span><i class="fa fa-envelope"></i></span>
                <span><?php echo $data['user_data']->email; ?></span>
            </p>
            <?php if (!empty($data['user_data']->phone)) : ?>
                <p>
                    <span><i class="fa fa-phone"></i></span>
                    <span><?php echo $data['user_data']->phone; ?></span>
                </p>
            <?php else : ?>
            <?php endif ?>
            <p>
                <span><i class="fa fa-birthday-cake"></i></span>
                <span><?php echo $data['user_data']->dob; ?></span>
            </p>
            <a href="<?php echo URLROOT; ?>/users/edit/<?php echo $data['user_data']->id; ?>" class="btn btn-outline-secondary">Edit profile</a>
            <a href="<?php echo URLROOT; ?>/users/changepass/<?php echo $data['user_data']->id; ?>" class="btn btn-danger float-right">Change Password</a>

        </div>
        <!-- Contents -->
        <div class="col-lg-8">
            <a href="<?php echo URLROOT; ?>/courses/add" class="btn btn-danger pull-right btn-sm mr-3">
                <i class="fa fa-plus"></i> Add Course
            </a>
            <br>
            <!-- Tab section -->
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active a-link" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Public Courses</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link a-link" id="profile-tab" data-toggle="tab" href="#profiletab" role="tab" aria-controls="profiletab" aria-selected="false">Private Courses</a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade show active" role="tabpanel" aria-labelledby="home-tab">
                    <div class="list-group">
                        <?php foreach ($data['courses'] as $course) {
                            if ($course->privacy == 'public') { ?>
                                <div class="list-group-item list-group-item-action flex-column align-items-start">
                                    <div class="d-flex justify-content-between">
                                        <h5 class="mb-1"><?php echo $course->courseId; ?> - <?php echo $course->name; ?></h5>
                                    </div><br>
                                    <div class="row justify-content-around">
                                        <div class="col-sm-4">
                                            <a href="<?php echo URLROOT; ?>/topics/show/<?php echo $course->cid; ?>" class="btn btn-light btn-sm"><i class="fas fa-eye"></i></a>
                                        </div>
                                        <div class="col-sm-4">
                                            <a href="<?php echo URLROOT; ?>/courses/edit/<?php echo $course->cid; ?>" class="btn btn-outline-secondary btn-sm"><i class="far fa-edit"></i></a>
                                        </div>
                                        <div class="col-sm-4">
                                            <form onSubmit="return confirm('Are you sure?');" action="<?php echo URLROOT; ?>/courses/delete/<?php echo $course->cid; ?>" method="post">
                                                <button type="submit" class="btn btn-danger btn-sm mt-2" onClick={onSubmit}><i class="fas fa-trash"></i></button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                        <?php }
                        } ?>
                    </div>
                </div>
                <div class="tab-pane fade" id="profiletab" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="list-group">
                        <?php foreach ($data['courses'] as $course) {
                            if ($course->privacy == 'private') { ?>
                                <div href="" class="list-group-item list-group-item-action flex-column align-items-start">
                                    <div class="d-flex justify-content-between">
                                        <h5 class="mb-1"><?php echo $course->courseId; ?> - <?php echo $course->name; ?></h5>

                                    </div>
                                    <div class="row justify-content-around">
                                        <div class="col-sm-4">
                                            <a href="<?php echo URLROOT; ?>/topics/show/<?php echo $course->cid; ?>" class="btn btn-light btn-sm"><i class="fas fa-eye"></i></a>
                                        </div>
                                        <div class="col-sm-4">
                                            <a href="<?php echo URLROOT; ?>/courses/edit/<?php echo $course->cid; ?>" class="btn btn-outline-secondary btn-sm"><i class="far fa-edit"></i></a>
                                        </div>
                                        <!-- ??????Try to display confirm delete message by js -->
                                        <!-- The below is not working -->
                                        <div class="col-sm-4">
                                            <form onSubmit="return confirm('Are you sure?');" action="<?php echo URLROOT; ?>/courses/delete/<?php echo $course->cid; ?>" method="post">
                                                <button type="submit" value="Delete" class="btn btn-danger btn-sm mt-2" onClick={onSubmit}><i class="fas fa-trash"></i></button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                        <?php }
                        } ?>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <br>
</div> <br><br>
<?php require APPROOT . '/views/inc/footer.php'; ?>