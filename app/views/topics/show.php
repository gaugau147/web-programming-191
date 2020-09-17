<?php require APPROOT . '/views/inc/header.php'; ?>
<?php flash('topic_message'); ?>
<a href="<?php echo ($data['user']->id == $_SESSION['user_id']) ? URLROOT . '/courses' : URLROOT . '/users/show/' . $data['user']->id; ?>" class="btn btn-light">
    <i class="fa fa-backward py-4"></i> Back
</a>
<div class="container py-4 border">
    <div class="row">
        <div class="col-md-12">
            <h1 class="text-center"><?php echo $data['course']->course_id . "-" . $data['course']->name; ?></h1>
            <div class="text-white p-2 mb-3 text-muted text-right container">
                Written by <i class="fas fa-at"></i> <?php echo $data['user']->fname;
                            echo " ";
                            echo $data['user']->lname; ?>
            </div> <hr>
            <!-- <p><?php echo $data['course']->name; ?></p> -->
            <h3>Topics</h3> <br>
            <?php foreach ($data['topics'] as $topic) : ?>
                <div class="list-group">
                    <div class="list-group-item list-group-item-action flex-column align-items-start">
                        <div class="row align-center">
                            <div class="col-md-8 py-2">
                                <div class="d-flex justify-content-between">
                                    <h5 class="mb-1"><i class="fas fa-circle"></i> <?php echo $topic->title; ?> - <?php echo $topic->name; ?> </h5>
                                </div>
                            </div>
                            <div class="col-md-2 py-2">
                                <a href="<?php echo URLROOT; ?>/questions/show/<?php echo $topic->id; ?>" class="btn btn-light btn-sm"><i class="fas fa-eye"></i></a>
                            </div>
                            <?php if ($data['user']->id == $_SESSION['user_id']) { ?>
                                <div class="col-md-1">
                                    <a href="<?php echo URLROOT; ?>/topics/edit/<?php echo $topic->id; ?>" class="btn btn-outline-secondary btn-sm"><i class="far fa-edit"></i></a>
                                </div>
                                <div class="col-md-1">
                                    <form onSubmit="return confirm('Are you sure?');" action="<?php echo URLROOT; ?>/topics/delete/<?php echo $topic->id; ?>" method="post">
                                        <!-- <input type="submit" value="Delete" class="btn btn-dark btn-sm " onClick={onSubmit}> -->
                                        <button type="submit" class="btn btn-danger btn-sm " onClick={onSubmit}> <i class="fas fa-trash"></i></button>
                                    </form>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
            <?php if ($data['course']->user_id == $_SESSION['user_id']) : ?>
                <hr>
                <a href="<?php echo URLROOT; ?>/topics/add/<?php echo $data['course']->id; ?>" class="btn btn-outline-secondary"><i class="fas fa-plus"></i> Add Topic</a>
                <a href="<?php echo URLROOT; ?>/exams/create/<?php echo $data['course']->id; ?>" class="btn btn-danger pull-right"><i class="far fa-sticky-note"></i> Create Exam</a>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>