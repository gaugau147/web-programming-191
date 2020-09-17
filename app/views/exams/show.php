<?php require APPROOT . '/views/inc/header.php'; ?>
<?php flash('exam_message'); ?>
<a href="<?php echo URLROOT . '/courses'; ?>" class="btn btn-light py-2">
    <i class="fa fa-backward"></i> Back
</a>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1 class="text-center">Exam created by <?php echo $data['user']->fname . ' ' . $data['user']->lname; ?></h1><hr>
            <?php foreach ($data['exams'] as $exam) : ?>
                <div class="list-group">
                    <div class="list-group-item list-group-item-action flex-column align-items-start">
                        <div class="row align-center">
                            <div class="col-md-8">
                                <h5 class="mb-1"><?php echo $exam->title; ?> </h5>
                                <p>
                                    Class: <?php echo $exam->class; ?><br>
                                    Taken at: <?php echo $exam->time . ' ' . $exam->date; ?><br>
                                    Duration: <?php echo $exam->duration; ?> minutes<br>
                                    <?php echo $exam->no_question; ?> questions

                                </p>
                            </div>
                            <div class="col-md-2">
                                <a href="<?php echo URLROOT; ?>/exams/display/<?php echo $exam->id; ?>" class="btn btn-light btn-sm">View Exam</a>
                            </div>
                            <div class="col-md-2">
                                <form onSubmit="return confirm('Are you sure?');" action="<?php echo URLROOT; ?>/exams/delete/<?php echo $exam->id; ?>" method="post">
                                    <input type="submit" value="Delete" class="btn btn-dark btn-sm " onClick={onSubmit}>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>