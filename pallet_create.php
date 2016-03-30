<?php include('init.php'); ?> 
<?php include('header.php'); ?> 

<h2 class="page-header">Create (scan) pallet</h2>
<div class="row">
    <div class="col-xs-6">
        <form method="post" action="paller_scan.php">
            <div class="form-group">
                <label for="barcode_id">Barcode ID</label>
                <input type="text" class="form-control" id="barcode_id" name="barcode_id" placeholder="Barcode ID">
            </div>
            <div class="form-group">
                <label for="pastry_name">Pastry name</label>
                <select class="form-control" name="pastry_name" id="pastry_name">
                    <?php select_options(array_map(function($p) {return $p['name'];}, $db->getPastries()), false); ?>
                </select>
            </div>
            <input type="submit" class="btn btn-primary pull-right" value="Scan Pallet">
        </form>
    </div>
</div>

<?php include('footer.php'); ?> 
