<?php 

    if (isset($_SESSION['error'])) {
    ?>
        <div class="alert alert-danger" role="alert">Error! <?= $_SESSION['error'] ?></div>        
    <?php
        unset($_SESSION['error']);
    }

    if (isset($_SESSION['success'])) {
    ?>
        <div class="alert alert-success" role="alert">Success! <?= $_SESSION['success'] ?></div>        
    <?php
        unset($_SESSION['success']);
    }
?>
