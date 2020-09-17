<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User Management</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/b0724393dc.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container-fluid py-3 text-secondary">
        <div class="row">
            <div class="container border-bottom border-right border-left">
                <div class="row">
                    <div class="col-md-3 border-right">
                        <div class="row">
                            <div class="col-md-12">
                                <a href="<?php echo URLROOT; ?>"><img src="<?php echo URLROOT; ?>/img/quizverse2.png" alt="" class="img-fluid"></a>
                            </div>
                        </div>
                        <hr>
                        <div class="row text-secondary">
                            <div class="col-md-12">
                                <!-- <h1>just test</h1> -->
                                <ul class="nav flex-column py-3">
                                    <li class="nav-item py-3">
                                        <a class="btn btn-secondary nav-link active" href="<?php echo URLROOT; ?>/users/manage"><i class="fas fa-users-cog"> </i> User Management</a>
                                    </li>
                                    <li class="nav-item py-3">
                                        <a class="btn btn-danger nav-link active" href="<?php echo URLROOT; ?>/users/logout"><i class="fas fa-door-open"></i> Quit</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9 text-secondary">
                        <h1>USER MANAGEMENT</h1>
                        <br>
                        <?php flash('profile_edit'); ?>
                        <?php flash('user_message'); ?>

                        <div class="row py-3">
                            <div class="col-md-12">
                                <table class="table border">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Full Name</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Lecturer ID</th>
                                            <th scope="col">Role</th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($data['users'] as $user) { ?>
                                            <tr>
                                                <th scope="row"><?php echo $user->id; ?></th>
                                                <td><?php echo $user->fname . ' ' . $user->lname; ?></td>
                                                <td><?php echo $user->email; ?></td>
                                                <td><?php echo $user->lid; ?></td>
                                                <td><?php echo $user->role; ?></td>
                                                <td><a href="<?php echo URLROOT; ?>/users/adminedit/<?php echo $user->id; ?>" class="btn btn-outline-secondary btn-sm"><i class="fas fa-user-edit"></i></a></td>
                                                <td>
                                                    <form onSubmit="return confirm('Are you sure?');" action="<?php echo URLROOT; ?>/users/delete/<?php echo $user->id; ?>" method="post">
                                                        <button type="submit" class="btn btn-danger btn-sm " onClick={onSubmit}><i class='far fa-trash-alt'></i></button>
                                                    </form>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table> <br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>