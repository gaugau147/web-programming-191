<?php require APPROOT . '/views/inc/header.php'; ?>
<?php flash('question_message'); ?>
<a href="<?php echo URLROOT; ?>/topics/show/<?php echo $data['course_id']; ?>" class="btn btn-light">
    <i class="fa fa-backward py-4"></i> Back
</a>
<div class="container border">
    <div class="row">
        <div class="col-md-12">
            <h1 class="py-3 text-center"><?php echo $data['topic']->title." - ".$data['topic']->name; ?></h1>
            <div class="text-white p-2 mb-3 text-muted text-right container">
                Written by <i class="fas fa-at"></i> <?php echo $data['user']->fname;
                            echo " ";
                            echo $data['user']->lname; ?>
            </div>
            <!-- <p><?php echo $data['topic']->name; ?></p> -->
            <?php if ($data['user']->id == $_SESSION['user_id']) : ?>
                <hr>
                <br><a href="<?php echo URLROOT; ?>/questions/add/<?php echo $data['topic']->id; ?>" class="btn btn-danger float-right">Add Question</a>
            <?php endif; ?>
            <h3 class="py-3">Questions</h3>
            <?php foreach ($data['questions'] as $question) : ?>
                <div class="list-group py-3">
                    <div class="list-group-item list-group-item-action flex-column align-items-start border-0">
                        <div class="align-center border">
                            <div class="card border-0">
                                <div class="card-body">
                                    <h3 class="card-title"><?php echo $question->title; ?></h3>
                                    <h6 class="card-subtitle mb-2 text-muted">Last modified <?php echo $question->last_modified; ?></h6>
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
                                    <?php if ($question->user_id == $_SESSION['user_id']) { ?>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <a href="<?php echo URLROOT; ?>/questions/edit/<?php echo $question->id; ?>" class="btn btn-outline-secondary card-link"><i class="far fa-edit"></i></a>
                                            </div>
                                            <div class="col-md-6">
                                                <form onSubmit="return confirm('Are you sure?');" action="<?php echo URLROOT; ?>/questions/delete/<?php echo $question->id; ?>" method="post">
                                                    <!-- <input type="submit" value="Delete" class="btn btn-dark btn-sm card-link mt-2" onClick={onSubmit}> -->
                                                    <buttontype="submit" class="btn btn-danger btn-sm card-link mt-2 float-right" onClick={onSubmit}><i class="fas fa-trash"></i></button>
                                                </form>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>