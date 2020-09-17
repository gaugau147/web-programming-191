<?php require APPROOT . '/views/inc/header.php'; ?>
<?php flash('exam_message'); ?>
<div class="container" id="dm-chap1-container">
    <div class="row">
        <!-- Left panel -->
        <div class="col-lg-4">
            <div class="sticky-top">
                <h2 class="mb-5">Search questions</h2>
                <hr>
                <form action="<?php echo URLROOT; ?>/exams/search/<?php echo $data['exam']->id;?>" method="post">
                    <div class="form-group mt-5">
                        <label for="topic">Topic: </label>
                        <select name="topic" class="form-control <?php echo (!empty($data['topic_err'])) ? 'is-invalid' : '' ?>" id="topic">
                            <option value="">Please select</option>
                            <?php foreach ($data['topics'] as $topic) { ?>
                                <option value="<?php echo $topic->id; ?>" <?php echo ($data['topic'] ==  $topic->id) ? 'selected' : ''; ?>><?php echo $topic->title . ' - ' . $topic->name; ?></option>
                            <?php } ?>
                        </select>
                        <span class="invalid-feedback"><?php echo $data['topic_err']; ?></span>
                    </div>
                    <div class="form-group">
                        <label for="question">Question: <br><small class="text-muted">Remember anything about the question title?</small></label>
                        <input type="text" name="question" class="form-control <?php echo (!empty($data['question_err'])) ? 'is-invalid' : '' ?>" value="<?php echo $data['question']; ?>">
                        <span class="invalid-feedback"><?php echo $data['question_err']; ?></span>
                    </div>
                    <div class="form-group mb-5">
                        <label for="level">Hard level: </label>
                        <select name="level" class="form-control <?php echo (!empty($data['level_err'])) ? 'is-invalid' : ''; ?>" id="level">
                            <option value="" >Please select</option>
                            <option value="easy" <?php echo $data['level']=='easy' ? 'selected' : ''; ?>>Easy</option>
                            <option value="medium" <?php echo $data['level']=='medium' ? 'selected' : ''; ?>>Medium</option>
                            <option value="hard" <?php echo $data['level']=='hard' ? 'selected' : ''; ?>>Hard</option>
                            <option value="mindblow" <?php echo $data['level']=='mindblow' ? 'selected' : ''; ?>>Mindblow</option>
                        </select>
                        <span class="invalid-feedback"><?php echo $data['level_err']; ?></span>
                    </div>
                    <hr>
                    <button type="submit" class="btn btn-dark btn-block mt-5"><i class="fa fa-search"></i></button>
                </form>
            </div>
        </div>
        <div class="col-lg-8">
            <a href="<?php echo URLROOT; ?>/exams/display/<?php echo $data['exam']->id; ?> " class="btn btn-light">
                <i class="fa fa-backward"></i> Back
            </a>
            <!-- List of questions -->
            <h3 class="mt-3">Questions List</h3>
            <?php foreach ($data['questions'] as $question) : ?>
                <div class="list-group">
                    <div class="list-group-item list-group-item-action flex-column align-items-start">
                        <div class="row">
                            <div class="col-sm-10">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo $question->title; ?></h5>
                                        <p class="card-subtitle mb-2 text-muted">Last modified <?php echo $question->last_modified; ?></p>
                                        <p class="card-subtitle mb-2 ">Level: <?php echo $question->level; ?></p>
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
                            <div class="col-sm-2">
                                <form action="<?php echo URLROOT; ?>/exams/addquestion/<?php echo $question->id .'.'. $data['exam']->id . '.' . $data['exam']->no_question; ?>" method="post">
                                    <input type="submit" value="Add" class="btn btn-warning btn-sm card-link mt-2 btn-block">
                                </form>
                                <form action="<?php echo URLROOT; ?>/exams/removequestion/<?php echo $question->id .'.'. $data['exam']->id; ?>" method="post">
                                    <input type="submit" value="Remove" class="btn btn-dark btn-sm card-link mt-2 btn-block">
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