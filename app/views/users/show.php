<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="container py-4">
    <div class="row border py-3">
        <!-- Side bar -->
        <div class="col-lg-4 border-right">
            <img class="img-fluid rounded-circle mb-3 mt-3" width=200px src="<?php echo URLROOT; ?>/img/uploads/<?php echo $data['user_data']->avatar; ?>" alt="profile-picture">
            <h3><?php echo $data['user_data']->fname . ' ' . $data['user_data']->lname; ?></h3>
            <hr><br>
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
        </div>
        <!-- Contents -->
        <div class="col-lg-8 py-3">
            <br>
            <h2>Public Courses</h2> <hr>
            <!-- Tab section -->
            <div class="list-group">
                <?php foreach ($data['courses'] as $course) {
                    if ($course->privacy == 'public') { ?>
                        <div class="list-group-item list-group-item-action flex-column align-items-start">
                            <div class="row">
                                <div class="col-sm-9">
                                    <div class="d-flex justify-content-between">
                                        <h5 class="mb-1"><?php echo $course->course_id; ?> - <?php echo $course->name; ?></h5>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <a href="<?php echo URLROOT; ?>/topics/show/<?php echo $course->id; ?>" class="btn btn-light btn-sm"><i class="far fa-eye"></i></a>
                                </div>
                            </div>
                        </div>
                <?php }
                } ?>
            </div>
        </div>
    </div>
    <br>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>