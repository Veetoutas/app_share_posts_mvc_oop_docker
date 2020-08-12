<?php require APPROOT . '/views/inc/header.php';

    echo "<h1>" . $data['title'] . "</h1>";
    echo "<p>1. Change the DB credentials in config.php to yours</p>";
    echo "<p>2. Change the RewriteBase in .htaccess file in public -> .htaccess file to your base</p>";
    echo "<p>3. Create a a model in 'models' folder</p>";

require APPROOT . '/views/inc/footer.php';
