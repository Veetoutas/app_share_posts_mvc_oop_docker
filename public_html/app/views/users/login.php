<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="row">
    <div class="col-md-6 mx-auto">
        <div class="card card-body bg-light mt-5">
            <?php flash('register_success') ?>
            <h2>Login</h2>
            <p>Please fill in your credentials to login</p>
            <form action="<?php echo URL_ROOT; ?>/users/login" method="post">

                <span id="error_message_custom"><?php foreach($errors as $error) :  ?></span>
                <span><?php echo $error; ?></span>
                <span><?php  endforeach; ?></span>
                <br>

                <div class="form-group">
                    <label for="email">E-mail: <sup>*</sup></label>
                    <input
                        type="email" name="email"
                        class="form-control form-control-lg
                            <?php echo (!empty($data['email_error'])) ? 'is-invalid' : '';?>"
                        value="<?php echo $data['email']; ?>">
                </div>

                <div class="form-group">
                    <label for="password">Password: <sup>*</sup></label>
                    <input
                        type="password" name="password"
                        class="form-control form-control-lg
                            <?php echo (!empty($data['password_error'])) ? 'is-invalid' : '';?>"
                        value="<?php echo $data['password']; ?>">
                </div>

                <div class="row">
                    <div class="col">
                        <input type="submit" value="Login" class="btn btn-success btn-block">
                    </div>
                    <div class="col">
                        <a href="<?php URL_ROOT; ?>/users/register" class="btn btn-light btn-block">
                            No account? Register
                        </a>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>
