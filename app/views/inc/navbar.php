<nav class="navbar navbar-expand-md navbar-light py-1 shadow-sm">
    <div class="container">
        <a href="<?php echo URLROOT; ?>" class="navbar-brand">
            <img src="<?php echo URLROOT; ?>/img/quizverse2.png" width="150" height="40" alt="">
        </a>
        <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a href="<?php echo URLROOT; ?>" class="nav-link"><span><i class="fas fa-home"></i></span> Home</a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo URLROOT; ?>/pages/features" class="nav-link">Features</a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo URLROOT; ?>/pages/about" class="nav-link">About</a>
                </li>
                <?php if (isset($_SESSION['user_id'])) : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo URLROOT; ?>/courses"><i class="fas fa-user"></i> <?php echo $_SESSION['user_name']; ?></a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-search"></i>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="<?php echo URLROOT ?>/searches/users">Search Lecturers</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="<?php echo URLROOT ?>/searches/courses">Search Courses</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo URLROOT; ?>/users/logout"><i class="fas fa-sign-out-alt"> </i> Logout</a>
                    </li>
                <?php else : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo URLROOT; ?>/users/register"><i class="fas fa-user-plus"> Register</i></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo URLROOT; ?>/users/login"><i class="fas fa-sign-in-alt"> Login</i></a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>