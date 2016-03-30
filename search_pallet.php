<?php
    require_once('init.php');

    $barcode_id = isset($_POST['barcode_id']) ? $_POST['barcode_id'] : '';
    $pastry_name = isset($_POST['pastry_name']) ? $_POST['pastry_name'] : '';
    $datefrom = isset($_POST['datefrom']) ? $_POST['datefrom'] : '';
    $dateto = isset($_POST['dateto']) ? $_POST['dateto'] : '';

    $pallets = $db->searchPallets($barcode_id, $pastry_name, $datefrom, $dateto);
?>

<?php include('header.php'); ?>
<h2 class="page-header">Search pallet</h2>
<div class="row">
    <div class="col-xs-6">
        <form method="post" action="search_pallet.php">
            <div class="form-group">
                <label for="barcode_id">Barcode ID</label>
                <input type="text" class="form-control" id="barcode_id" name="barcode_id" value="<?=$barcode_id?>" placeholder="Barcode ID">
            </div>
            <div class="form-group">
                <label for="pastry_name">Pastry name</label>
                <select class="form-control" name="pastry_name" id="pastry_name">
                    <option></option>
                    <?php select_options(array_map(function($p) {return $p['name'];}, $db->getPastries()), false, $pastry_name); ?>
                </select>
            </div>
            <div class="form-group">
                <label for="datefrom">Date from</label>
                <div class="input-group date" id="datefrom">
                    <input type="text" class="form-control" id="datefrom" name="datefrom" value="<?=$datefrom?>"/>
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>
            <div class="form-group">
                <label for="dateto">Date to</label>
                <div class="input-group date" id="dateto">
                    <input type="text" class="form-control" id="dateto" name="dateto" value="<?=$dateto?>"/>
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>
            <script type="text/javascript">
                $(function () {
                    $('#datefrom').datetimepicker({
                        format: 'YYYY-MM-DD'
                    });
                    $('#dateto').datetimepicker({
                        format: 'YYYY-MM-DD',
                        useCurrent: false
                    });
                    $("#datefrom").on("dp.change", function (e) {
                        $('#dateto').data("DateTimePicker").minDate(e.date);
                    });
                    $("#dateto").on("dp.change", function (e) {
                        $('#datefrom').data("DateTimePicker").maxDate(e.date);
                    });
                });
            </script>
            <input type="submit" class="btn btn-primary pull-right" value="Search Pallet">
            <a href="index.php" class="btn btn-primary pull-left">Go back</a>
        </form>
    </div>
</div>
<table class="table pallet-table">
    <thead>
        <tr>
            <th>Date created</th>
            <th>Barcode</th>
            <th>Pastry name</th>
            <th>Blocked at</th>
        </tr>
    </thead>
    <tbody>
        <?php
            if ($con) {
                foreach ($pallets as $pallet) {
                    print "<tr>";
                    print "<td>$pallet[created_at]</td>";
                    print "<td>$pallet[barcode_id]</td>";
                    print "<td>$pallet[pastry_name]</td>";
                    if ($pallet["blocked_at"] != null) {
                        print '<td><a href="/block_pallet.php?id=' . $pallet["barcode_id"] . '" class="btn btn-danger">' .  $pallet["blocked_at"] . '</a></td>';
                    } else {
                        print '<td><a href="/block_pallet.php?id=' . $pallet["barcode_id"] . '" class="btn btn-info">Block</a></td>';
                    }
                    print "</tr>";
                }
            }
         ?>
    </tbody>
</table>



<?php include('footer.php'); ?>
