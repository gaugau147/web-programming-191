<?php require APPROOT . '/views/inc/header.php'; ?>

<?php flash('exam_message'); ?>
<a href="<?php echo URLROOT . '/exams/show/' . $data['user']->id; ?>" class="btn btn-light py-2">
    <i class="fa fa-backward"></i> Back
</a>
<div class="row">
    <div class="col-sm-7">
        <h3>Exam <?php echo $data['exam']->title; ?> created by <?php echo $data['user']->fname . ' ' . $data['user']->lname; ?></h3>
    </div>
    <div class="col-sm-5">
        <a href="<?php echo URLROOT; ?>/exams/createpdf/<?php echo $data['exam']->id; ?>" class="btn btn-danger btn-sm mr-3 pull-right">Save As PDF</a>
        <a href="<?php echo URLROOT; ?>/exams/edit/<?php echo $data['exam']->id; ?>" class="btn btn-dark btn-sm mr-3 pull-right">Edit Descriptions</a>
        <a href="<?php echo URLROOT; ?>/exams/questions/<?php echo $data['exam']->id; ?>" class="btn btn-light btn-sm mr-3 pull-right">Edit Questions</a>
    </div>
</div>
<fieldset class="border p-2">
    <legend>Exam descriptions</legend>
    <p>
        <strong>Title: <?php echo $data['exam']->title; ?></strong> <br>
        <?php echo $data['exam']->description; ?><br>
        Class: <?php echo $data['exam']->class; ?><br>
        Taken at: <?php echo $data['exam']->time . ' ' . $data['exam']->date; ?><br>
        Duration: <?php echo $data['exam']->duration; ?> minutes<br>
        Number of questions: <?php echo $data['exam']->no_question; ?><br>
        <small class='text-muted'><?php echo $data['exam']->notes; ?></small>
    </p>
</fieldset>
<fieldset class="border p-2">
    <legend>Questions List</legend>
    <?php foreach ($data['questions'] as $question) : ?>
        <div class="list-group">
            <div class="list-group-item list-group-item-action flex-column align-items-start">
                <div class="align-center">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $question->title; ?></h5>
                            <h6 class="card-subtitle mb-2 ">Level: <?php echo $question->level; ?></h6>
                            <p class="card-text">
                                <?php
                                    if ($question->answer_1) {
                                        echo '<strong>';
                                        echo !empty($question->option_1) ? 'A. ' . $question->option_1 : '';
                                        echo '</strong>';
                                    } else {
                                        echo !empty($question->option_1) ? 'A. ' . $question->option_1 : '';
                                    }
                                    if ($question->answer_2) {
                                        echo '<br><strong>';
                                        echo !empty($question->option_2) ? 'B. ' . $question->option_2 : '';
                                        echo '</strong>';
                                    } else {
                                        echo !empty($question->option_2) ? '<br>B. ' . $question->option_2 : '';
                                    }
                                    if ($question->answer_3) {
                                        echo '<br><strong>';
                                        echo !empty($question->option_3) ? 'C. ' . $question->option_3 : '';
                                        echo '</strong>';
                                    } else {
                                        echo !empty($question->option_3) ? '<br>C. ' . $question->option_3 : '';
                                    }
                                    if ($question->answer_4) {
                                        echo '<br><strong>';
                                        echo !empty($question->option_4) ? 'D. ' . $question->option_4 : '';
                                        echo '</strong>';
                                    } else {
                                        echo !empty($question->option_4) ? '<br>D. ' . $question->option_4 : '';
                                    }
                                    if ($question->answer_5) {
                                        echo '<br><strong>';
                                        echo !empty($question->option_5) ? 'E. ' . $question->option_5 : '';
                                        echo '</strong>';
                                    } else {
                                        echo !empty($question->option_5) ? '<br>E. ' . $question->option_5 : '';
                                    }
                                    ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</fieldset>

<?php require APPROOT . '/views/inc/footer.php'; ?>