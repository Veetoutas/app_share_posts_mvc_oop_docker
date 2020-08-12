<?php
    $str = 'style.css';
    $styles = sprintf(ASSETS_URL, $str);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie-edge">
    <link rel="stylesheet" href="<?= $styles ?>">
    <title><?php echo SITENAME; ?></title>
</head>
<body>

