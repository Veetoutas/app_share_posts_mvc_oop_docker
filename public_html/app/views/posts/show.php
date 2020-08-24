<?php require APPROOT . '/views/inc/header.php'; ?>

<a href="<?php echo URL_ROOT; ?>/posts" class="btn btn-light"><i class="fa fa-backward"> Back</i></a>
<br>
<h1><?php echo $data['post']->title; ?></h1>
<h1><?php echo $data['post']->body; ?></h1>

<?php require APPROOT . '/views/inc/footer.php'; ?>
