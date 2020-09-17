<?php require APPROOT . '/views/inc/header.php'; ?>
<a href="<?php echo URLROOT; ?>/searches/courses" class="btn btn-light">
    <i class="fa fa-backward"></i> Back
</a>
<div class="container border">
    <div class="row py-3">
        <div class="col-md-12 p3">
            <h1>Search results</h1><hr>
            <div class="font-italic py-3 text-muted">Result for Course Name: <?php echo $data['name'] . '<br>';
                                                        echo !empty($data['course_id']) ? 'Course ID: ' . $data['course_id'] . '<br>' : '';
                                                        echo !empty($data['owner']) ? 'Owner First Name: ' . $data['owner'] : ""; ?></div>
            <?php if (empty($data['courses'])) {
                echo 'No results found';
            } ?>
            <?php foreach ($data['courses'] as $course) : ?>
                <div class="list-group py-2 border-0">
                    <div class="list-group-item list-group-item-action flex-column align-items-start border-0">
                        <div class="row align-center">
                            <div class="col-sm-9">
                                <h4 class="mb-1"><?php echo $course->course_id . ' - ' . $course->name; ?> </h4>
                                Owner:  <a href="<?php echo ($course->uid != $_SESSION['user_id']) ? URLROOT . '/users/show/' . $course->uid : URLROOT . '/courses'; ?>">
                                <i class="fas fa-at"></i> <?php echo $course->fname . ' ' . $course->lname; ?>
                                </a>
                            </div>
                            <div class="col-sm-3">
                                <a href="<?php echo URLROOT . '/topics/show/' . $course->cid; ?>" class="btn btn-outline-secondary btn-sm"><i class="far fa-eye"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>