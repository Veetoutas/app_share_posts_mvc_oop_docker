<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="jumbotron jumbotron-flud">
    <div class="container">
        <h1 class="display-3">
            <?php echo $data['title']; ?>
        </h1>

        <br>
        <p class="lead">
            <?php echo $data['description']; ?>
        </p>
        <p>Version: <strong> <?php echo APP_VERSION; ?></strong></p>
    </div>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>
