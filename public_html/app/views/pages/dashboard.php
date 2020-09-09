<?php require APPROOT . '/views/inc/header.php'; ?>

<form action="<?php echo URL_ROOT; ?>/city/callApi" method="post">
    <div class="row">
        <div class="col-md-2">
            <input type="submit" value="Fetch Countries" class="btn btn-success btn-block">
        </div>
    </div>
</form>

<?php require APPROOT . '/views/inc/footer.php'; ?>
