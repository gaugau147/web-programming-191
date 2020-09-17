<?php require APPROOT . '/views/inc/header.php'; ?>
<a href="<?php echo URLROOT; ?>/searches/users" class="btn btn-light py-3">
    <i class="fa fa-backward"></i> Back
</a>
<div class="container border py-2">
    <div class="row">
        <div class="col-md-12">
            <h1>Search results</h1><hr>
            <div class="font-italic text-muted py-2">For Lecturer Firstname: <?php echo $data['fname'] . '<br>';
                                                                echo !empty($data['email']) ? 'Email: ' . $data['email'] . '<br>' : '';
                                                                echo !empty($data['lid']) ? 'Lecturer ID: ' . $data['lid'] : ""; ?></div>
            <?php if (empty($data['users'])) {
                echo 'No results found';
            } ?>
            <?php foreach ($data['users'] as $user) : ?>
                <div class="list-group border-0">
                    <div class="list-group-item list-group-item-action flex-column align-items-start border-0">
                        <div class="row align-center">
                            <div class="col-sm-3">
                                <img class="img-fluid rounded-circle mb-3 mt-3" width=100px src="<?php echo URLROOT; ?>/img/uploads/<?php echo $user->avatar; ?>" alt="profile-picture">

                            </div>
                            <div class="col-sm-7">
                                <h4 class="mb-1"><?php echo $user->fname . ' ' . $user->lname; ?> </h4>
                                <p>
                                    <?php echo 'Email: ' . $user->email . '<br>Lecturer ID: ' . $user->lid . '<br>Faculty of ' . $user->faculty; ?>
                                </p>
                            </div>
                            <div class="col-sm-2">
                                <a href="<?php echo ($user->id != $_SESSION['user_id']) ? URLROOT . '/users/show/' . $user->id : URLROOT . '/courses'; ?>" class="btn btn-outline-secondary btn-sm"><i class="far fa-eye"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>