<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-3">
    <div class="container">

        <a class="navbar-brand" href="<?php echo URL_ROOT; ?>"><?php echo SITENAME; ?></a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsExampleDefault">

            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo URL_ROOT; ?>">Home </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo URL_ROOT; ?>/pages/about">About</a>
                </li>
                <?php if ($_SESSION['user_role'] == 'admin') : ?>
                    <li class="nav-item">
                        <a href="<?php URL_ROOT; ?>/pages/dashboard" class="ml-2 mr-2 btn btn-primary add-post-btn">
                            <i class="far fa-star" aria-hidden="true"></i> Admin dashboard
                        </a>
                    </li>
                <?php endif; ?>
            </ul>

            <ul class="navbar-nav ml-auto">
                <!-- If User logged in-->
                <?php if(isset($_SESSION['user_id'])) : ?>
                    <li class="nav-item">
                        <a class="nav-link" id="session-user-name" href="#"><?php echo $_SESSION['user_name']; ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo URL_ROOT; ?>/users/logout">Logout</a>
                    </li>
                <?php else : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo URL_ROOT; ?>/users/register">Register </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo URL_ROOT; ?>/users/login">Login</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
