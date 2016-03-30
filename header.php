<?php 
    require_once('database.inc.php');
    require_once("mysql_connect_data.inc.php");

    $db = new Database($host, $userName, $password, $database);
    $db->openConnection();
    $con = $db->isConnected();
?>

<html>
    <head>
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <link rel="stylesheet" href="stylesheet.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    </head>
    <body>
    <?php 
        if (!$db->isConnected()) {
        ?>
            <div class="alert alert-danger" role="alert">Error! Could not connect to database.</div>
        <?php
            die();
        }
    ?>
