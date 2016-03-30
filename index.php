
<?php
    require_once('init.php');

    // Fetch pallet data from database
    // ...
    $pallets = $db->getPallets();

?>

<?php include('header.php'); ?> 
<h2 class="page-header">Pallet data</h2>
<a href="pallet_create.php" class="btn btn-default">Create pallet</a>
<a href="search_pallet.php" class="btn btn-default">Search pallet</a>
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
<?php include('footer.php') ?>
