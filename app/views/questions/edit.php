<?php require APPROOT . '/views/inc/header.php'; ?>
<a href="<?php echo URLROOT; ?>/questions/show/<?php echo $data['topic_id']; ?>" class="btn btn-light">
    <i class="fa fa-backward"></i> Back
</a>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-body bg-light mt-5">
                <h1 class="text-center">Edit Question</h1> <hr>
                <form action="<?php echo URLROOT; ?>/questions/edit/<?php echo $data['id']; ?>" method="post">
                    <div class="form-group">
                        <label for="title" class="text-muted">*Check on right answer, multiple answers are allowed</label>
                        <textarea type="text" name="title" class="form-control <?php echo (!empty($data['title_err'])) ? 'is-invalid' : ''; ?>" id="title" placeholder="Question title goes here *"><?php echo $data['title']; ?></textarea>
                        <span class="invalid-feedback"><?php echo $data['title_err']; ?></span>
                    </div>
                    <div class="form-check mb-3">
                        <!-- This hidden field for including checkbox to post method -->
                        <input type="hidden" name="answer_1" value="" />
                        <!-- The below php is to check if the checkbox is checked or not -->
                        <input type="checkbox" class="form-check-input" name="answer_1" value="1" <?php echo ($data['answer_1'] == 1) ? 'checked' : ''; ?>>
                        <!-- Textarea has no value attribute -->
                        <textarea type="text" name="option_1" class="form-control <?php echo (!empty($data['option_1_err'])) ? 'is-invalid' : '' ?>" id="option_1" placeholder="Option 1 *"><?php echo $data['option_1']; ?></textarea>
                        <span class="invalid-feedback"><?php echo $data['option_1_err']; ?></span>
                    </div>
                    <div class="form-check mb-3">
                        <input type="hidden" name="answer_2" value="" />
                        <input type="checkbox" class="form-check-input" name="answer_2" value="2" <?php echo ($data['answer_2'] == 1) ? 'checked' : ''; ?>>
                        <textarea type="text" name="option_2" class="form-control <?php echo (!empty($data['option_2_err'])) ? 'is-invalid' : ''; ?>" id="option_2" placeholder="Option 2 *"><?php echo $data['option_2']; ?></textarea>
                        <span class="invalid-feedback"><?php echo $data['option_2_err']; ?></span>
                    </div>
                    <div class="form-check mb-3">
                        <input type="hidden" name="answer_3" value="" />
                        <input type="checkbox" class="form-check-input" name="answer_3" value="3" <?php echo ($data['answer_3'] == 1) ? 'checked' : ''; ?>>
                        <textarea type="text" name="option_3" class="form-control <?php echo (!empty($data['option_3_err'])) ? 'is-invalid' : ''; ?>" id="option_3" placeholder="Option 3"><?php echo $data['option_3']; ?></textarea>
                        <span class="invalid-feedback"><?php echo $data['option_3_err']; ?></span>

                    </div>
                    <div class="form-check mb-3">
                        <input type="hidden" name="answer_4" value="" />
                        <input type="checkbox" class="form-check-input" name="answer_4" value="4" <?php echo ($data['answer_4'] == 1) ? 'checked' : ''; ?>>
                        <textarea type="text" name="option_4" class="form-control <?php echo (!empty($data['option_4_err'])) ? 'is-invalid' : ''; ?>" id="option_4" placeholder="Option 4"><?php echo $data['option_4']; ?></textarea>
                        <span class="invalid-feedback"><?php echo $data['option_4_err']; ?></span>
                    </div>
                    <div class="form-check mb-3">
                        <input type="hidden" name="answer_5" value="" />
                        <input type="checkbox" class="form-check-input" name="answer_5" value="5" <?php echo ($data['answer_5'] == 1) ? 'checked' : ''; ?>>
                        <textarea type="text" name="option_5" class="form-control <?php echo (!empty($data['option_5_err'])) ? 'is-invalid' : ''; ?>" id="option_5" placeholder="Option 5"><?php echo $data['option_5']; ?></textarea>
                        <span class="invalid-feedback"><?php echo $data['option_5_err']; ?></span>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <select name="level" class="form-control <?php echo (!empty($data['level_err'])) ? 'is-invalid' : ''; ?>" id="level">
                                <option value="">Please select hard level *</option>
                                <option value="easy" <?php echo $data['level'] == 'easy' ? 'selected' : ''; ?>>Easy</option>
                                <option value="medium" <?php echo $data['level'] == 'medium' ? 'selected' : ''; ?>>Medium</option>
                                <option value="hard" <?php echo $data['level'] == 'hard' ? 'selected' : ''; ?>>Hard</option>
                                <option value="mindblow" <?php echo $data['level'] == 'mindblow' ? 'selected' : ''; ?>>Mindblow</option>
                            </select>
                            <span class="invalid-feedback"><?php echo $data['level_err']; ?></span>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="submit" class="btn btn-danger float-right" value="Submit">
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>