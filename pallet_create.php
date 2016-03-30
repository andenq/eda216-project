<?php include('init.php'); ?> 
<?php include('header.php'); ?> 

<div class="container">
    <h2 class="page-header">Create (scan) pallet</h2>
    <div class="row">
        <div class="col-xs-6">
            <form>
                <div class="form-group">
                    <label for="barcode_id">Barcode ID</label>
                    <input type="text" class="form-control" id="barcode_id" name="barcode_id" placeholder="Barcode ID">
                </div>
                <div class="form-group">
                    <label for="pastry_name">Pastry name</label>
                    <?php select_tag(array_map(function($p) {return $p['name'];}, $db->getPastries()), false); ?>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include('footer.php'); ?> 
