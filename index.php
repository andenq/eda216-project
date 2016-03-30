<?php include('header.php'); ?> 

<?php
    if ($con) {
        $list = ["2016-03-30", "2016-03-29", "2016-03-29"];
    }

?>

<div class="container">
    <h2 class="page-header">Pallet data</h2>
    <a href="http://localhost/createPallet.php" class="btn btn-default">Create pallet</a>
    <table class="table pallet-table">
        <thead>
            <tr>
                <th>Date created</th>
                <th>Barcode</th>
                <th>Blocked at</th>
            </tr>
        </thead>
        <tbody>
            <?php
                if ($con) {
                    foreach ($list as $l) {
                        print "<tr>";
                        print "<td>$l</td>";
                        print "<td>1234567890128</td>";
                        print "<td>2016-03-30</td>";
                        print "</tr>";
                    }
                } else {
                    print "<tr><td></td></tr>";
                }
             ?>
        </tbody>
    </table>
</div>
<?php include('footer.php') ?>
