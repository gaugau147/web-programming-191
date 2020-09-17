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
                        <a href="<?php echo URLROOT; ?>/users/manage" class="btn btn-light">
                            <i class="fa fa-backward"></i> Back
                        </a>
                        <div class="card card-body bg-light mt-5">
                            <h2>Edit Profile: <?php echo $data['fname'] . ' ' . $data['lname']; ?></h2>
                            <form action="<?php echo URLROOT; ?>/users/adminedit/<?php echo $data['id']; ?>" method="post">
                                <div class="form-group">
                                    <label for="fname">First Name: <sup>*</sup></label>
                                    <input type="text" name="fname" class="form-control form-control-lg <?php echo (!empty($data['fname_err'])) ? 'is-invalid' : '' ?>" value="<?php echo $data['fname']; ?>" id="fname">
                                    <span class="invalid-feedback"><?php echo $data['fname_err']; ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="lname">Last Name: <sup>*</sup></label>
                                    <input type="text" name="lname" class="form-control form-control-lg <?php echo (!empty($data['lname_err'])) ? 'is-invalid' : '' ?>" value="<?php echo $data['lname']; ?>" id="lname">
                                    <span class="invalid-feedback"><?php echo $data['lname_err']; ?></span>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="lid">Lecturer ID: <sup>*</sup></label>
                                            <input type="text" name="lid" class="form-control form-control-lg <?php echo (!empty($data['lid_err'])) ? 'is-invalid' : '' ?>" value="<?php echo $data['lid']; ?>" id="lid">
                                            <span class="invalid-feedback"><?php echo $data['lid_err']; ?></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="role">Role <sup>*</sup></label>
                                            <select name="role" class="form-control <?php echo (!empty($data['role_err'])) ? 'is-invalid' : '' ?>" id="role">
                                                <option value="">Please select</option>
                                                <option value="lecturer" <?php echo $data['role'] == 'lecturer' ? 'selected' : ''; ?>>Lecturer</option>
                                                <option value="admin" <?php echo $data['role'] == 'admin' ? 'selected' : ''; ?>>Admin</option>
                                            </select>
                                            <span class="invalid-feedback"><?php echo $data['role_err']; ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="password">Confirm Your Password: <sup>*</sup></label>
                                    <input type="password" name="password" class="form-control form-control-lg <?php echo (!empty($data['password_err'])) ? 'is-invalid' : '' ?>" id="password" value="">
                                    <span class="invalid-feedback"><?php echo $data['password_err']; ?></span>
                                </div>
                                <input type="submit" class="btn btn-danger mt-5" value="Submit">
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>


<?php require APPROOT . '/views/inc/footer.php'; ?>