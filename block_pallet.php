<?php
    session_start();
    require_once('init.php');

    // Check connection
    if (!$con) {
        $_SESSION['error'] = "Could not connect to the database.";
        header("Location: index.php");
        exit();
    }

    // Toggle blocked pallet status and redirect
    $barcodeId = $_GET["id"];
    $db->toggleBlockedPallet($barcodeId);
    header("Location: index.php");

?>
