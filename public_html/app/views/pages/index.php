<?php require APPROOT . '/views/inc/header.php'; ?>

<?php

//$obj = new Validator();
//$data = [
//    'name' => trim($_POST['name']),
//    'email' => trim($_POST['email']),
//    'password' => trim($_POST['password']),
//    'confirm_password' => trim($_POST['confirm_password'])
//];
//$validateData = [
//    'name' => ['required', 'notTaken'],
//    'email' => ['required', 'notTaken'],
//    'password' => ['required', 'minLen' >= 6],
//    'confirm_password' => ['required', 'match']
//];
//
//$obj->validate($data, $validateData);
?>

    <div class="jumbotron jumbotron-flud">
        <div class="container">
            <h1 class="display-3">
                <?php echo $data['title']; ?>
            </h1>
            <br>

            <p class="lead">
                <?php echo $data['description']; ?>
            </p>
        </div>
    </div>

<?php require APPROOT . '/views/inc/footer.php'; ?>
