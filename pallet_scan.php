<?php
include_once('init.php');

if (empty($_POST['barcode_id'])) {
    $_SESSION['error'] = 'Barcode ID cannot be empty.';
    header('Location: pallet_create.php');
    exit();
}

try {
    $db->scanPallet($_POST['barcode_id'], $_POST['pastry_name']);
    header('Location: .');
    $_SESSION['success'] = 'Pallet scanned.';
} catch (PDOException $e) {
    $_SESSION['error'] = $e->getMessage();
    header('Location: pallet_create.php');
}
