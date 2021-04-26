<?php

use App\Core\View;

?>
<!doctype html>
<html lang='fr'>
<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>
    <link rel='stylesheet' href='vendor/mdb/css/mdb.min.css'>
    <link rel='stylesheet' href='vendor/fontawesome5/css/all.min.css'>
    <link rel='stylesheet' href='css/main.css'>
    <script src='vendor/bootstrap/bootstrap.min.css'></script>
    <script src='vendor/mdb/js/mdb.min.js'></script>
    <script defer src='vendor/bootstrap/bootstrap.min.js'></script>
    <script defer src='vendor/fontawesome5/js/all.min.js'></script>
    <title>Form Widget</title>
</head>
<body class='bg-light'>
<?= Menu() ?>
<div class='container mt-4 pt-5 mb-4 pb-5'>
<!--    {{content}}-->
    <?= View::getContent() ?>
<!--    <i class='fas '></i>-->
</div>
<?= Footer() ?>
</body>
</html>
